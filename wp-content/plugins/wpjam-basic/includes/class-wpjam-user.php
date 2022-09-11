<?php
class WPJAM_User{
	private $id;

	private function __construct($id){
		$this->id	= (int)$id;
	}

	public function __get($name){
		if(in_array($name, ['id', 'user_id'])){
			return $this->id;
		}elseif($name == 'user'){
			return get_userdata($this->id);
		}elseif($name == 'avatarurl'){
			return get_user_meta($this->id, 'avatarurl', true);
		}else{
			return $this->user->$name;
		}
	}

	public function __isset($key){
		return $this->$key !== null;
	}

	public function update_avatarurl($avatarurl){
		if($this->avatarurl != $avatarurl){
			update_user_meta($this->id, 'avatarurl', $avatarurl);
		}

		return true;
	}

	public function update_nickname($nickname){
		if($this->nickname != $nickname){
			self::update($this->id, ['nickname'=>$nickname, 'display_name'=>$nickname]);
		}

		return true;
	}

	public function add_role($role, $blog_id=0){
		$switched	= (is_multisite() && $blog_id) ? switch_to_blog($blog_id) : false;	// 不同博客的用户角色不同
		$wp_error	= null;

		if($this->user->roles){
			if(!in_array($role, $this->user->roles)){
				$wp_error	= new WP_Error('role_added', '你已有权限，如果需要更改权限，请联系管理员直接修改。');
			}
		}else{
			$this->user->add_role($role);
		}

		if($switched){
			restore_current_blog();
		}

		return $wp_error ?? $this->user;
	}

	public function get_openid($name, $appid=''){
		$bind_key	= $this->get_bind_key($name, $appid);

		return get_user_meta($this->id, $bind_key, true);
	}

	public function update_openid($name, $appid, $openid){
		$bind_key	= $this->get_bind_key($name, $appid);

		return (bool)update_user_meta($this->id, $bind_key, $openid);
	}

	public function delete_openid($name, $appid=''){
		$bind_key	= $this->get_bind_key($name, $appid);

		return (bool)delete_user_meta($this->id, $bind_key);
	}

	public function bind($name, $appid, $openid){
		$bind_id	= self::get_by_openid($name, $appid, $openid);

		if(is_wp_error($bind_id)){
			return $bind_id;
		}

		if($bind_id && $bind_id != $this->id && get_userdata($bind_id)){
			return new WP_Error('already_binded', '已绑定其他账号。');
		}

		$current_openid	= $this->get_openid($name, $appid);

		if($current_openid && $current_openid != $openid){
			return new WP_Error('already_binded', '该账号已经绑定了其他用户，请先取消绑定再处理！');
		}

		$bind_obj	= wpjam_get_bind_object($name, $appid);

		$bind_obj->update_bind($openid, 'user_id', $this->id);

		if($avatarurl = $bind_obj->get_avatarurl($openid)){
			$this->update_avatarurl($avatarurl);
		}

		if(!$this->nickname || $this->nickname == $openid){
			if($nickname = $bind_obj->get_nickname($openid)){
				$this->update_nickname($nickname);
			}
		}

		if($current_openid != $openid){
			return $this->update_openid($name, $appid, $openid);
		}else{
			return true;
		}
	}

	public function unbind($name, $appid=''){
		$bind_obj	= wpjam_get_bind_object($name, $appid);

		if(!$bind_obj){
			return false;
		}

		if($openid = $this->get_openid($name, $appid)){
			$this->delete_openid($name, $appid);
		}else{
			$openid	= $bind_obj->get_openid_by('user_id', $this->id);
		}

		if($openid){
			$bind_obj->update_bind($openid, 'user_id', 0);
		}

		return $openid;
	}

	public function login(){
		wp_set_auth_cookie($this->id, true, is_ssl());
		wp_set_current_user($this->id);
		do_action('wp_login', $this->user_login, $this->user);
	}

	public function parse_for_json($size=96){
		$user_json	= [];

		$user_json['id']		= $this->id;
		$user_json['nickname']	= $this->nickname;
		$user_json['name']		= $user_json['display_name'] = $this->display_name;
		$user_json['avatar']	= get_avatar_url($this->user, $size);

		return apply_filters('wpjam_user_json', $user_json, $this->id);
	}

	private static $instances	= [];

	public static function get_instance($user_id){
		$user		= self::validate($user_id);

		if(is_wp_error($user)){
			return null;
		}

		$user_id	= $user->ID;

		if(!isset($instances[$user_id])){
			$instances[$user_id]	= new self($user_id);
		}

		return $instances[$user_id];
	}

	public static function get_user($user){
		if($user && is_numeric($user)){	// 不存在情况下的缓存优化
			$user_id	= $user;
			$found		= false;
			$cache		= wp_cache_get($user_id, 'users', false, $found);

			if($found){
				return $cache ? get_userdata($user_id) : $cache;
			}else{
				$user	= get_userdata($user_id);

				if(!$user){	// 防止重复 SQL 查询。
					wp_cache_add($user_id, false, 'users', 10);
				}
			}
		}

		return $user;
	}

	public static function get($id){
		$user	= get_userdata($id);
		return $user ? $user->to_array() : [];
	}

	public static function insert($data){
		return wp_insert_user(wp_slash($data));
	}

	public static function update($user_id, $data){
		$data['ID'] = $user_id;

		return wp_update_user(wp_slash($data));
	}

	public static function create($args){
		$args	= wp_parse_args($args, [
			'user_pass'		=> wp_generate_password(12, false),
			'user_login'	=> '',
			'user_email'	=> '',
			'nickname'		=> '',
			'avatarurl'		=> '',
			'role'			=> '',
			'blog_id'		=> 0
		]);

		$users_can_register		= $args['users_can_register'] ?? get_option('users_can_register');

		if(!$users_can_register){
			return new WP_Error('register_disabled', '系统不开放注册，请联系管理员！');
		}

		$args['user_login']	= preg_replace('/\s+/', '', sanitize_user($args['user_login'], true));

		if(empty($args['user_login'])){
			return new WP_Error('empty_user_login', '用户名不能为空。');
		}

		if(empty($args['user_email'])){
			return new WP_Error('empty_user_email', '用户邮箱不能为空。');
		}

		$register_lock	= wp_cache_get($args['user_login'].'_register_lock', 'users');

		if($register_lock !== false){
			return new WP_Error('user_register_locked', '该用户名正在注册中，请稍后再试！');
		}

		$result	= wp_cache_add($args['user_login'].'_register_lock', 1, 'users', 15);

		if($result === false){
			return new WP_Error('user_register_locked', '该用户名正在注册中1，请稍后再试！');
		}

		$userdata	= wp_array_slice_assoc($args, ['user_login', 'user_pass', 'user_email']);

		if(!empty($args['nickname'])){
			$userdata['nickname']	= $userdata['display_name']	= $args['nickname'];
		}

		$switched	= (is_multisite() && $args['blog_id']) ? switch_to_blog($args['blog_id']) : false;

		$userdata['role']	= $args['role'] ?: get_option('default_role');

		$user_id	= self::insert($userdata);

		if($switched){
			restore_current_blog();
		}

		return $user_id;
	}

	public static function get_bind_key($name, $appid=''){
		return $appid ? $name.'_'.$appid : $name;
	}

	public static function get_by_openid($name, $appid, $openid){
		$bind_obj	= wpjam_get_bind_object($name, $appid);

		if(!$bind_obj){
			return new WP_Error('bind_not_exists', '不支持该登录方式');
		}

		if(!$bind_obj->get_user($openid)){
			return new WP_Error('invalid_openid', '无效的 Openid');
		}

		$user_id	= $bind_obj->get_bind($openid, 'user_id', true);

		if(is_wp_error($user_id) || ($user_id && get_userdata($user_id))){
			return $user_id;
		}

		$bind_key	= self::get_bind_key($name, $appid);

		if($users = get_users(['meta_key'=>$bind_key, 'meta_value'=>$openid])){
			return current($users)->ID;
		}

		return username_exists($openid);
	}

	public static function signup($name, $appid, $openid, $args){
		$user_id	= self::get_by_openid($name, $appid, $openid);

		if(is_wp_error($user_id)){
			return $user_id;
		}

		$args	= apply_filters('wpjam_user_signup_args', $args, $name, $appid, $openid);

		if(is_wp_error($args)){
			return $args;
		}

		if(!$user_id){
			$bind_obj	= wpjam_get_bind_object($name, $appid);
			$is_create	= true;

			$args['user_login']	= $openid;
			$args['user_email']	= $bind_obj->get_email($openid);
			$args['nickname']	= $bind_obj->get_nickname($openid);

			$user_id	= self::create($args);

			if(is_wp_error($user_id)){
				return $user_id;
			}
		}else{
			$is_create	= false;
		}

		$wpjam_user	= self::get_instance($user_id);

		if(!$is_create && !empty($args['role'])){
			$blog_id	= $args['blog_id'] ?? 0;
			$result		= $wpjam_user->add_role($args['role'], $blog_id);

			if(is_wp_error($result)){
				return $result;
			}
		}

		$wpjam_user->bind($name, $appid, $openid);
		$wpjam_user->login();

		$user = $wpjam_user->user;

		do_action('wpjam_user_signuped', $user, $args);

		return $user;
	}

	public static function get_meta($user_id, ...$args){
		_deprecated_function(__METHOD__, 'WPJAM Basic 6.0', 'wpjam_get_metadata');
		return wpjam_get_metadata('user', $user_id, ...$args);
	}

	public static function update_meta($user_id, ...$args){
		_deprecated_function(__METHOD__, 'WPJAM Basic 6.0', 'wpjam_update_metadata');
		return wpjam_update_metadata('user', $user_id, ...$args);
	}

	public static function update_metas($user_id, $data, $meta_keys=[]){
		_deprecated_function(__METHOD__, 'WPJAM Basic 6.0', 'wpjam_update_metadata');
		return wpjam_update_metadata('user', $user_id, $data, $meta_keys);
	}

	public static function value_callback($meta_key, $user_id){
		return wpjam_get_metadata('user', $user_id, $meta_key);
	}

	public static function validate($user_id){
		$user	= $user_id ? self::get_user($user_id) : null;

		if(!$user || !($user instanceof WP_User)){
			return new WP_Error('user_not_exists', '用户不存在');
		}

		return $user;
	}
}

class WPJAM_Bind extends WPJAM_Register{
	public function __construct($name, $appid, $args=[]){
		$args	= array_merge($args, ['type'=>$name, 'appid'=>$appid]);

		parent::__construct($name.':'.$appid, $args);
	}

	public function get_bind($openid, $bind_field, $unionid=false){
		return $this->get_value($openid, $bind_field, null);
	}

	public function update_bind($openid, $bind_field, $bind_value){
		$user	= $this->get_user($openid);

		if($user && isset($user[$bind_field]) && $user[$bind_field] != $bind_value){
			return $this->update_user($openid, [$bind_field=>$bind_value]);
		}

		return true;
	}

	public function get_appid(){
		return $this->appid;
	}

	public function get_email($openid){
		$domain	= $this->domain ?: $this->appid.'.'.$this->type;

		return $openid.'@'.$domain;
	}

	public function get_avatarurl($openid){
		return $this->get_value($openid, 'avatarurl');
	}

	public function get_nickname($openid){
		return $this->get_value($openid, 'nickname');
	}

	public function get_unionid($openid){
		return $this->get_value($openid, 'unionid');
	}

	public function get_value($openid, $field, $default=''){
		$user	= $this->get_user($openid);

		if($user){
			return $user[$field] ?? $default;
		}

		return $default;
	}

	public function get_openid_by($key, $value){
		return null;
	}

	public function get_user($openid){
		return ['openid'=>$openid];
	}

	public function update_user($openid, $user){
		return true;
	}

	public static function create($name, $appid, $args){
		if(is_array($args)){
			return new WPJAM_Bind($name, $appid, $args);
		}else{
			$model	= $args;
			
			return new $model($appid, []);
		}
	}
}

class WPJAM_Qrcode_Bind extends WPJAM_Bind{
	public function verify_qrcode($scene, $code){
		if(empty($code)){
			return new WP_Error('invalid_code', '验证码不能为空');
		}

		$qrcode	= $this->get_qrcode($scene);

		if(is_wp_error($qrcode)){
			return $qrcode;
		}

		if(empty($qrcode['openid'])){
			return new WP_Error('invalid_code', '请先扫描二维码！');
		}

		if($code != $qrcode['code']){
			return new WP_Error('invalid_code', '验证码错误！');
		}

		$this->cache_delete($scene.'_scene');

		return $qrcode;
	}

	public function scan_qrcode($openid, $scene){
		$qrcode = $this->get_qrcode($scene);

		if(is_wp_error($qrcode)){
			return $qrcode;
		}

		if(!empty($qrcode['openid']) && $qrcode['openid'] != $openid){
			return new WP_Error('qrcode_scaned', '已有用户扫描该二维码！');
		}

		$this->cache_delete($qrcode['key'].'_qrcode');

		if(!empty($qrcode['id']) && !empty($qrcode['bind_callback']) && is_callable($qrcode['bind_callback'])){
			return call_user_func($qrcode['bind_callback'], $openid, $qrcode['id']);
		}else{
			$this->cache_set($scene.'_scene', array_merge($qrcode, ['openid'=>$openid]), 1200);

			return $qrcode['code'];
		}
	}

	public function get_qrcode($scene){
		if(empty($scene)){
			return new WP_Error('invalid_scene', '场景值不能为空');
		}

		$qrcode	= $this->cache_get($scene.'_scene');

		return $qrcode ?: new WP_Error('invalid_scene', '二维码无效或已过期，请刷新页面再来验证！');
	}

	public function create_qrcode($key, $args=[]){}
}

class WPJAM_User_Signup{
	protected $name		= '';
	protected $appid	= '';

	public function __construct($name, $appid){
		$this->name		= $name;
		$this->appid	= $appid;
	}

	public function __call($method, $args){
		return call_user_func_array([wpjam_get_bind_object($this->name, $this->appid), $method], $args);
	}

	public function get_openid($user_id){
		$wpjam_user	= WPJAM_User::get_instance($user_id);

		if($openid = $wpjam_user->get_openid($this->name, $this->appid)){
			return $openid;
		}

		return $this->get_openid_by('user_id', $user_id);
	}

	public function signup($openid, $args){
		return WPJAM_User::signup($this->name, $this->appid, $openid, $args);
	}

	public function bind($openid, $user_id=null){
		$user_id	= $user_id ?? get_current_user_id();

		if(!$user_id || !get_userdata($user_id)){
			return false;
		}

		$wpjam_user	= WPJAM_User::get_instance($user_id);

		return $wpjam_user->bind($this->name, $this->appid, $openid);
	}

	public function unbind($user_id=null){
		$user_id	= $user_id ?? get_current_user_id();
		
		if(!$user_id || !get_userdata($user_id)){
			return false;
		}

		$wpjam_user	= WPJAM_User::get_instance($user_id);
		$wpjam_user->unbind($this->name, $this->appid);
		
		return true;
	}

	public function get_bind_fields(){}

	public function bind_callback(){}
}

class WPJAM_User_Qrcode_Signup extends WPJAM_User_Signup{
	public function __construct($name, $appid){
		parent::__construct($name, $appid);

		wpjam_register_ajax($name.'_qrcode_signup', [
			'nopriv'	=> true, 
			'callback'	=> [$this, 'ajax_qrcode_signup']
		]);
	}

	public function qrcode_signup($scene, $code, $args=[]){
		if($user = apply_filters('wpjam_qrcode_signup', null, $scene, $code)){
			return $user;
		}

		$qrcode	= $this->verify_qrcode($scene, $code);

		if(is_wp_error($qrcode)){
			if($qrcode->get_error_message() == 'invalid_code'){
				do_action('wpjam_qrcode_signup_failed', $scene);
			}

			return $qrcode;
		}

		return $this->signup($qrcode['openid'], $args);
	}

	public function get_ajax_data($action='login'){
		$attr	= wpjam_get_ajax_attributes($this->name.'_qrcode_signup');
		
		if($action == 'bind'){
			$openid	= $this->get_openid(get_current_user_id());
			$attr	+= ['submit_text'=> $openid ? '解除绑定' : '立刻绑定'];
		}

		return $attr+['fields'=>wpjam_fields($this->get_fields($action), ['wrap_tag'=>'p',	'echo'=>false])];
	}

	public function get_fields($action='login', $from='admin'){
		if($action == 'bind'){
			$user_id	= get_current_user_id();
			$openid		= $this->get_openid($user_id);
		}else{
			$openid		= null;
		}

		$fields	= ['action'	=> ['type'=>'hidden',	'value'=>$action]];

		if($openid){
			$view	= '';

			if($avatar = $this->get_avatarurl($openid)){
				$view	.= '<img src="'.str_replace('/132', '/0', $avatar).'" width="272" />'."<br />";
			}

			if($nickname = $this->get_nickname($openid)){
				$view	.= '<strong>'.$nickname.'</strong>';
			}

			$view	= $view ?: $openid;

			return [
				'view'		=> ['type'=>'view',		'title'=>'绑定的微信账号',	'value'=>$view],
				'action'	=> ['type'=>'hidden',	'value'=>'bind'],
				'bind_type'	=> ['type'=>'hidden',	'value'=>'unbind']
			];
		}else{
			if($action == 'bind'){
				$qrcode	= $this->create_qrcode(md5('bind_'.$user_id), ['id'=>$user_id]);
				$title	= '微信扫码，一键绑定';
			}else{
				$qrcode	= $this->create_qrcode(wp_generate_password(32, false, false));
				$title	= '微信扫码，一键登录';
			}

			if(is_wp_error($qrcode)){
				return $qrcode;
			}

			$fields	= [
				'qrcode'	=> ['type'=>'view',		'title'=>$title,	'value'=>'<img src="'.$qrcode['qrcode_url'].'" width="272" />'],
				'code'		=> ['type'=>'number',	'title'=>'验证码',			'class'=>'input',	'required', 'size'=>20],
				'scene'		=> ['type'=>'hidden',	'value'=>$qrcode['scene']],
				'action'	=> ['type'=>'hidden',	'value'=>$action],
			];

			if($action == 'bind'){
				$fields['bind_type']	= ['type'=>'hidden',	'value'=>'bind'];
			}

			return $fields;
		}
	}

	public function get_bind_fields(){
		return $this->get_fields('bind', 'admin');
	}

	public function bind_callback(){
		$user_id	= get_current_user_id();
		
		if(wpjam_get_data_parameter('bind_type') == 'bind'){
			$scene	= wpjam_get_data_parameter('scene');
			$code	= wpjam_get_data_parameter('code');	

			$qrcode	= $this->verify_qrcode($scene, $code);

			if(is_wp_error($qrcode)){
				return $qrcode;
			}

			return $this->bind($qrcode['openid'], $user_id);
		}else{
			$openid	= $this->get_openid($user_id);

			return $this->unbind($user_id, $openid);
		}
	}

	public function ajax_qrcode_signup(){
		$action	= wpjam_get_data_parameter('action');

		if($action == 'bind'){
			$result	= $this->bind_callback();
		}else{
			$scene	= wpjam_get_data_parameter('scene');
			$code	= wpjam_get_data_parameter('code');
			$args	= wpjam_get_data_parameter('args') ?: [];

			$result	= $this->qrcode_signup($scene, $code, $args);
		}

		return is_wp_error($result) ? $result : [];
	}
}

class WPJAM_User_Signup_Type extends WPJAM_Register{
	public function __call($method, $args){
		if(method_exists($this->model, $method)){
			return call_user_func([$this->model, $method], ...$args);
		}
	}

	public function parse_args(){
		$model	= $this->args['model'];

		if(!is_object($model)){
			$this->args['model']	= new $model($this->name, ($this->args['appid'] ?? null));
		}
	}

	public function register_bind_user_action(){
		wpjam_register_list_table_action('bind_user', [
			'title'			=> '绑定用户',
			'capability'	=> is_multisite() ? 'manage_sites' : 'manage_options',
			'callback'		=> [$this, 'bind_user_callback'],
			'fields'		=> [
				'nickname'	=> ['title'=>'用户',		'type'=>'view'],
				'user_id'	=> ['title'=>'用户ID',	'type'=>'text',	'class'=>'all-options',	'description'=>'请输入 WordPress 的用户']
			]
		]);
	}

	public function bind_user_callback($openid, $data){
		$user_id	= $data['user_id'] ?? 0;

		if($user_id){
			if(get_userdata($user_id)){
				return $this->bind($openid, $user_id);
			}else{
				return new WP_Error('invalid_user_id', '无效的用户 ID，请确认之后再试！');
			}
		}else{
			$prev_id	= $this->get_bind($openid, 'user_id');

			if($prev_id && get_userdata($prev_id)){
				return $this->unbind($prev_id, $openid);
			}
		}
	}

	public static function column_callback($user_id){
		$wpjam_user	= WPJAM_User::get_instance($user_id);

		$values 	= [];

		foreach(self::get_registereds() as $name => $object){
			if($openid = $wpjam_user->get_openid($name, $object->appid)){
				$values[]	= $object->title.'：<br />'.$openid;
			}
		}

		return $values ? implode('<br /><br />', $values) : '';
	}

	public static function builtin_page_load(){
		if(self::get_registereds()){
			wpjam_register_list_table_column('openid', ['title'=>'绑定账号',	'order'=>20,	'column_callback'=>[self::class, 'column_callback']]);
		}
	}

	public static function on_admin_init(){
		if(self::get_registereds(['bind'=>true])){
			wpjam_add_menu_page('wpjam-bind', [
				'parent'		=> 'users',
				'menu_title'	=> '账号绑定',			
				'capability'	=> 'read',
				'function'		=> 'tab',
				'order'			=> 20,
				'load_callback'	=> [self::class, 'plugin_page_load']
			]);
		}
	}

	public static function plugin_page_load(){
		$user_id	= get_current_user_id();
		
		foreach(self::get_registereds(['bind'=>true]) as $bind_name => $st_obj){
			wpjam_register_plugin_page_tab($bind_name, [
				'title'			=> $st_obj->title,
				'bind_name'		=> $bind_name,
				'capability'	=> 'read',
				'function'		=> 'form',	
				'form_name'		=> $bind_name.'_bind',
				'fields'		=> [$st_obj, 'get_bind_fields'],
				'callback'		=> [$st_obj, 'bind_callback'],
				'submit_text'	=> $st_obj->get_openid($user_id) ? '解除绑定' : '立刻绑定',
				'response'		=> 'redirect'
			]);

			if(!wp_doing_ajax()){
				add_action('admin_footer', [$st_obj, 'bind_script']);
			}
		}
	}
}