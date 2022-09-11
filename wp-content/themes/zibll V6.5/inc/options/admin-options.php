<?php

$prefix = 'zibll_options';

function zib_csf_admin_options()
{
    //只有后台才执行此代码
    if (!is_admin()) {
        return;
    }

    $prefix    = 'zibll_options';
    $imagepath = get_template_directory_uri() . '/img/';
    $f_imgpath = get_template_directory_uri() . '/inc/csf-framework/assets/images/';
    $new_badge = zib_get_csf_option_new_badge();

    //开始构建
    CSF::createOptions($prefix, array(
        'menu_title'         => 'Zibll主题设置',
        'menu_slug'          => 'zibll_options',
        'framework_title'    => '子比主题',
        'show_in_customizer' => true, //在wp-customize中也显示相同的选项
        'footer_text'        => '更优雅的wordpress主题-Zibll主题 V' . wp_get_theme()['Version'],
        'footer_credit'      => '<i class="fa fa-fw fa-heart-o" aria-hidden="true"></i> ',
        'theme'              => 'light',
    ));

    CSF::createSection($prefix, array(
        'id'    => 'basic',
        'title' => '全局&功能',
        'icon'  => 'fa fa-fw fa-bullseye',
    ));
    CSF::createSection($prefix, array(
        'id'    => 'page',
        'title' => '页面&显示',
        'icon'  => 'fa fa-fw fa-calendar-check-o',
    ));
    CSF::createSection($prefix, array(
        'id'    => 'post',
        'title' => '文章&列表',
        'icon'  => 'fa fa-fw fa-map-o',
    ));
    CSF::createSection($prefix, array(
        'id'    => 'cap',
        'title' => '功能&权限',
        'icon'  => 'fa fa-fw fa-shield',
    ));
    CSF::createSection($prefix, array(
        'id'    => 'user',
        'title' => '用户&互动',
        'icon'  => 'fa fa-fw fa-user-o',
    ));
    CSF::createSection($prefix, array(
        'id'    => 'pay',
        'title' => '商城&付费',
        'icon'  => 'fa fa-fw fa-cart-plus',
    ));
    CSF::createSection($prefix, array(
        'id'    => 'forum',
        'title' => '社区&论坛',
        'icon'  => 'fa fa-fw fa-grav',
    ));

    CSF::createSection($prefix, array(
        'id'    => 'over',
        'title' => '扩展&增强',
        'icon'  => 'fa fa-fw fa-puzzle-piece',
    ));

    //图片设置
    CSF::createSection($prefix, array(
        'parent'      => 'basic',
        'title'       => 'LOGO图像',
        'icon'        => 'fa fa-fw fa-image',
        'description' => '',
        'fields'      => array(
            array(
                'title'   => __('网站图标', 'zib_language'),
                'id'      => 'favicon',
                'desc'    => __('自定义网站图标，也就是favicon.ico(建议48x48)'),
                'default' => $imagepath . 'favicon.png',
                'preview' => true,
                'library' => 'image', 'type' => 'upload',
            ),
            array(
                'title'   => __('桌面图标', 'zib_language'),
                'id'      => 'iconpng',
                'desc'    => __('桌面图标，建议148x148(苹果手机添加到桌面的图标)'),
                'default' => $imagepath . 'icon.png',
                'preview' => true,
                'library' => 'image', 'type' => 'upload',
            ),
            array(
                'title'    => __('网站Logo', 'zib_language'),
                'subtitle' => __('日间主题', 'zib_language'),
                'id'       => 'logo_src',
                'desc'     => __('显示在顶部的Logo 建议高度60px，请使用png格式的透明图片', 'zib_language'),
                'help'     => '如果单张LOGO图能同时适应日间和夜间主题，则仅设置日间主题的logo即可（推荐这样设置）',
                'default'  => $imagepath . 'logo.png',
                'preview'  => true,
                'library'  => 'image',
                'type'     => 'upload',
            ),
            array(
                'title'    => __('网站Logo', 'zib_language'),
                'subtitle' => __('夜间主题', 'zib_language'),
                'id'       => 'logo_src_dark',
                'class'    => 'compact',
                'default'  => $imagepath . 'logo_dark.png',
                'preview'  => true,
                'library'  => 'image', 'type' => 'upload',
            ),
        ),
    ));

    //SEO优化
    CSF::createSection($prefix, array(
        'parent'      => 'basic',
        'title'       => 'SEO优化',
        'icon'        => 'fa fa-fw fa-superpowers',
        'description' => '',
        'fields'      => array(
            array(
                'title'    => __('核心SEO优化', 'zib_language'),
                'subtitle' => __('文章、页面独立SEO设置', 'zib_language'),
                'id'       => 'post_keywords_description_s',
                'desc'     => '开启后会自动为所有页面设置SEO标题、关键词、简介等内容<div style=" color: #f1620f; ">如果您使用了SEO插件且不需要主题添加SEO标题、关键词、简介等内容，可以选择关闭此处</div>',
                'type'     => "switcher",
                'default'  => true,
            ),

            array(
                'title'   => __('SEO连接符', 'zib_language'),
                'id'      => 'connector',
                'desc'    => __('SEO标题连接符（一般为“-”或“_”或者“|”）&#20992;&#23458;&#28304;&#30721;&#32593;', 'zib_language'),
                'default' => '-',
                'type'    => 'text',
            ),
            array(
                'id'          => 'hometitle',
                'title'       => __('网站SEO', 'zib_language'),
                'subtitle'    => 'SEO标题(title)',
                'placeholder' => '自定义网站的SEO标题(title)&#20992;&#23458;&#28304;&#30721;&#32593;',
                'help'        => '站点一句话有吸引力的标题，建议25—35字，如果未设置，则采用“站点标题+副标题”',
                'default'     => '',
                'attributes'  => array(
                    'rows' => 2,
                ),
                'sanitize'    => false,
                'type'        => 'textarea',
            ),
            array(
                'id'          => 'keywords',
                'title'       => ' ',
                'subtitle'    => __('SEO关键字(keywords)', 'zib_language'),
                'placeholder' => '自定义网站的SEO关键字(keywords)&#20992;&#23458;&#28304;&#30721;&#32593;',
                'help'        => '关键字有利于SEO优化，建议个数在5-8个之间，用英文逗号隔开',
                'default'     => '',
                'class'       => 'compact',
                'attributes'  => array(
                    'rows' => 2,
                ),
                'sanitize'    => false,
                'type'        => 'textarea',
            ),
            array(
                'id'          => 'description',
                'title'       => ' ',
                'subtitle'    => __('SEO描述(description)', 'zib_language'),
                'placeholder' => __('自定义网站的SEO描述(description)&#20992;&#23458;&#28304;&#30721;&#32593;', 'zib_language'),
                'class'       => 'compact',
                'help'        => '介绍、描述您的网站，建议字数在40-70之间',
                'default'     => '',
                'attributes'  => array(
                    'rows' => 3,
                ),
                'sanitize'    => false,
                'type'        => 'textarea',
            ),
            array(
                'id'       => 'zib_baidu_push_js',
                'title'    => __('百度SEO', 'zib_language'),
                'subtitle' => __('全站链接自动提交', 'zib_language'),
                'desc'     => '采用百度最新自动提交接口，无需其他设置。开启后自动将网站所有链接推送到百度，可提高收录速度。</br>官方文档：https://ziyuan.baidu.com/college/courseinfo?id=267&page=2#h2_article_title12',
                'type'     => "switcher",
                'default'  => false,
            ),
            array(
                'id'       => 'xzh_post_on',
                'title'    => ' ',
                'subtitle' => __('百度普通收录', 'zib_language'),
                'desc'     => '普通收录，每天可提交最多10万条有价值内容，收录速度较慢',
                'class'    => 'compact',
                'type'     => "switcher",
                'default'  => false,
            ),
            array(
                'id'       => 'xzh_post_daily_push',
                'title'    => ' ',
                'subtitle' => __('百度快速收录', 'zib_language'),
                'desc'     => '快速收录是百度新推出的高效收录接口，目前仅对部分优质站点开放，请确保您的站点以开放快速收录功能',
                'class'    => 'compact',
                'type'     => "switcher",
                'default'  => false,
            ),
            array(
                'id'          => 'xzh_post_token',
                'title'       => ' ',
                'subtitle'    => __('百度准入密钥', 'zib_language'),
                'desc'        => __('开启普通收录或快速收录，则必填此项</br>密钥获取：https://zn.baidu.com/linksubmit', 'zib_language'),
                'default'     => '',
                'placeholder' => '必填项',
                'class'       => 'compact',
                'type'        => 'text',
            ),
            array(
                'title'   => '外链重定向',
                'id'      => 'go_link_s',
                'type'    => 'switcher',
                'desc'    => "开启此功能后，非本站的链接将会重定向至内部链接，点击后延迟跳转，有利于SEO。如果对正常链接造成了影响，请关闭此功能",
                'default' => true,
            ),
            array(
                'dependency' => array('go_link_s', '!=', ''),
                'id'         => 'go_link_post',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => ' ',
                'subtitle'   => '外链重定向对文章内容开启',
            ),

            array(
                'dependency'  => array('go_link_s', '!=', ''),
                'title'       => ' ',
                'subtitle'    => '排除域名',
                'id'          => 'go_link_exclude_domain',
                'class'       => 'compact',
                'placeholder' => '',
                'desc'        => '不使用重定向的域名，直接输入顶级域名，使用逗号或者回车分割，例如：zibll.com,baidu.com,qq.com',
                'attributes'  => array(
                    'rows' => 2,
                ),
                'sanitize'    => false,
                'default'     => '',
                'type'        => 'textarea',
            ),
            array(
                'title'   => __('文章图片自动添加alt', 'zib_language'),
                'id'      => 'post_img_auto_alt',
                'desc'    => '开启后会自动为文章内图片添加alt内容，有助于SEO',
                'type'    => "switcher",
                'default' => true,
            ),
            array(
                'id'      => 'no_categoty',
                'type'    => 'switcher',
                'desc'    => "该功能和no-category插件作用相同，不能同时使用</br>开启后有利于SEO，建议在建站时设置好，后期不轻易修改",
                'default' => false,
                'title'   => '分类url去除category',
            ),
        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'basic',
        'title'       => '常用功能',
        'icon'        => 'fa fa-fw fa-bolt',
        'description' => '',
        'fields'      => array(
            array(
                'title'    => '图像异步懒加载',
                'id'       => 'lazy_posts_thumb',
                'default'  => true,
                'subtitle' => __('文章缩略图懒加载', 'zib_language'),
                'help'     => '开启图片懒加载，当页面滚动到图像位置时候才加载图片，可极大的提高页面访问速度。',
                'type'     => 'switcher',
            ),
            array(
                'title'    => ' ',
                'id'       => 'lazy_avatar',
                'class'    => 'compact',
                'default'  => true,
                'subtitle' => __('头像懒加载', 'zib_language'),
                'type'     => 'switcher',
            ),

            array(
                'title'    => ' ',
                'id'       => 'lazy_posts_content',
                'class'    => 'compact',
                'default'  => false,
                'help'     => '对SEO有一点影响，请酌情开启！',
                'subtitle' => __('文章内容图片懒加载', 'zib_language'),
                'type'     => 'switcher',
            ),
            array(
                'title'    => ' ',
                'id'       => 'lazy_comment',
                'class'    => 'compact',
                'default'  => true,
                'subtitle' => __('评论内容图片懒加载', 'zib_language'),
                'type'     => 'switcher',
            ),

            array(
                'title'    => ' ',
                'id'       => 'lazy_private',
                'class'    => 'compact',
                'default'  => true,
                'subtitle' => __('私信聊天图片懒加载', 'zib_language'),
                'type'     => 'switcher',
            ),
            array(
                'title'    => ' ',
                'id'       => 'lazy_sider',
                'class'    => 'compact',
                'default'  => true,
                'subtitle' => __('幻灯片图片懒加载', 'zib_language'),
                'type'     => 'switcher',
            ),
            array(
                'title'    => ' ',
                'id'       => 'lazy_cover',
                'class'    => 'compact',
                'default'  => true,
                'subtitle' => __('封面图片懒加载', 'zib_language'),
                'type'     => 'switcher',
            ),
            array(
                'title'    => ' ',
                'id'       => 'lazy_other',
                'class'    => 'compact',
                'default'  => true,
                'subtitle' => __('其它图片懒加载', 'zib_language'),
                'type'     => 'switcher',
            ),
            array(
                'title'    => ' ',
                'subtitle' => '懒加载动画效果',
                'id'       => 'lazy_animation',
                'default'  => 'blur',
                'class'    => 'compact',
                'type'     => 'select',
                'options'  => array(
                    'fade'  => __('淡出淡入', 'zib_language'),
                    'blur'  => __('高斯模糊', 'zib_language'),
                    'scale' => __('放大缩小', 'zib_language'),
                ),
            ),
            array(
                'title'    => ' ',
                'subtitle' => '懒加载预载图',
                'id'       => 'thumbnail',
                'class'    => 'compact',
                'desc'     => '图片加载前显示的占位图像',
                'default'  => $imagepath . 'thumbnail.svg',
                'library'  => 'image',
                'type'     => 'upload',
            ),

            array(
                'title'   => '代码高亮',
                'id'      => 'highlight_kg',
                'type'    => 'switcher',
                'default' => true,
                'label'   => '全局开关，不会影响古腾堡块-代码高亮块',
            ),

            array(
                'title'    => ' ',
                'subtitle' => '代码高亮显示行号',
                'id'       => 'highlight_hh',
                'type'     => 'switcher',
                'class'    => 'compact',
                'default'  => false,
            ),

            array(
                'title'    => ' ',
                'subtitle' => '代码高亮显示扩展按钮',
                'id'       => 'highlight_btn',
                'type'     => 'switcher',
                'class'    => 'compact',
                'label'    => '显示切换高亮、复制、新窗口打开三个扩展按钮',
                'default'  => false,
            ),

            array(
                'title'    => '默认主题',
                'subtitle' => '日间亮色模式下->默认主题',
                'id'       => 'highlight_zt',
                'type'     => 'select',
                'class'    => 'compact',
                'default'  => 'enlighter',
                'options'  => array(
                    'enlighter'  => __('浅色: Enlighter'),
                    'bootstrap4' => __('浅色：Bootstrap'),
                    'classic'    => __('浅色：Classic'),
                    'beyond'     => __('浅色：Beyond'),
                    'mowtwo'     => __('浅色：Mowtwo'),
                    'eclipse'    => __('浅色：Eclipse'),
                    'droide'     => __('浅色：Droide'),
                    'minimal'    => __('浅色：Minimal'),
                    'rowhammer'  => __('浅色：Rowhammer'),
                    'godzilla'   => __('浅色：Godzilla'),
                    'dracula'    => __('深色：Dracula'),
                    'atomic'     => __('深色：Atomic'),
                    'monokai'    => __('深色：Monokai'),
                ),
            ),

            array(
                'id'       => 'highlight_dark_zt',
                'title'    => ' ',
                'subtitle' => '夜间深色模式下->默认主题',
                'type'     => 'select',
                'class'    => 'compact',
                'default'  => 'dracula',
                'desc'     => '此为默认设置，古腾堡编辑器中可单独设置主题</br>主题预览地址： https://enlighterjs.org/Theme.Enlighter.html',
                'options'  => array(
                    'dracula'    => __('深色：Dracula'),
                    'atomic'     => __('深色：Atomic'),
                    'monokai'    => __('深色：Monokai'),
                    'enlighter'  => __('浅色: Enlighter'),
                    'bootstrap4' => __('浅色：Bootstrap'),
                    'classic'    => __('浅色：Classic'),
                    'beyond'     => __('浅色：Beyond'),
                    'mowtwo'     => __('浅色：Mowtwo'),
                    'eclipse'    => __('浅色：Eclipse'),
                    'droide'     => __('浅色：Droide'),
                    'minimal'    => __('浅色：Minimal'),
                    'rowhammer'  => __('浅色：Rowhammer'),
                    'godzilla'   => __('浅色：Godzilla'),
                ),
            ),

            array(
                'title'    => ' ',
                'subtitle' => '代码高亮最大高度',
                'id'       => 'highlight_maxheight',
                'class'    => 'compact',
                'desc'     => __('设置为0则不限制高度', 'zib_language'),
                'default'  => 400,
                'max'      => 2000,
                'min'      => 0,
                'step'     => 25,
                'unit'     => 'PX',
                'type'     => 'spinner',
            ),
            array(
                'dependency' => array('highlight_maxheight', '==', 0),
                'type'       => 'submessage',
                'style'      => 'success',
                'content'    => '已设置代码高亮<b>不限制最大高度</b>',
            ),
            array(
                'title'   => __('弹窗通知', 'zib_language'),
                'id'      => 'system_notice_s',
                'help'    => '用户打开网站会自动弹出一个模态框，显示此处的内容',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'dependency' => array('system_notice_s', '!=', ''),
                'id'         => 'system_notice_size',
                'title'      => ' ',
                'subtitle'   => '窗口尺寸',
                'default'    => 'modal-sm',
                'class'      => 'compact',
                'inline'     => true,
                'type'       => 'radio',
                'options'    => array(
                    'modal-sm'   => __('mini', 'zib_language'),
                    'modal-mini' => __('小', 'zib_language'),
                    ''           => __('中', 'zib_language'),
                    'modal-lg'   => __('大', 'zib_language'),
                ),
            ),
            array(
                'dependency' => array('system_notice_s', '!=', ''),
                'id'         => 'system_notice_title_style',
                'title'      => '弹窗标题',
                'subtitle'   => '弹窗标题显示样式',
                'default'    => 'colorful',
                'class'      => 'compact',
                'inline'     => true,
                'type'       => 'radio',
                'options'    => array(
                    'default'  => __('默认样式', 'zib_language'),
                    'colorful' => __('炫彩背景', 'zib_language'),
                ),
            ),
            array(
                'dependency' => array('system_notice_s', '!=', ''),
                'id'         => 'system_notice_title',
                'title'      => ' ',
                'subtitle'   => '标题内容',
                'class'      => 'compact',
                'default'    => '主题模板推荐',
				'placeholder'=>'壹`锋源·码 yf`php.cn',
                'attributes' => array(
                    'rows' => 1,
                ),
                'sanitize'   => false,
                'type'       => 'textarea',
            ),
            array(
                'dependency'   => array(
                    array('system_notice_s', '!=', ''),
                    array('system_notice_title_style', '==', 'colorful'),
                ),
                'id'           => 'system_notice_title_icon',
                'title'        => ' ',
                'subtitle'     => '标题图标',
                'type'         => 'icon',
                'class'        => 'compact',
                'default'      => 'fa fa-heart',
                'button_title' => '选择图标',
            ),
            array(
                'dependency' => array(
                    array('system_notice_s', '!=', ''),
                    array('system_notice_title_style', '==', 'colorful'),
                ),
                'title'      => ' ',
                'subtitle'   => '标题背景主题',
                'id'         => "system_notice_title_class",
                'class'      => 'compact skin-color',
                'default'    => "jb-yellow",
                'type'       => "palette",
                'options'    => CFS_Module::zib_palette(array(), array('c', 'jb')),
            ),
            array(
                'dependency' => array('system_notice_s', '!=', ''),
                'id'         => 'system_notice_content',
                'title'      => '弹窗内容',
                'class'      => 'compact',
                'attributes' => array(
                    'rows' => 3,
                ),
                'sanitize'   => false,
                'type'       => 'textarea',
                'desc'       => '支持HTML代码，请注意代码规范及标签闭合',
                'default'    => '<p class="c-yellow">本站采用子比主题建站</p>
<p>zibll子比主题是一款漂亮优雅的商城资讯类网站主题模板，功能强大，配置简单</p>
这是一条系统弹窗通知示例<br/>
管理员可在<span class="c-blue">主题设置-常用功能-弹窗通知</span>中进行相关设置',
            ),
            array(
                'dependency'   => array('system_notice_s', '!=', ''),
                'id'           => 'system_notice_button',
                'type'         => 'group',
                'max'          => 4,
                'button_title' => '添加按钮',
                'class'        => 'compact',
                'title'        => '弹窗按钮',
                'default'      => array(
                    array(
                        'link'  => array(
                            'url'  => 'https://www.zibll.com/',
                            'text' => '了解子比主题',
                        ),
                        'class' => 'c-blue',
                    ),
                    array(
                        'link'  => array(
                            'url'  => admin_url('admin.php?page=zibll_options#tab=常用功能'),
                            'text' => '立即设置',
                        ),
                        'class' => 'c-green',
                    ),
                ),
                'fields'       => array(
                    array(
                        'id'           => 'link',
                        'type'         => 'link',
                        'title'        => '按钮链接',
                        'add_title'    => '添加链接',
                        'edit_title'   => '编辑链接',
                        'remove_title' => '删除链接',
                    ),
                    array(
                        'dependency' => array('link', '!=', ''),
                        'title'      => '按钮颜色',
                        'id'         => "class",
                        'class'      => 'compact skin-color',
                        'default'    => "c-green",
                        'type'       => "palette",
                        'options'    => CFS_Module::zib_palette(),
                    ),
                ),
            ),
            array(
                'dependency' => array('system_notice_s', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '弹窗按钮圆角显示',
                'id'         => 'system_notice_radius',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => false,
            ),
            array(
                'dependency' => array('system_notice_s', '!=', ''),
                'title'      => '弹窗周期',
                'id'         => 'system_notice_expires',
                'class'      => 'compact',
                'desc'       => __('多少时间内不重复弹窗（允许为小数，为0则每次刷新页面都会弹出）', 'zib_language'),
                'default'    => 24,
                'max'        => 2000,
                'min'        => 0,
                'step'       => 2,
                'unit'       => '小时',
                'type'       => 'spinner',
            ),
        ),
    ));

    CSF::createSection($prefix, array(
        'id'          => 'theme',
        'parent'      => 'basic',
        'title'       => '显示&布局',
        'icon'        => 'fa fa-fw fa-delicious',
        'description' => '',
        'fields'      => array(
            array(
                'title'   => __('侧边栏设置'),
                'type'    => 'content',
                'content' => '在此设置侧边栏的默认状态，同时每篇文章或页面均可单独设置',
            ),
            array(
                'title'    => ' ',
                'class'    => 'compact',
                'subtitle' => '首页显示侧边栏',
                'id'       => 'sidebar_home_s',
                'type'     => "switcher",
                'default'  => false,
            ),

            array(
                'title'    => ' ',
                'subtitle' => '分类页显示侧边栏',
                'class'    => 'compact',
                'id'       => 'sidebar_cat_s',
                'type'     => "switcher",
                'default'  => false,
            ),
            array(
                'title'    => ' ',
                'subtitle' => '标签页显示侧边栏',
                'class'    => 'compact',
                'id'       => 'sidebar_tag_s',
                'type'     => "switcher",
                'default'  => false,
            ),
            array(
                'title'    => ' ',
                'subtitle' => '搜索页显示侧边栏',
                'class'    => 'compact',
                'id'       => 'sidebar_search_s',
                'type'     => "switcher",
                'default'  => false,
            ),
            array(
                'title'    => ' ',
                'subtitle' => '文章页显示侧边栏',
                'class'    => 'compact',
                'id'       => 'sidebar_single_s',
                'type'     => "switcher",
                'default'  => true,
            ),
            array(
                'title'    => ' ',
                'subtitle' => '页面显示侧边栏',
                'class'    => 'compact',
                'id'       => 'sidebar_page_s',
                'type'     => "switcher",
                'default'  => false,
            ),
            array(
                'title'   => '侧边栏布局',
                'id'      => 'sidebar_layout',
                'class'   => 'compact',
                'default' => "right",
                'type'    => "image_select",
                'options' => array(
                    'left'  => $f_imgpath . '2cl.png',
                    'right' => $f_imgpath . '2cr.png',
                ),
            ),

            array(
                'title'    => '布局宽度',
                'subtitle' => '页面布局的最大宽度',
                'id'       => 'layout_max_width',
                'default'  => 1200,
                'desc'     => __('页面宽度已经经过精心的调整，非特殊需求请勿调整，宽度过大会造成显示不协调', 'zib_language'),
                'desc'     => __('页面全局宽度', 'zib_language'),
                'max'      => 1800,
                'min'      => 1200,
                'step'     => 50,
                'unit'     => 'PX',
                'type'     => 'spinner',
            ),
            array(
                'dependency' => array('layout_max_width', '<', 1200),
                'type'       => 'submessage',
                'style'      => 'danger',
                'content'    => '<div style="text-align:center"><b><i class="fa fa-fw fa-ban fa-fw"></i> 页面宽度不能低于1200PX</b></div>',
            ),
            array(
                'title'   => __('默认主题', 'zib_language'),
                'id'      => 'theme_mode',
                'help'    => '主题最高优先级来自用户选择，也就是浏览器缓存，只有当用户未设置主题的时候此选项才有效',
                'default' => "time-auto",
                'type'    => "radio",
                'options' => array(
                    'white-theme' => __('日间亮色主题', 'zib_language'),
                    'dark-theme'  => __('夜间深色主题', 'zib_language'),
                    'time-auto'   => __('早晚8点自动切换', 'zib_language'),
                ),
            ),
            array(
                'title'    => '主题切换按钮',
                'subtitle' => '选择显示按钮显示位置',
                'class'    => 'compact',
                'id'       => 'theme_mode_button',
                'help'     => '如果关闭此功能，则前端不会显示切换按钮',
                'type'     => "checkbox",
                'default'  => array('pc_nav', 'm_menu'),
                'options'  => array(
                    'pc_nav' => __('PC端顶部导航', 'zib_language'),
                    'm_menu' => __('移动端弹出菜单', 'zib_language'),
                ),
            ),
            array(
                'title'    => __("全局主题色", 'zib_language'),
                'subtitle' => '主题高亮颜色',
                'id'       => 'theme_skin_custom',
                'default'  => "",
                'desc'     => __('如需选择下方预置颜色，请先清空上方颜色', 'zib_language'),
                'type'     => "color",
            ),
            array(
                'title'      => ' ',
                'desc'       => '',
                'id'         => "theme_skin",
                'dependency' => array('theme_skin_custom', '==', '', '', 'visible'),
                'class'      => 'compact skin-color',
                'default'    => "f04494",
                'type'       => "palette",
                'options'    => array(
                    'ff1856' => array('#fd2760'),
                    'f04494' => array('#f04494'),
                    'ae53f3' => array('#ae53f3'),
                    '627bf5' => array('#627bf5'),
                    '00a2e3' => array('#00a2e3'),
                    '16b597' => array('#16b597'),
                    '36af18' => array('#36af18'),
                    '8fb107' => array('#8fb107'),
                    'b18c07' => array('#b18c07'),
                    'e06711' => array('#e06711'),
                    'f74735' => array('#f74735'),
                ),
            ),
            array(
                'title'   => '全局关闭背景高斯模糊',
                'desc'    => '在支持的浏览器上部分UI(例如导航栏)会显示背景高斯模糊的特效，但此功能比较消耗浏览器性能</br>部分性能较差的设备可能会有掉帧不流畅的现象，在此处可以一键关闭所有的背景高斯模糊特效',
                'id'      => 'close_backdrop',
                'type'    => 'switcher',
                'default' => false,
            ),
            array(
                'title'    => __('卡片圆角', 'zib_language'),
                'subtitle' => __('页面卡片的圆角尺寸', 'zib_language'),
                'id'       => 'theme_main_radius',
                'default'  => 8,
                'type'     => 'spinner',
                'min'      => 0,
                'max'      => 15,
                'step'     => 1,
                'unit'     => 'PX',
            ),
            array(
                'title'    => __('全局动画'),
                'subtitle' => __('', 'zib_language'),
                'id'       => 'qj_loading',
                'type'     => "switcher",
                'default'  => false,
            ),
            array(
                'id'       => 'qj_dh_xs',
                'title'    => ' ',
                'subtitle' => '页面全局加载loading动画',
                'default'  => 'no1',
                'class'    => 'compact',
                'desc'     => '网络不好，或显示不正常请关闭！',
                'type'     => 'select',
                'options'  => array(
                    'no1'  => __('淡出淡入', 'zib_language'),
                    'no2'  => __('动画2', 'zib_language'),
                    'no3'  => __('动画3', 'zib_language'),
                    'no4'  => __('动画4', 'zib_language'),
                    'no5'  => __('动画5', 'zib_language'),
                    'no6'  => __('动画6', 'zib_language'),
                    'no7'  => __('动画7', 'zib_language'),
                    'no8'  => __('动画8', 'zib_language'),
                    'no9'  => __('动画9', 'zib_language'),
                    'no10' => __('动画10', 'zib_language'),
                ),
            ),
        ),
    ));

    CSF::createSection($prefix, array(
        'id'          => 'theme',
        'parent'      => 'basic',
        'title'       => '搜索功能',
        'icon'        => 'fa fa-fw fa-search',
        'description' => '',
        'fields'      => array(

            array(
                'title'   => '搜索框默认占位符',
                'id'      => 'search_placeholder',
                'type'    => 'text',
                'default' => '开启精彩搜索',
            ),

            array(
                'title'   => '热门搜索',
                'label'   => '展示网站热门搜索关键词',
                'id'      => 'search_popular_key',
                'default' => true,
                'type'    => 'switcher',
            ),

            array(
                'dependency' => array('search_popular_key', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '热门搜索标题',
                'id'         => 'search_popular_title',
                'class'      => 'compact',
                'type'       => 'text',
                'default'    => '热门搜索',
            ),

            array(
                'dependency'  => array('search_popular_key', '!=', ''),
                'title'       => ' ',
                'subtitle'    => '置顶搜索词',
                'id'          => 'search_popular_sticky',
                'class'       => 'compact',
                'placeholder' => '教程,分享,网络科技',
                'desc'        => '在热门搜索中固定的关键词（使用逗号分割，例如：教程,分享,网络科技）',
                'type'        => 'text',
                'default'     => '',
            ),

            array(
                'dependency' => array('search_popular_key', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '关键词最多显示',
                'id'         => 'search_popular_key_num',
                'class'      => 'compact',
                'default'    => 20,
                'type'       => 'spinner',
                'min'        => 10,
                'max'        => 50,
                'step'       => 2,
                'unit'       => '个',
            ),
            array(
                'id'      => 'search_cat',
                'title'   => '分类搜索',
                'label'   => '显示分类搜索选择',
                'default' => true,
                'type'    => 'switcher',
            ),
            array(
                'dependency'  => array('search_cat', '!=', ''),
                'id'          => 'search_cat_in',
                'title'       => ' ',
                'class'       => 'compact',
                'default'     => '',
                'options'     => 'categories',
                'placeholder' => '选择分类',
                'subtitle'    => '默认搜索的分类',
                'chosen'      => true,
                'type'        => 'select',
            ),
            array(
                'dependency'  => array('search_cat', '!=', ''),
                'id'          => 'search_more_cat_obj',
                'title'       => ' ',
                'subtitle'    => '允许用户选择更多分类',
                'default'     => '',
                'class'       => 'compact',
                'desc'        => '允许选择的更多分类，注意没有文章的分类不会显示',
                'placeholder' => '允许选择的更多分类',
                'options'     => 'categories',
                'type'        => 'select',
                'chosen'      => true,
                'multiple'    => true,
                'sortable'    => true,
            ),
            array(
                'id'      => 'search_type',
                'title'   => '类型搜索',
                'label'   => '允许用户切换搜索类型(文章，用户，板块，帖子)',
                'default' => true,
                'type'    => 'switcher',
            ),
            array(
                'dependency' => array('search_type', '!=', ''),
                'id'         => 'search_type_in',
                'default'    => 'post',
                'type'       => 'radio',
                'title'      => ' ',
                'class'      => 'compact',
                'subtitle'   => '默认选择的类型',
                'inline'     => true,
                'options'    => 'zib_get_search_types',
            ),
            array(
                'title'   => '搜索文章排除页面',
                'id'      => 'search_no_page',
                'label'   => '搜索文章时排除页面',
                'type'    => 'switcher',
                'default' => false,
            ),
            array(
                'id'      => 'search_history',
                'title'   => '搜索历史',
                'label'   => '显示用户搜索历史关键词',
                'default' => true,
                'type'    => 'switcher',
            ),
            array(
                'id'      => 'search_posts',
                'title'   => '热门文章',
                'label'   => '在顶部搜索框显示热门文章',
                'default' => true,
                'type'    => 'switcher',
            ),
            array(
                'id'      => '404_search_s',
                'title'   => '404页面搜索',
                'label'   => '在404页面显示搜索功能',
                'default' => true,
                'type'    => 'switcher',
            ),
        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'basic',
        'title'       => '手机底部Tab',
        'icon'        => 'fa fa-fw fa-tablet',
        'description' => '',
        'fields'      => array(
            array(
                'type'    => 'submessage',
                'style'   => 'warning',
                'content' => '<b>移动端底部Tab导航：</b>在移动端固定显示在最底部的tab导航按钮，支持排序和添加删除，注意开启后按钮不宜过多 | <a target="_blank" href="https://www.zibll.com/2983.html">查看官网教程</a>',
            ),
            array(
                'title'   => __('手机底部Tab', 'zib_language'),
                'label'   => '开启',
                'id'      => 'footer_tabbar_s',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'title'   => __('页面滚动时隐藏', 'zib_language'),
                'label'   => '开启',
                'id'      => 'footer_tabbar_scroll_hide',
                'type'    => 'switcher',
                'default' => false,
            ),
            array(
                'title'                  => '默认显示',
                'subtitle'               => '选择并排序默认显示的按钮',
                'id'                     => 'footer_tabbar',
                'type'                   => 'group',
                'accordion_title_number' => '1',
                'sanitize'               => false,
                'button_title'           => '添加按钮',
                'default'                => array(
                    array(
                        'type'      => 'home',
                        'icon'      => 'zibsvg-home-color',
                        'icon_size' => 24,
                        'ontop'     => true,
                    ),
                    array(
                        'type'      => 'link',
                        'icon'      => 'zibsvg-tag-color',
                        'link'      => home_url('author/1'),
                        'icon_size' => 24,
                    ),
                    array(
                        'type'      => 'add',
                        'icon'      => 'zibsvg-add-color',
                        'icon_size' => 46,
                        'btns'      => array('post', 'bbs_topic', 'bbs_plate', 'bbs_posts'),
                    ),
                    array(
                        'type'      => 'msg',
                        'icon'      => 'zibsvg-msg-color',
                        'icon_size' => 24,
                    ),
                    array(
                        'type'      => 'user',
                        'icon'      => 'zibsvg-user-color-2',
                        'icon_size' => 24,
                    ),
                ),
                'fields'                 => array(
                    array(
                        'id'      => 'type',
                        'default' => 'round',
                        'type'    => 'select',
                        'title'   => '按钮类型',
                        'options' => array(
                            'home'    => __('首页', 'zib_language'),
                            'link'    => __('链接', 'zib_language'),
                            'user'    => __('用户中心', 'zib_language'),
                            'msg'     => __('消息中心', 'zib_language'),
                            'add'     => __('[Add]投稿、发帖', 'zib_language'),
                            //定制开始
                            'pay_vip' => __('开通会员', 'zib_language'),
                            //定制结束
                        ),
                    ),
                    array(
                        'dependency' => array('type', '==', 'link'),
                        'title'      => '链接地址',
                        'id'         => 'link',
                        'type'       => 'text',
                        'default'    => '',
                    ),
                    array(
                        'dependency' => array('type', '==', 'home'),
                        'title'      => '返回顶部按钮',
                        'id'         => 'ontop',
                        'type'       => 'switcher',
                        'default'    => true,
                        'label'      => '页面滚动到下方时候，切换显示为返回顶部按钮',
                    ),
                    array(
                        'dependency' => array('type|ontop', '==|!=', 'home|'),
                        'title'      => ' ',
                        'subtitle'   => '返回顶部按钮文字',
                        'class'      => 'compact',
                        'id'         => 'ontop_text',
                        'type'       => 'text',
                        'default'    => '',
                    ),
                    array(
                        'dependency'  => array('type', '==', 'add'),
                        'id'          => 'btns',
                        'title'       => '选择按钮',
                        'subtitle'    => '',
                        'default'     => array('post'),
                        'desc'        => '选择并排序按钮，未开启的功能不会显示',
                        'placeholder' => '请选择按钮',
                        'options'     => 'zib_new_add_btns_options',
                        'type'        => 'select',
                        'chosen'      => true,
                        'multiple'    => true,
                        'sortable'    => true,
                    ),
                    array(
                        'title'   => '按钮文字',
                        'id'      => 'text',
                        'type'    => 'text',
                        'default' => '',
                        'desc'    => '允许为空，如果文字为空则建议所有按钮均为空，以保证整体美观度',
                    ),
                    array(
                        'dependency' => array('type|type', '!=|!=', 'msg|add'),
                        'title'      => '按钮徽章',
                        'id'         => 'badge',
                        'type'       => 'text',
                        'default'    => '',
                        'desc'       => '显示在按钮右上角的红色徽章',
                    ),
                    array(
                        'dependency'   => array('icon_c', '==', '', '', 'visible'),
                        'id'           => 'icon',
                        'type'         => 'icon',
                        'desc'         => '按钮默认显示的图标，可以选择内置图标，也可以自定义任意图标代码，自定义图标HTML代码，请注意代码规范',
                        'title'        => '按钮默认图标',
                        'button_title' => '选择预置图标',
                        'default'      => '',
                    ),
                    array(
                        'title'      => ' ',
                        'subtitle'   => '自定义图标代码',
                        'class'      => 'compact',
                        'id'         => 'icon_c',
                        'default'    => '',
                        'sanitize'   => false,
                        'type'       => 'textarea',
                        'attributes' => array(
                            'rows' => 2,
                        ),
                    ),
                    array(
                        'dependency' => array('type|ontop', '==|!=', 'home|'),
                        'title'      => ' ',
                        'subtitle'   => '自定义返回顶部图标代码',
                        'id'         => 'ontop_icon',
                        'default'    => '',
                        'sanitize'   => false,
                        'type'       => 'textarea',
                        'attributes' => array(
                            'rows' => 2,
                        ),
                    ),
                    array(
                        'id'      => 'icon_size',
                        'title'   => '图标大小',
                        'desc'    => '',
                        'default' => 24,
                        'max'     => 50,
                        'min'     => 16,
                        'step'    => 1,
                        'unit'    => 'px',
                        'type'    => 'slider',
                    ),
                ),
            ),
            array(
                'title'    => '文章页面显示',
                'subtitle' => '配置文章页面显示的按钮',
                'id'       => 'footer_tabbar_single',
                'type'     => 'fieldset',
                'fields'   => array(
                    array(
                        'id'      => 's',
                        'default' => 'extend',
                        'type'    => 'radio',
                        'title'   => '显示内容',
                        'desc'    => '文章扩展按钮为文章评论、收藏、分享按钮',
                        'inline'  => true,
                        'options' => array(
                            'extend'  => __('文章扩展按钮', 'zib_language'),
                            'default' => __('默认按钮', 'zib_language'),
                        ),
                    ),
                ),
            ),
        ),
    ));

    //------------------------------------------------------------------------
    CSF::createSection($prefix, array(
        'parent'      => 'basic',
        'title'       => '悬浮按钮',
        'icon'        => 'fa fa-fw fa-thumb-tack',
        'description' => '',
        'fields'      => array(
            array(
                'type'    => 'submessage',
                'style'   => 'warning',
                'content' => '<b>全局悬浮按钮：</b>显示在页面右侧的悬浮按钮，支持排序及添加自定义按钮',
            ),
            array(
                'id'      => 'float_btn_style',
                'default' => 'round',
                'type'    => 'radio',
                'title'   => '按钮样式',
                'inline'  => true,
                'options' => array(
                    'round'  => __('圆角按钮', 'zib_language'),
                    'square' => __('方形按钮', 'zib_language'),
                ),
            ),
            array(
                'id'      => 'float_btn_position',
                'default' => 'bottom',
                'type'    => 'radio',
                'title'   => '显示位置',
                'inline'  => true,
                'options' => array(
                    'center' => __('右侧居中', 'zib_language'),
                    'bottom' => __('右侧底部', 'zib_language'),
                ),
            ),
            array(
                'title'   => '背景高斯模糊',
                'id'      => 'float_btn_filter_css',
                'type'    => "checkbox",
                'inline'  => true,
                'desc'    => __('开启后如果按钮过多会影响浏览器性能，部分性能较低的设备会不流畅', 'zib_language'),
                'options' => array(
                    'pc_s' => 'PC端开启',
                    'm_s'  => '移动端开启',
                ),
                'default' => array('m_s'),
            ),
            array(
                'title'   => __('页面滚动时隐藏', 'zib_language'),
                'label'   => '开启',
                'id'      => 'float_btn_scroll_hide',
                'type'    => 'switcher',
                'default' => false,
            ),
            array(
                'id'       => 'float_btn',
                'type'     => 'sortable',
                'title'    => '悬浮按钮',
                'subtitle' => '设置并排序需要显示的按钮',
                'default'  => array(
                    'more'           => array(array(
                        'link'        => array(),
                        'color'       => array(
                            'color' => '',
                            'bg'    => 'rgba(255, 111, 6, 0.2)',
                        ),
                        'icon'        => 'zibsvg-gift-color',
                        'desc'        => '本站同款主题模板',
                        'pc_s'        => true,
                        'm_s'         => true,
                        'hover_width' => 240,
                        'hover'       => '<a href="https://www.zibll.com/" target="_blank">
    <div class="flex c-red">
        <img class="flex0" alt="zibll子比主题" src="' . $imagepath . 'favicon.png" height="30">
        <div class="flex1 ml10">
            <dt>本站同款主题模板</dt>
            <div class="px12 mt10 muted-color">zibll子比主题是一款漂亮优雅的网站主题模板，功能强大，配置简单。</div>
            <div class="but mt10 p2-10 c-blue btn-block px12">查看详情</div>
        </div>
    </div>
</a>',
                    )),
                    'pay_vip'        => array(
                        'pc_s'  => true,
                        'm_s'   => true,
                        'color' => array(
                            'color' => '#f2c97d',
                            'bg'    => 'rgba(62,62,67,0.9)',
                        ),
                    ),
                    'add'            => array(
                        'pc_s'  => true,
                        'm_s'   => false,
                        'icon'  => 'zibsvg-add-ring',
                        'btns'  => array('post', 'bbs_topic', 'bbs_plate', 'bbs_posts'),
                        'color' => array(
                            'color' => '',
                            'bg'    => '',
                        ),
                    ),
                    'service_qq'     => array(
                        'pc_s'  => false,
                        'm_s'   => false,
                        'qq'    => '',
                        'color' => array(
                            'color' => '',
                            'bg'    => '',
                        ),
                    ),
                    'service_wechat' => array(
                        'pc_s'       => true,
                        'm_s'        => true,
                        'wechat_img' => $imagepath . 'qrcode.png',
                        'color'      => array(
                            'color' => '',
                            'bg'    => '',
                        ),
                    ),
                    'theme_mode'     => array(
                        'pc_s'  => false,
                        'm_s'   => false,
                        'color' => array(
                            'color' => '',
                            'bg'    => '',
                        ),
                    ),
                    'qrcode'         => array(
                        'pc_s'  => true,
                        'm_s'   => false,
                        'color' => array(
                            'color' => '',
                            'bg'    => '',
                        ),
                        'desc'  => '在手机上浏览此页面',
                    ),
                    'back_top'       => array(
                        'pc_s'  => _pz('float_right_ontop', true),
                        'm_s'   => _pz('float_right_mobile_show', true),
                        'color' => array(
                            'color' => '',
                            'bg'    => '',
                        ),
                    ),
                ),

                'fields'   => array(
                    array(
                        'title'      => '返回顶部',
                        'desc'       => '<div class="c-yellow"><i class="fa fa-fw fa-info-circle fa-fw"></i>此按钮只能放置在最顶部或者最底部！</div>',
                        'id'         => 'back_top',
                        'type'       => 'accordion',
                        'accordions' => array(
                            array(
                                'title'  => '返回顶部',
                                'fields' => array(
                                    CFS_Module::float_btn()[0],
                                    CFS_Module::float_btn()[1],
                                    CFS_Module::float_btn()[2],
                                ),
                            ),
                        ),
                    ),
                    array(
                        'title'      => '当前页面二维码',
                        'id'         => 'qrcode',
                        'type'       => 'accordion',
                        'accordions' => array(
                            array(
                                'title'  => '当前页面二维码',
                                'fields' => array(
                                    CFS_Module::float_btn()[0],
                                    CFS_Module::float_btn()[1],
                                    CFS_Module::float_btn()[2],
                                    array(
                                        'class' => 'desc',
                                        'id'    => 'desc',
                                        'type'  => 'text',
                                        'title' => '一句话简介',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    array(
                        'title'      => 'Add发布内容',
                        'id'         => 'add',
                        'desc'       => '<div class="c-yellow"><i class="fa fa-fw fa-info-circle fa-fw"></i>此按钮尽量放在上方，否则会显示遮挡</div>',
                        'type'       => 'accordion',
                        'accordions' => array(
                            array(
                                'title'  => '发布投稿、板块、帖子等',
                                'fields' => array(
                                    CFS_Module::float_btn()[0],
                                    CFS_Module::float_btn()[1],
                                    CFS_Module::float_btn()[2],
                                    array(
                                        'id'          => 'btns',
                                        'title'       => '选择按钮',
                                        'subtitle'    => '',
                                        'default'     => array('post'),
                                        'desc'        => '选择并排序按钮，未开启的功能不会显示',
                                        'placeholder' => '请选择按钮',
                                        'options'     => 'zib_new_add_btns_options',
                                        'type'        => 'select',
                                        'chosen'      => true,
                                        'multiple'    => true,
                                        'sortable'    => true,
                                    ),
                                    array(
                                        'id'           => 'icon',
                                        'type'         => 'icon',
                                        'title'        => '按钮图标',
                                        'class'        => 'compact',
                                        'button_title' => '选择图标',
                                        'default'      => 'fa fa-heart',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    array(
                        'title'      => '日夜主题切换',
                        'id'         => 'theme_mode',
                        'type'       => 'accordion',
                        'accordions' => array(
                            array(
                                'title'  => '日夜主题切换',
                                'fields' => array(
                                    CFS_Module::float_btn()[0],
                                    CFS_Module::float_btn()[1],
                                    CFS_Module::float_btn()[2],
                                ),
                            ),
                        ),
                    ),
                    array(
                        'title'      => 'VIP购买',
                        'id'         => 'pay_vip',
                        'type'       => 'accordion',
                        'accordions' => array(
                            array(
                                'title'  => 'VIP购买',
                                'fields' => array(
                                    CFS_Module::float_btn()[0],
                                    CFS_Module::float_btn()[1],
                                    CFS_Module::float_btn()[2],
                                ),
                            ),
                        ),
                    ),
                    array(
                        'title'      => 'QQ客服',
                        'id'         => 'service_qq',
                        'type'       => 'accordion',
                        'accordions' => array(
                            array(
                                'title'  => 'QQ客服',
                                'fields' => array(
                                    CFS_Module::float_btn()[0],
                                    CFS_Module::float_btn()[1],
                                    CFS_Module::float_btn()[2],
                                    array(
                                        'class' => 'compact',
                                        'id'    => 'qq',
                                        'type'  => 'text',
                                        'title' => 'QQ号码',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    array(
                        'title'      => '微信客服',
                        'id'         => 'service_wechat',
                        'type'       => 'accordion',
                        'accordions' => array(
                            array(
                                'title'  => '微信客服',
                                'fields' => array(
                                    CFS_Module::float_btn()[0],
                                    CFS_Module::float_btn()[1],
                                    CFS_Module::float_btn()[2],
                                    array(
                                        'class'   => 'compact',
                                        'id'      => 'wechat_img',
                                        'type'    => 'text',
                                        'title'   => '微信二维码',
                                        'library' => 'image',
                                        'type'    => 'upload',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    array(
                        'title'        => '更多按钮',
                        'subtitle'     => '添加更多自定义按钮',
                        'id'           => 'more',
                        'type'         => 'group',
                        'button_title' => '添加按钮',
                        'min'          => '1',
                        'desc'         => '此处内容至少保留一个，如一个都无需显示请关闭PC端和移动端显示即可',
                        'fields'       => array(
                            array(
                                'title' => '按钮简介',
                                'id'    => 'desc',
                                'type'  => 'text',
                            ),
                            array(
                                'id'           => 'icon',
                                'type'         => 'icon',
                                'title'        => '按钮图标',
                                'class'        => 'compact',
                                'button_title' => '选择图标',
                                'default'      => 'fa fa-heart',
                            ),
                            array(
                                'dependency'   => array('hover', '==', '', '', 'visible'),
                                'id'           => 'link',
                                'type'         => 'link',
                                'title'        => '按钮链接',
                                'class'        => 'compact',
                                'add_title'    => '添加链接',
                                'edit_title'   => '编辑链接',
                                'remove_title' => '删除链接',
                            ),
                            array(
                                'title'      => '悬浮内容',
                                'subtitle'   => __('鼠标移到此处时显示内容', 'zib_language'),
                                'desc'       => '设置此处后，按钮链接将失效</br>支持HTML代码，请注意代码规范及标签闭合',
                                'class'      => 'compact',
                                'id'         => 'hover',
                                'default'    => '',
                                'sanitize'   => false,
                                'type'       => 'textarea',
                                'attributes' => array(
                                    'rows' => 2,
                                ),
                            ),
                            array(
                                'dependency' => array('hover', '!=', ''),
                                'title'      => ' ',
                                'subtitle'   => '悬浮内容宽度',
                                'id'         => 'hover_width',
                                'class'      => 'compact',
                                'default'    => 200,
                                'max'        => 500,
                                'min'        => 50,
                                'step'       => 10,
                                'unit'       => 'PX',
                                'desc'       => '移动端宽度最大240px',
                                'type'       => 'spinner',
                            ),
                            CFS_Module::float_btn()[0],
                            CFS_Module::float_btn()[1],
                            CFS_Module::float_btn()[2],
                        ),
                    ),
                ),
            ),
        ),
    ));

    //-----------------------------------------------------------------
    CSF::createSection($prefix, array(
        'parent'      => 'basic',
        'title'       => 'Email邮件',
        'icon'        => 'fa fa-fw fa-envelope-o',
        'description' => '',
        'fields'      => array(
            array(
                'title'    => __('管理员邮件推送', 'zib_language'),
                'subtitle' => '链接提交邮件',
                'label'    => '前台有新的链接提交 向管理员发送邮件',
                'id'       => 'email_links_submit_to_admin',
                'type'     => 'switcher',
                'default'  => true,
                'desc'     => '',
            ),

            array(
                'id'       => 'email_payment_order_to_admin',
                'class'    => 'compact',
                'type'     => 'switcher',
                'default'  => true,
                'title'    => ' ',
                'subtitle' => '新订单邮件',
                'label'    => '用户支付订单后 向管理员发送邮件',
            ),

            array(
                'dependency' => array('pay_rebate_s', '!=', '', 'all'),
                'id'         => 'email_apply_withdraw_to_admin',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => ' ',
                'subtitle'   => '提现邮件',
                'label'      => '用户申请提现 向管理员发送邮件',
            ),
            array(
                'id'       => 'email_newpost_contribution_to_admin',
                'class'    => 'compact',
                'type'     => 'switcher',
                'default'  => true,
                'title'    => ' ',
                'subtitle' => '投稿待审核通知邮件',
                'label'    => '有用户投稿待审核时 向管理员发送邮件',
            ),
            array(
                'dependency' => array('bbs_s', '!=', '', 'all'),
                'id'         => 'email_bbs_posts_pending_to_admin',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => ' ',
                'subtitle'   => '帖子待审核通知邮件',
                'label'      => '[论坛]有用户发帖待审核时 向管理员发送邮件',
            ),
            array(
                'dependency' => array('bbs_s', '!=', '', 'all'),
                'id'         => 'email_bbs_posts_pending_to_moderator',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => ' ' . $new_badge['6.4'],
                'subtitle'   => '帖子待审核通知邮件',
                'label'      => '[论坛]有用户发帖待审核时 向版主发送邮件(需拥有审核权限)',
            ),
            array(
                'dependency' => array('user_auth_s', '!=', '', 'all'),
                'id'         => 'email_auth_apply_to_admin',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => ' ',
                'subtitle'   => '身份认证通知邮件',
                'label'      => '有用户申请身份认证 向管理员发送邮件',
            ),
            array(
                'dependency' => array('user_ban_s', '!=', '', 'all'),
                'id'         => 'email_ban_appeal_to_admin',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => ' ',
                'subtitle'   => '帐号申诉通知邮件',
                'label'      => '有用户帐号禁封申诉 向管理员发送邮件',
            ),
            array(
                'dependency' => array('user_report_s', '!=', '', 'all'),
                'id'         => 'email_report_to_admin',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => ' ',
                'subtitle'   => '举报通知邮件',
                'label'      => '收到举报信息 向管理员发送邮件',
            ),
            array(
                'dependency' => array('bbs_s', '!=', '', 'all'),
                'id'         => 'email_bbs_apply_moderator_to_admin',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => ' ',
                'subtitle'   => '版主申请通知邮件',
                'label'      => '[论坛]有用户申请版主 向管理员和超级版主发送邮件',
            ),
            array(
                'title'    => __('用户邮件推送', 'zib_language'),
                'id'       => 'email_payment_order',
                'type'     => 'switcher',
                'default'  => true,
                'subtitle' => '新订单邮件',
                'label'    => '用户支付订单后 向用户发送邮件',
            ),
            array(
                'dependency' => array('pay_rebate_s', '!=', '', 'all'),
                'id'         => 'email_withdraw_process',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => ' ',
                'subtitle'   => '提现通知邮件',
                'label'      => '处理用户提现申请后 向用户发送邮件',
            ),
            array(
                'dependency' => array('pay_rebate_s', '!=', '', 'all'),
                'id'         => 'email_payment_order_to_referrer',
                'class'      => 'compact',
                'type'       => 'switcher',
                'decs'       => __('当订单有返佣时，向推荐人发送订单及佣金信息', 'zib_language'),
                'default'    => true,
                'title'      => ' ',
                'subtitle'   => '佣金通知邮件',
                'label'      => '用户支付订单后 向推荐人发送邮件',
            ),
            array(
                'dependency' => array('pay_income_s', '!=', '', 'all'),
                'id'         => 'email_payment_order_to_income',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => ' ',
                'subtitle'   => '分成通知邮件',
                'label'      => '用户支付订单后 有创作分成时，向分成作者发送邮件',
            ),
            array(
                'id'       => 'email_comment_approved',
                'class'    => 'compact',
                'type'     => 'switcher',
                'default'  => true,
                'title'    => ' ',
                'subtitle' => '评论审核邮件',
                'label'    => '评论通过审核后 向用户发送邮件',
            ),
            array(
                'id'       => 'email_comment_toparent',
                'class'    => 'compact',
                'type'     => 'switcher',
                'default'  => true,
                'title'    => ' ',
                'subtitle' => '评论回复通知邮件',
                'label'    => '评论有新的回复 向用户发送邮件',
            ),
            array(
                'id'       => 'email_newpost_to_publish',
                'class'    => 'compact',
                'type'     => 'switcher',
                'default'  => true,
                'title'    => ' ',
                'subtitle' => '内容审核邮件',
                'label'    => '投稿、发帖通过审核后 向用户发送邮件',
            ),
            array(
                'id'       => 'email_update_bind_phone',
                'class'    => 'compact',
                'type'     => 'switcher',
                'default'  => true,
                'title'    => ' ',
                'subtitle' => '手机号修改通知邮件',
                'label'    => '用户修改绑定手机号 向用户发送邮件',
            ),
            array(
                'dependency' => array('user_auth_s', '!=', '', 'all'),
                'id'         => 'email_auth_apply_process',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => ' ',
                'subtitle'   => '身份认证通知邮件',
                'label'      => '处理用户身份认证申请后 向用户发送邮件',
            ),
            array(
                'dependency' => array('user_ban_s', '!=', '', 'all'),
                'id'         => 'email_updata_user_ban',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => ' ',
                'subtitle'   => '帐号禁封通知邮件',
                'label'      => '用户帐号禁封、解封 向用户发送邮件',
            ),
            array(
                'dependency' => array('user_report_s', '!=', '', 'all'),
                'id'         => 'email_report_process',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => ' ',
                'subtitle'   => '举报反馈邮件',
                'label'      => '处理用户举报后 向用户发送邮件',
            ),
            array(
                'dependency' => array('bbs_s', '!=', '', 'all'),
                'id'         => 'email_bbs_apply_moderator_reply',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => ' ',
                'subtitle'   => '版主申请通知邮件',
                'label'      => '[论坛]处理用户版主申请后 向用户发送邮件',
            ),
            array(
                'dependency' => array('bbs_s', '!=', '', 'all'),
                'id'         => 'email_bbs_moderator_remove',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => ' ',
                'subtitle'   => '版主移出通知邮件',
                'label'      => '[论坛]将用户版主/分区版主身份移出后 向用户发送邮件',
            ),
            array(
                'dependency' => array('bbs_s', '!=', '', 'all'),
                'id'         => 'email_bbs_answer_adopted',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => ' ',
                'subtitle'   => '回答被采纳',
                'label'      => '[论坛]回答被采纳后 向用户发送邮件',
            ),

            array(
                'dependency' => array('message_s|private_s', '!=|!=', '|', 'all'),
                'id'         => 'email_private_receive',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => false,
                'title'      => ' ',
                'subtitle'   => '私信通知邮件',
                'label'      => '收到私信后 向收信用户发送邮件',
            ),
            array(
                'dependency' => array('message_s|private_s|email_private_receive', '!=|!=|!=', '||', 'all'),
                'id'         => 'email_private_receive_limit',
                'type'       => 'radio',
                'class'      => 'compact',
                'title'      => ' ',
                'subtitle'   => '私信邮件用户组',
                'desc'       => '允许哪些用户收到私信后进行邮件通知',
                'default'    => 'all',
                'inline'     => true,
                'options'    => array(
                    'all'   => __('所有用户', 'zib_language'),
                    'vip'   => '所有会员',
                    'vip2'  => '仅' . _pz('pay_user_vip_2_name', '二级会员'),
                    'admin' => __('仅管理员', 'zib_language'),
                ),
            ),
            array(
                'title'   => __('自定义发件人', 'zib_language'),
                'id'      => 'mail_showname',
                'desc'    => '自定义邮件发件人昵称（仅部分邮箱服务器有效）',
                'default' => get_bloginfo('title'),
                'type'    => 'text',
            ),
            array(
                'title'      => __('添加邮件内容', 'zib_language'),
                'subtitle'   => __('额外内容一', 'zib_language'),
                'desc'       => '建议为本站简介，请注意控制字数，此处内容最多显示三行',
                'id'         => 'mail_description',
                'default'    => '此信为系统邮件，请不要直接回复。',
                'sanitize'   => false,
                'type'       => 'textarea',
                'attributes' => array(
                    'rows' => 3,
                ),
            ),
            array(
                'title'      => ' ',
                'subtitle'   => __('额外内容二', 'zib_language'),
                'desc'       => '建议为其它链接，请注意控制字数，此处内容最多显示一行</br>支持HTML代码，请注意代码规范及标签闭合</br>由于不同邮件服务商的代码支持不同，请使用较为基础的html代码',
                'class'      => 'compact',
                'id'         => 'mail_more_content',
                'default'    => '<a href="' . get_bloginfo('url') . '">访问网站</a> |
<a href="#">联系站长</a>',
                'sanitize'   => false,
                'type'       => 'textarea',
                'attributes' => array(
                    'rows' => 2,
                ),
            ),
            array(
                'title'   => '邮件SMTP',
                'id'      => 'mail_smtps',
                'type'    => 'switcher',
                'default' => false,
            ),
            array(
                'dependency' => array('mail_smtps', '!=', ''),
                'type'       => 'submessage',
                'style'      => 'warning',
                'content'    => 'WordPress配置SMTP邮箱，解决邮件发送问题。功能和SMTP插件一致，所以！不能和其他SMTP插件一起开启！同时请注意开启服务器对应的端口！ <a target="_blank" href="https://www.zibll.com/720.html" class="loginbtn">查看官网教程</a>',
            ),

            array(
                'dependency' => array('mail_smtps', '!=', ''),
                'title'      => 'SMTP配置',
                'subtitle'   => '发信人邮箱账号',
                'class'      => 'compact',
                'id'         => 'mail_name',
                'class'      => 'compact-heading',
                'default'    => '88888888@qq.com',
                'validate'   => 'csf_validate_email',
                'type'       => 'text',
            ),

            array(
                'dependency' => array('mail_smtps', '!=', ''),
                'id'         => 'mail_passwd',
                'class'      => 'compact',
                'title'      => 'SMTP服务邮箱密码',
                'desc'       => '此密码非邮箱密码，一般需要单独开启',
                'default'    => '',
                'type'       => 'text',
            ),

            array(
                'dependency' => array('mail_smtps', '!=', ''),
                'id'         => 'mail_host',
                'class'      => 'compact',
                'title'      => '邮件服务器地址',
                'default'    => 'smtp.qq.com',
                'type'       => 'text',
            ),

            array(
                'dependency' => array('mail_smtps', '!=', ''),
                'id'         => 'mail_port',
                'class'      => 'compact',
                'title'      => 'SMTP服务器端口',
                'default'    => '465',
                'type'       => 'number',
            ),

            array(
                'dependency' => array('mail_smtps', '!=', ''),
                'title'      => 'SMTPAuth服务',
                'id'         => 'mail_smtpauth',
                'type'       => 'switcher',
                'class'      => 'compact',
                'default'    => true,
            ),

            array(
                'dependency' => array('mail_smtps', '!=', ''),
                'title'      => '加密方式（SMTPSecure）',
                'id'         => 'mail_smtpsecure',
                'class'      => 'compact',
                'default'    => 'ssl',
                'type'       => 'text',
            ),
            CFS_Module::email_test(),
        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'basic',
        'title'       => '自定义代码',
        'icon'        => 'fa fa-fw fa-code',
        'description' => '',
        'fields'      => array(
            array(
                'content' => '<p><b>自定义代码提醒事项：</b></p><li>任何情况下都不建议修改主题源文件，自定义代码可放于此处</li><li>在此处添加的自定义代码会保存到数据库，不会因主题升级而丢失</li><li>使用自义定代码，需要有一定的代码基础</li><li>代码不规范、或代码错误将会引起意料不到的问题</li><li>如果网站遇到未知错误，请首先检查此处的代码是否规范、无误</li>',
                'style'   => 'warning',
                'type'    => 'submessage',
            ),
            array(
                'title'    => __('自定义CSS样式', 'zib_language'),
                'subtitle' => '位于&lt;/head&gt;之前，直接写样式代码，不用添加&lt;style&gt;标签',
                'id'       => 'csscode',
                'default'  => '',
                'settings' => array(
                    'mode'  => 'css',
                    'theme' => 'dracula',
                ),
                'sanitize' => false,
                'type'     => 'code_editor',
            ),
            array(
                'title'    => __('自定义javascript代码', 'zib_language'),
                'subtitle' => '位于底部，直接填写JS代码，不需要添加&lt;script&gt;标签',
                'id'       => 'javascriptcode',
                'default'  => '',
                'settings' => array(
                    'mode'  => 'javascript',
                    'theme' => 'dracula',
                ),
                'sanitize' => false,
                'type'     => 'code_editor',
            ),
            array(
                'title'    => __('自定义头部HTML代码', 'zib_language'),
                'subtitle' => __(esc_attr('位于</head>之前，这部分代码是在主要内容显示之前加载，通常是CSS样式、自定义的<meta>标签、全站头部JS等需要提前加载的代码，需填HTML标签'), 'zib_language'),
                'id'       => 'headcode',
                'default'  => '',
                'settings' => array(
                    'theme' => 'dracula',
                ),
                'sanitize' => false,
                'type'     => 'code_editor',
            ),
            array(
                'title'    => __('自定义底部HTML代码', 'zib_language'),
                'subtitle' => '位于&lt;/body&gt;之前，这部分代码是在主要内容加载完毕加载，通常是JS代码，需填HTML标签',
                'id'       => 'footcode',
                'default'  => '',
                'settings' => array(
                    'theme' => 'dracula',
                ),
                'sanitize' => false,
                'type'     => 'code_editor',
            ),
            array(
                'title'    => __('网站统计HTML代码', 'zib_language'),
                'subtitle' => '位于底部，用于添加第三方流量数据统计代码，如：Google analytics、百度统计、CNZZ、51la，国内站点推荐使用百度统计，国外站点推荐使用Google analytics。需填HTML标签，如果是javascript代码，请保存在自定义javascript代码',
                'id'       => 'trackcode',
                'default'  => '',
                'settings' => array(
                    'theme' => 'dracula',
                ),
                'sanitize' => false,
                'type'     => 'code_editor',
            ),
        ),
    ));
    CSF::createSection($prefix, array(
        'parent'      => 'page',
        'title'       => '顶部导航',
        'icon'        => 'fa fa-fw fa-navicon',
        'description' => '',
        'fields'      => array(
            array(
                'title'   => __("自定义导航栏颜色", 'zib_language'),
                'id'      => 'header_theme_custom',
                'type'    => 'switcher',
                'default' => false,
            ),

            array(
                'dependency' => array('header_theme_custom', '!=', ''),
                'class'      => 'compact',
                'title'      => ' ',
                'subtitle'   => '导航栏：背景色',
                'id'         => 'header_theme_bg_custom',
                'default'    => '',
                'desc'       => __('如需选择预置颜色，请先清空上方颜色', 'zib_language'),
                'type'       => "color",
            ),
            array(
                'dependency' => array('header_theme_bg_custom|header_theme_custom', '==|!=', '|'),
                'id'         => "header_theme_bg",
                'title'      => ' ',
                'default'    => '',
                'type'       => "palette",
                'class'      => 'compact skin-color',
                'options'    => array(
                    'ff648f' => array('#ff648f'),
                    'c246f5' => array('#c246f5'),
                    '469cf5' => array('#469cf5'),
                    '27bf41' => array('#27bf41'),
                    'fd6b4e' => array('#fd6b4e'),
                    '2d2422' => array('#2d2422'),
                ),
            ),

            array(
                'dependency' => array('header_theme_custom', '!=', ''),
                'id'         => 'header_theme_color_custom',
                'title'      => ' ',
                'subtitle'   => '导航栏：前景色',
                'default'    => '',
                'class'      => 'compact',
                'desc'       => __('请注意背景色和前景色的搭配，以免文字看不清', 'zib_language'),
                'type'       => "color",
            ),

            array(
                'title'   => __('电脑端导航布局', 'zib_language'),
                'id'      => 'header_layout',
                'default' => "1",
                'type'    => "image_select",
                'options' => array(
                    '1' => $f_imgpath . 'header_layout_1.png',
                    '2' => $f_imgpath . 'header_layout_2.png',
                    '3' => $f_imgpath . 'header_layout_3.png',
                ),
            ),
            array(
                'title'   => __('移动端导航布局', 'zib_language'),
                'id'      => 'mobile_header_layout',
                'default' => "center",
                'type'    => "image_select",
                'options' => array(
                    'center' => $f_imgpath . 'mobile_header_layout_center.png',
                    'left'   => $f_imgpath . 'mobile_header_layout_left.png',
                ),
            ),

            array(
                'id'      => 'mobile_navbar_align',
                'default' => 'left',
                'type'    => 'radio',
                'title'   => '移动端菜单弹出方向',
                'inline'  => true,
                'options' => array(
                    'top'   => __('顶部', 'zib_language'),
                    'left'  => __('左边', 'zib_language'),
                    'right' => __('右边', 'zib_language'),
                ),
            ),
            array(
                'title'    => __('导航浮动', 'zib_language'),
                'subtitle' => __('导航一直固定在顶部'),
                'id'       => 'nav_fixed',
                'type'     => 'switcher',
                'default'  => true,
            ),
            array(
                'title'   => 'Add发布按钮',
                'label'   => '顶部导航显示文章投稿、发布帖子、创建板块等按钮',
                'id'      => 'nav_newposts',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'dependency' => array('nav_newposts', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '按钮圆角',
                'label'      => '按钮两端显示为圆角',
                'class'      => 'compact',
                'id'         => 'nav_newposts_radius',
                'type'       => 'switcher',
                'default'    => true,
            ),
            array(
                'dependency' => array('nav_newposts', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '按钮颜色',
                'id'         => 'nav_newposts_class',
                'class'      => 'compact skin-color',
                'default'    => "jb-blue",
                'type'       => "palette",
                'options'    => CFS_Module::zib_palette(),
            ),
            array(
                'dependency' => array('nav_newposts', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '按钮文案',
                'class'      => 'compact',
                'id'         => 'nav_newposts_text',
                'sanitize'   => false,
                'type'       => 'textarea',
                'attributes' => array(
                    'rows' => 1,
                ),
                'help'       => '请注意控制字数，不建议超过4个字符',
                'default'    => '<i class="fa fa-fw fa-pencil"></i>发布',
            ),
            array(
                'dependency'  => array('nav_newposts', '!=', ''),
                'id'          => 'nav_newposts_btns',
                'title'       => ' ',
                'subtitle'    => '需显示的按钮',
                'class'       => 'compact',
                'default'     => array('post', 'bbs_topic', 'bbs_plate', 'bbs_posts'),
                'desc'        => '选择并排序按钮，未开启的功能不会显示',
                'placeholder' => '请选择按钮',
                'options'     => 'zib_new_add_btns_options',
                'type'        => 'select',
                'chosen'      => true,
                'multiple'    => true,
                'sortable'    => true,
            ),
            array(
                'id'          => 'nav_user_newposts_btn',
                'title'       => '导航栏用户卡片发布按钮',
                'subtitle'    => '发布类型选择',
                'default'     => 'post',
                'help'        => '显示在顶部导航栏用户模块的发布按钮',
                'placeholder' => '请选择按钮',
                'options'     => 'zib_new_add_btns_options',
                'type'        => 'select',
            ),
            array(
                'title'    => ' ',
                'subtitle' => '按钮文字',
                'class'    => 'compact mini-input',
                'id'       => 'nav_user_newposts_btn_text',
                'type'     => 'text',
                'default'  => '发布文章',
            ),
        ),
    ));
    CSF::createSection($prefix, array(
        'parent'      => 'page',
        'title'       => '导航幻灯片',
        'icon'        => 'fa fa-fw fa-image',
        'description' => '',
        'fields'      => array(
            array(
                'id'          => 'header_slider_show',
                'title'       => '开启导航幻灯片',
                'default'     => array(),
                'desc'        => '选择开启导航幻灯片的页面类型，一个都不选则为关闭此功能<br>这是显示在顶部导航栏内的幻灯片，如需在其它位置显示幻灯片请使用小工具模块进行添加|<a target="_blank" href="https://www.zibll.com/1246.html">查看官网教程</a>',
                'placeholder' => '选择开启导航幻灯片的页面类型',
                'options'     => CFS_Module::page_type(),
                'type'        => 'select',
                'chosen'      => true,
                'multiple'    => true,
            ),
            array(
                'dependency' => array('header_slider_show', '!=', ''),
                'title'      => __("显示规则", 'zib_language'),
                'subtitle'   => '导航栏幻灯片的显示规则',
                'id'         => 'header_slider_show_type',
                'type'       => 'radio',
                'default'    => '',
                'options'    => array(
                    ''        => '全部显示',
                    'only_pc' => '仅在PC端显示',
                    'only_sm' => '仅在移动端显示',
                ),
            ),
            array(
                'dependency'   => array('header_slider_show', '!=', '', '', 'visible'),
                'id'           => 'header_slider',
                'type'         => 'group',
                'min'          => '1',
                'button_title' => '添加幻灯片',
                'title'        => '幻灯片内容',
                'subtitle'     => '添加导航栏幻灯片',
                'default'      => array(
                    array(
                        'background'    => $imagepath . 'slider-bg.jpg',
                        'image_layer'   => array(
                            array(
                                'image'            => $imagepath . 'slider-layer-1.png',
                                'align'            => 'center',
                                'free_size'        => true,
                                'parallax'         => -100,
                                'parallax_scale'   => 180,
                                'parallax_opacity' => 30,
                            ),
                            array(
                                'image'            => $imagepath . 'slider-layer-2.png',
                                'align'            => 'center',
                                'free_size'        => true,
                                'parallax'         => -50,
                                'parallax_scale'   => 80,
                                'parallax_opacity' => 100,
                            ),
                        ),
                        'link'          => array(
                            'url'    => 'https://www.zibll.com/',
                            'target' => '_blank',
                        ),
                        'text'          => array(
                            'desc'  => '',
                            'title' => '',
                        ),
                        'text_align'    => 'left-bottom',
                        'text_parallax' => 30,
                        'text_size_m'   => 20,
                        'text_size_pc'  => 30,
                    ),
                ),
                'fields'       => CFS_Module::add_slider(),
            ),
            array(
                'dependency' => array('header_slider_show', '!=', ''),
                'id'         => 'header_slider_option',
                'type'       => 'fieldset',
                'title'      => '幻灯片设置',
                'subtitle'   => '导航栏幻灯片设置',
                'default'    => array(
                    'direction'    => 'horizontal',
                    'loop'         => true,
                    'button'       => true,
                    'pagination'   => true,
                    'effect'       => 'slide',
                    'auto_height'  => false,
                    'pc_height'    => 500,
                    'm_height'     => 240,
                    'spacebetween' => 15,
                    'speed'        => 0,
                    'autoplay'     => true,
                    'interval'     => 4,
                ),
                'fields'     => CFS_Module::slide(),
            ),
        ),
    ));

    //底部页脚
    CSF::createSection($prefix, array(
        'parent'      => 'page',
        'title'       => '底部页脚',
        'icon'        => 'fa fa-fw fa-minus-square-o',
        'description' => '',
        'fields'      => array(

            array(
                'title'   => __("自定义底部页脚颜色", 'zib_language'),
                'id'      => 'footer_theme_custom',
                'type'    => 'switcher',
                'default' => false,
            ),

            array(
                'dependency' => array('footer_theme_custom', '!=', ''),
                'title'      => ' ',
                'class'      => 'compact',
                'subtitle'   => '底部页脚：背景色',
                'default'    => '',
                'id'         => 'footer_theme_bg_custom',
                'desc'       => __('如需选择预置颜色，请先清空上方颜色', 'zib_language'),
                'type'       => "color",
            ),
            array(
                'dependency' => array('footer_theme_bg_custom|footer_theme_custom', '==|!=', '|'),
                'id'         => "footer_theme_bg",
                'title'      => ' ',
                'type'       => "palette",
                'default'    => '',
                'class'      => 'compact skin-color',
                'options'    => array(
                    'ff648f' => array('#ff648f'),
                    'c246f5' => array('#c246f5'),
                    '469cf5' => array('#469cf5'),
                    '27bf41' => array('#27bf41'),
                    'fd6b4e' => array('#fd6b4e'),
                    '2d2422' => array('#2d2422'),
                ),
            ),

            array(
                'dependency' => array('footer_theme_custom', '!=', ''),
                'id'         => 'footer_theme_color_custom',
                'title'      => ' ',
                'default'    => '',
                'subtitle'   => '底部页脚：前景色',
                'desc'       => __('请注意背景色和前景色的搭配，以免文字看不清', 'zib_language'),
                'class'      => 'compact',
                'type'       => "color",
            ),

            array(
                'title'   => __('页脚布局模板选择', 'zib_language'),
                'id'      => 'fcode_template',
                'default' => "template_1",
                'help'    => '由于页脚布局及样式种类繁多，更多模板正在开发中。后续也会发布可视化编辑功能',
                'type'    => "image_select",
                'options' => array(
                    'template_1' => $f_imgpath . 'fcode_template_1.png',
                ),
            ),

            array(
                'title'   => __('板块一设置', 'zib_language'),
                'id'      => 'footer_t1_m_s',
                'help'    => '如果不勾选则仅仅在电脑端显示此板块',
                'type'    => 'switcher',
                'default' => false,
                'label'   => __('移动端显示', 'zib_language'),
            ),
            array(
                'title'    => ' ',
                'subtitle' => '日间模式图片',
                'id'       => 'footer_t1_img',
                'class'    => 'compact',
                'default'  => $imagepath . 'logo.png',
                'library'  => 'image', 'type' => 'upload',
            ),

            array(
                'title'    => ' ',
                'subtitle' => '夜间模式图片',
                'id'       => 'footer_t1_img_dark',
                'class'    => 'compact',
                'default'  => $imagepath . 'logo_dark.png',
                'library'  => 'image', 'type' => 'upload',
            ),

            array(
                'title'    => ' ',
                'subtitle' => '首行文字',
                'id'       => 'footer_t1_t',
                'class'    => 'compact',
                'default'  => '',
                'type'     => 'text',
            ),

            array(
                'title'      => ' ',
                'subtitle'   => '更多内容',
                'id'         => 'fcode_t1_code',
                'class'      => 'compact',
                'default'    => 'Zibll 子比主题专为博客、自媒体、资讯类的网站设计开发，简约优雅的设计风格，全面的前端用户功能，简单的模块化配置，欢迎您的体验',
                'sanitize'   => false,
                'type'       => 'textarea',
                'attributes' => array(
                    'rows' => 3,
                ),
            ),

            array(
                'title'      => __('板块二', 'zib_language'),
                'subtitle'   => __('第一行(建议为友情链接，或者站内链接)', 'zib_language'),
                'id'         => 'fcode_t2_code_1',
                'default'    => '<a href="https://zibll.com">友链申请</a>
<a href="https://zibll.com">免责声明</a>
<a href="https://zibll.com">广告合作</a>
<a href="https://zibll.com">关于我们</a>',
                'sanitize'   => false,
                'type'       => 'textarea',
                'attributes' => array(
                    'rows' => 4,
                ),
            ),

            array(
                'title'      => ' ',
                'subtitle'   => __('第二行(建议为版权提醒，备案号等)', 'zib_language'),
                'id'         => 'fcode_t2_code_2',
                'class'      => 'compact',
                'default'    => 'Copyright &copy;&nbsp;' . date('Y') . '&nbsp;·&nbsp;<a href="' . home_url() . '">' . get_bloginfo('title') . '</a>&nbsp;·&nbsp;由<a target="_blank" href="https://zibll.com">Zibll主题</a>强力驱动.',
                'sanitize'   => false,
                'type'       => 'textarea',
                'attributes' => array(
                    'rows' => 3,
                ),
            ),

            array(
                'title'   => __('联系方式', 'zib_language'),
                'id'      => 'footer_contact_m_s',
                'class'   => '',
                'type'    => 'switcher',
                'default' => true,
                'label'   => __('移动端显示'),
            ),

            array(
                'id'       => 'footer_contact_wechat_img',
                'class'    => 'compact',
                'title'    => ' ',
                'subtitle' => __('微信二维码', 'zib_language'),
                'default'  => $imagepath . 'qrcode.png',
                'library'  => 'image', 'type' => 'upload',
            ),

            array(
                'title'    => ' ',
                'subtitle' => __('QQ号', 'zib_language'),
                'id'       => 'footer_contact_qq',
                'class'    => 'compact',
                'default'  => '1234567788',
                'type'     => 'text',
            ),

            array(
                'title'    => ' ',
                'subtitle' => __('微博链接', 'zib_language'),
                'id'       => 'footer_contact_weibo',
                'class'    => 'compact',
                'default'  => 'https://weibo.com/',
                'type'     => 'text',
            ),

            array(
                'title'    => ' ',
                'subtitle' => __('邮箱', 'zib_language'),
                'id'       => 'footer_contact_email',
                'class'    => 'compact',
                'default'  => '1234567788@QQ.COM',
                'type'     => 'text',
            ),

            array(
                'title'   => __('板块三', 'zib_language'),
                'id'      => 'footer_mini_img_m_s',
                'class'   => '',
                'type'    => 'switcher',
                'default' => true,
                'label'   => __('移动端显示'),
            ),

            array(
                'id'           => 'footer_mini_img',
                'type'         => 'group',
                'max'          => 4,
                'button_title' => '添加图片',
                'class'        => 'compact',
                'title'        => '页脚图片',
                'placeholder'  => '显示在板块3的图片内容',
                'default'      => array(
                    array(
                        'image' => $imagepath . 'qrcode.png',
                        'text'  => '扫码加QQ群',
                    ),
                    array(
                        'image' => $imagepath . 'qrcode.png',
                        'text'  => '扫码加微信',
                    ),
                ),
                'fields'       => array(
                    array(
                        'id'    => 'text',
                        'title' => __('显示文字', 'zib_language'),
                        'type'  => 'text',
                    ),
                    array(
                        'id'      => 'image',
                        'title'   => __('显示图片', 'zib_language'),
                        'library' => 'image', 'type' => 'upload',
                    ),
                ),
            ),

            array(
                'title'      => __('页脚自定义HTML', 'zib_language'),
                'desc'       => __('最底部额外的自定义代码（支持HTML）', 'zib_language'),
                'id'         => 'fcode_customize_code',
                'default'    => '',
                'sanitize'   => false,
                'type'       => 'textarea',
                'attributes' => array(
                    'rows' => 3,
                ),
            ),

        ),
    ));

    //------------------------------------------------------------------------
    CSF::createSection($prefix, array(
        'parent'      => 'page',
        'title'       => '首页配置',
        'icon'        => 'fa fa-fw fa-home',
        'description' => '',
        'fields'      => array(
            array(
                'type'    => 'submessage',
                'style'   => 'warning',
                'content' => '首页主文章模块。关闭则首页不显示主文章模块，但仍可通过模块添加',
            ),
            array(
                'title'   => __('首页文章', 'zib_language'),
                'id'      => 'home_posts_list_s',
                'default' => true,
                'help'    => '',
                'type'    => 'switcher',
            ),
            array(
                'dependency' => array('home_posts_list_s', '!=', '', '', 'visible'),
                'id'         => 'home_list1_orderby_s',
                'title'      => __('栏目1设置', 'zib_language'),
                'subtitle'   => '显示最新文章的主文章栏目',
                'class'      => '',
                'default'    => true,
                'label'      => __('显示排序方式按钮', 'zib_language'),
                'type'       => 'switcher',
            ),
            array(
                'dependency' => array('home_posts_list_s|home_list1_orderby_s', '!=|!=', '|'),
                'id'         => 'home_list1_orderby_option',
                'type'       => 'fieldset',
                'class'      => 'compact',
                'default'    => '',
                'title'      => ' ',
                'subtitle'   => '排序方式设置',
                'fields'     => CFS_Module::orderby(),
            ),
            array(
                'dependency' => array('home_posts_list_s', '!=', '', '', 'visible'),
                'title'      => ' ',
                'subtitle'   => '显示标题',
                'help'       => '当没有更多栏目时，允许为空',
                'class'      => 'compact',
                'id'         => 'index_list_title',
                'default'    => __('最新发布', 'zib_language'),
                'attributes' => array(
                    'rows' => 1,
                ),
                'sanitize'   => false,
                'type'       => 'textarea',
            ),
            array(
                'dependency'  => array('home_posts_list_s', '!=', '', '', 'visible'),
                'id'          => 'home_exclude_posts',
                'class'       => 'compact',
                'title'       => ' ',
                'subtitle'    => __('排除文章', 'zib_language'),
                'desc'        => __('输入文章标题关键词以搜索文章', 'zib_language'),
                'default'     => '',
                'options'     => 'posts',
                'placeholder' => '输入文章标题关键词以搜索文章',
                'chosen'      => true,
                'ajax'        => true,
                'multiple'    => true,
                'settings'    => array(
                    'min_length' => 2,
                ),
                'type'        => 'select',
            ),
            array(
                'dependency'  => array('home_posts_list_s', '!=', '', '', 'visible'),
                'id'          => 'home_exclude_cats',
                'class'       => 'compact',
                'title'       => ' ',
                'subtitle'    => __('排除分类', 'zib_language'),
                'desc'        => '输入关键词以搜索分类',
                'default'     => '',
                'options'     => 'categories',
                'placeholder' => '输入关键词以搜索分类',
                'chosen'      => true,
                'ajax'        => true,
                'multiple'    => true,
                'settings'    => array(
                    'min_length' => 2,
                ),
                'type'        => 'select',
            ),
            array(
                'dependency'             => array('home_posts_list_s', '!=', '', '', 'visible'),
                'id'                     => 'home_lists',
                'type'                   => 'group',
                'accordion_title_number' => true,
                'button_title'           => '添加栏目',
                'title'                  => '更多栏目',
                'default'                => array(),
                'fields'                 => array(
                    array(
                        'id'         => 'title',
                        'title'      => '自定义标题',
                        'desc'       => '自定义标题为空，则显示所选择分类、专题的名称（支持HTML代码）| <a href="' . admin_url('edit-tags.php?taxonomy=category') . '">管理分类</a> | <a href="' . admin_url('edit-tags.php?taxonomy=topics') . '">管理专题</a>',
                        'attributes' => array(
                            'rows' => 1,
                        ),
                        'sanitize'   => false,
                        'type'       => 'textarea',
                    ),
                    array(
                        'id'          => 'term_id',
                        'title'       => '显示内容',
                        'class'       => 'compact',
                        'options'     => 'categories',
                        'query_args'  => array(
                            'taxonomy'   => array('topics', 'category'),
                            'orderby'    => 'taxonomy',
                            'hide_empty' => false,
                        ),
                        'placeholder' => '输入关键词以搜索分类或专题',
                        'chosen'      => true,
                        'ajax'        => true,
                        'settings'    => array(
                            'min_length' => 2,
                        ),
                        'desc'        => '如选择的分类(专题)下没有文章则不会显示此栏目',
                        'type'        => 'select',
                    ),
                ),
            ),
        ),
    ));

    //分类页面
    CSF::createSection($prefix, array(
        'parent'      => 'page',
        'title'       => '分类页面',
        'icon'        => 'fa fa-fw fa-folder-open-o',
        'description' => '',
        'fields'      => array(
            array(
                'title'   => __('显示封面图', 'zib_language'),
                'id'      => 'page_cover_cat_s',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'dependency' => array('page_cover_cat_s', '!=', ''),
                'title'      => __('封面图', 'zib_language'),
                'subtitle'   => __('默认封面图，建议尺寸1600X1100'),
                'id'         => 'cat_default_cover',
                'default'    => $imagepath . 'user_t.jpg',
                'help'       => '显示页面顶部的封面图像，你可以在分类设置中单独设置每一个分类的封面图，如未设置则显示此图像',
                'library'    => 'image', 'type' => 'upload',
            ),
            array(
                'title'    => __('排序方式按钮', 'zib_language'),
                'subtitle' => __('在分类页显示排序方式按钮', 'zib_language'),
                'id'       => 'cat_orderby_s',
                'type'     => 'switcher',
                'default'  => true,
            ),
            array(
                'dependency' => array('cat_orderby_s', '!=', ''),
                'id'         => 'cat_orderby_option',
                'type'       => 'fieldset',
                'default'    => array(),
                'class'      => 'compact',
                'title'      => ' ',
                'fields'     => CFS_Module::orderby(),
            ),
            array(
                'content' => '<b>AJAX筛选菜单列表:</b> 显示分类、标签、专题的菜单筛选按钮，通过ajax获取内容',
                'type'    => 'submessage',
                'style'   => 'warning',
            ),
            array(
                'title'    => __('AJAX分类筛选', 'zib_language'),
                'subtitle' => __('在分类页显示的分类筛选列表', 'zib_language'),
                'id'       => 'ajax_list_cat_cat',
                'type'     => 'switcher',
                'default'  => true,
            ),
            array(
                'dependency' => array('ajax_list_cat_cat', '!=', ''),
                'id'         => 'ajax_list_option_cat_cat',
                'type'       => 'fieldset',
                'default'    => array(),
                'class'      => 'compact',
                'title'      => ' ',
                'fields'     => CFS_Module::ajax_but('categories'),
            ),
            array(
                'title'    => __('AJAX标签筛选', 'zib_language'),
                'subtitle' => __('在分类页显示的标签筛选列表', 'zib_language'),
                'id'       => 'ajax_list_cat_tag',
                'type'     => 'switcher',
                'default'  => false,
            ),
            array(
                'dependency' => array('ajax_list_cat_tag', '!=', ''),
                'id'         => 'ajax_list_option_cat_tag',
                'type'       => 'fieldset',
                'default'    => array(),
                'class'      => 'compact',
                'title'      => ' ',
                'fields'     => CFS_Module::ajax_but('tags'),
            ),
            array(
                'title'    => __('AJAX专题筛选', 'zib_language'),
                'subtitle' => __('在分类页显示的专题筛选列表', 'zib_language'),
                'id'       => 'ajax_list_cat_topics',
                'type'     => 'switcher',
                'default'  => false,
            ),
            array(
                'dependency' => array('ajax_list_cat_topics', '!=', ''),
                'id'         => 'ajax_list_option_cat_topics',
                'type'       => 'fieldset',
                'default'    => array(),
                'class'      => 'compact',
                'title'      => ' ',
                'fields'     => CFS_Module::ajax_but('topics'),
            ),

        ),
    ));

    //标签页面
    CSF::createSection($prefix, array(
        'parent'      => 'page',
        'title'       => '标签页面',
        'icon'        => 'fa fa-fw fa-tags',
        'description' => '',
        'fields'      => array(
            array(
                'title'   => __('显示封面图', 'zib_language'),
                'id'      => 'page_cover_tag_s',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'dependency' => array('page_cover_tag_s', '!=', ''),
                'title'      => __('封面图', 'zib_language'),
                'subtitle'   => __('默认封面图，建议尺寸1600X1100'),
                'id'         => 'tag_default_cover',
                'default'    => $imagepath . 'user_t.jpg',
                'help'       => '显示页面顶部的封面图像，你可以在标签设置中单独设置每一个标签的封面图，如未设置则显示此图像',
                'library'    => 'image', 'type' => 'upload',
            ),
            array(
                'title'    => __('排序方式按钮', 'zib_language'),
                'subtitle' => __('在标签页显示排序方式按钮', 'zib_language'),
                'id'       => 'tag_orderby_s',
                'type'     => 'switcher',
                'default'  => true,
            ),
            array(
                'dependency' => array('tag_orderby_s', '!=', ''),
                'id'         => 'tag_orderby_option',
                'type'       => 'fieldset',
                'default'    => array(),
                'class'      => 'compact',
                'title'      => ' ',
                'fields'     => CFS_Module::orderby(),
            ),
            array(
                'content' => '<b>AJAX筛选菜单列表:</b> 显示分类、标签、专题的菜单，通过ajax获取内容',
                'type'    => 'submessage',
                'style'   => 'warning',
            ),

            array(
                'title'    => __('AJAX分类筛选', 'zib_language'),
                'subtitle' => __('在标签页显示的分类筛选列表', 'zib_language'),
                'id'       => 'ajax_list_tag_cat',
                'type'     => 'switcher',
                'default'  => false,
            ),
            array(
                'dependency' => array('ajax_list_tag_cat', '!=', ''),
                'id'         => 'ajax_list_option_tag_cat',
                'type'       => 'fieldset',
                'default'    => array(),
                'class'      => 'compact',
                'title'      => ' ',
                'fields'     => CFS_Module::ajax_but('categories'),
            ),
            array(
                'title'    => __('AJAX标签筛选', 'zib_language'),
                'subtitle' => __('在标签页显示的标签筛选列表', 'zib_language'),
                'id'       => 'ajax_list_tag_tag',
                'type'     => 'switcher',
                'default'  => true,
            ),
            array(
                'dependency' => array('ajax_list_tag_tag', '!=', ''),
                'id'         => 'ajax_list_option_tag_tag',
                'type'       => 'fieldset',
                'default'    => array(),
                'class'      => 'compact',
                'title'      => ' ',
                'fields'     => CFS_Module::ajax_but('tags'),
            ),
            array(
                'title'    => __('AJAX专题筛选', 'zib_language'),
                'subtitle' => __('在标签页显示的专题筛选列表', 'zib_language'),
                'id'       => 'ajax_list_tag_topics',
                'type'     => 'switcher',
                'default'  => false,
            ),
            array(
                'dependency' => array('ajax_list_tag_topics', '!=', ''),
                'id'         => 'ajax_list_option_tag_topics',
                'type'       => 'fieldset',
                'default'    => array(),
                'class'      => 'compact',
                'title'      => ' ',
                'fields'     => CFS_Module::ajax_but('topics'),
            ),

        ),
    ));
    CSF::createSection($prefix, array(
        'parent'      => 'page',
        'title'       => '专题页面',
        'icon'        => 'fa fa-fw fa-cube',
        'description' => '',
        'fields'      => array(
            array(
                'title'    => __('封面图', 'zib_language'),
                'subtitle' => __('默认封面图，建议尺寸1600X1100'),
                'id'       => 'topics_default_cover',
                'default'  => $imagepath . 'user_t.jpg',
                'help'     => '显示页面顶部的封面图像，你可以在专题设置中单独设置每一个专题的封面图，如未设置则显示此图像',
                'library'  => 'image', 'type' => 'upload',
            ),
            array(
                'title'    => __('排序方式按钮', 'zib_language'),
                'subtitle' => __('在专题页显示排序方式按钮', 'zib_language'),
                'id'       => 'topics_orderby_s',
                'type'     => 'switcher',
                'default'  => true,
            ),
            array(
                'dependency' => array('topics_orderby_s', '!=', ''),
                'id'         => 'topics_orderby_option',
                'type'       => 'fieldset',
                'default'    => array(),
                'class'      => 'compact',
                'title'      => ' ',
                'fields'     => CFS_Module::orderby(),
            ),
            array(
                'content' => '<b>AJAX筛选菜单列表:</b> 显示分类、标签、专题的菜单，通过ajax获取内容',
                'type'    => 'submessage',
                'style'   => 'warning',
            ),

            array(
                'title'    => __('AJAX分类筛选', 'zib_language'),
                'subtitle' => __('在专题页显示的分类筛选列表', 'zib_language'),
                'id'       => 'ajax_list_topics_cat',
                'type'     => 'switcher',
                'default'  => false,
            ),
            array(
                'dependency' => array('ajax_list_topics_cat', '!=', ''),
                'id'         => 'ajax_list_option_topics_cat',
                'default'    => array(),
                'type'       => 'fieldset',
                'class'      => 'compact',
                'title'      => ' ',
                'fields'     => CFS_Module::ajax_but('categories'),
            ),
            array(
                'title'    => __('AJAX标签筛选', 'zib_language'),
                'subtitle' => __('在专题页显示的标签筛选列表', 'zib_language'),
                'id'       => 'ajax_list_topics_tag',
                'type'     => 'switcher',
                'default'  => false,
            ),
            array(
                'dependency' => array('ajax_list_topics_tag', '!=', ''),
                'id'         => 'ajax_list_option_topics_tag',
                'type'       => 'fieldset',
                'default'    => array(),
                'class'      => 'compact',
                'title'      => ' ',
                'fields'     => CFS_Module::ajax_but('tags'),
            ),
            array(
                'title'    => __('AJAX专题筛选', 'zib_language'),
                'subtitle' => __('在专题页显示的专题筛选列表', 'zib_language'),
                'id'       => 'ajax_list_topics_topics',
                'type'     => 'switcher',
                'default'  => true,
            ),
            array(
                'dependency' => array('ajax_list_topics_topics', '!=', ''),
                'id'         => 'ajax_list_option_topics_topics',
                'default'    => array(),
                'type'       => 'fieldset',
                'class'      => 'compact',
                'title'      => ' ',
                'fields'     => CFS_Module::ajax_but('topics'),
            ),
        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'page',
        'title'       => '其它页面',
        'icon'        => 'fa fa-fw fa-clone',
        'description' => '',
        'fields'      => array(
            array(
                'title'    => '页面标题',
                'subtitle' => '页面标题的默认显示样式',
                'id'       => 'page_header_style',
                'default'  => '',
                'type'     => 'radio',
                'options'  => array(
                    '' => __('不显示', 'zib_language'),
                    1  => __('简单样式', 'zib_language'),
                    2  => __('卡片样式', 'zib_language'),
                    3  => __('封面图样式', 'zib_language'),
                ),
            ),

            array(
                'title'   => '页面封面图',
                'id'      => 'page_header_cover_img',
                'desc'    => __('页面默认封面图，建议尺寸1000x400（仅页面标题显示为封面图样式时有效）'),
                'help'    => '页面也单独设置封面图，如未单独设置则显示此图像',
                'default' => $imagepath . 'user_t.jpg',
                'library' => 'image', 'type' => 'upload',
            ),

        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'post',
        'title'       => '列表缩略图',
        'icon'        => 'fa fa-fw fa-file-image-o',
        'description' => '',
        'fields'      => array(
            array(
                'type'    => 'submessage',
                'style'   => 'warning',
                'content' => '<i class="fa fa-fw fa-info-circle fa-fw"></i><b> 缩略图获取优先级：</b>文章特色图像>外链特色图像>文章首图>分类封面图>备用缩略图>懒加载预载图</a>
                <div class="c-yellow">自动获取缩略图对性能消耗较大，建议使用Redis、Memcached缓存插件或手动设置特色图像或外链缩略图</div>
                <div class="c-yellow">推荐使用Redis或Memcached缓存插件，能极大的提高执行效率 | <a target="_blank" href="https://www.zibll.com/1997.html">查看官网教程</a></div>',
            ),
            array(
                'id'      => 'list_thumb_slides_s',
                'title'   => '幻灯片缩略图',
                'label'   => '允许设置幻灯片为列表缩略图',
                'type'    => 'switcher',
                'default' => true,
            ),
            /**
            array(
            'id' => 'list_thumb_video_s',
            'title' => '视频缩略图',
            'label' => '允许设置视频为列表缩略图',
            'type' => 'switcher',
            'default' => false,
            ), */
            array(
                'id'      => 'thumb_postfirstimg_s',
                'title'   => '自动获取缩略图',
                'label'   => '自动获取文章首图为缩略图',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'id'      => 'thumb_catimg_s',
                'title'   => ' ',
                'label'   => '自动获取分类封面为缩略图',
                'class'   => 'compact',
                'type'    => 'switcher',
                'default' => true,
            ),

            array(
                'id'      => 'thumb_postfirstimg_size',
                'title'   => '缩略图大小',
                'default' => 'medium',
                'desc'    => '此处的三个尺寸均可在<a href="' . admin_url('options-media.php') . '">WP后台-媒体设置</a>中修改，建议此处选择中尺寸，并将中尺寸的尺寸设置为700x490效果最佳',
                'type'    => "radio",
                'inline'  => true,
                'options' => array(
                    'thumbnail' => __('小尺寸', 'zib_language'),
                    'medium'    => __('中尺寸', 'zib_language'),
                    'large'     => __('大尺寸', 'zib_language'),
                    'full'      => __('原图', 'zib_language'),
                ),
            ),

            array(
                'title'        => '备用缩略图',
                'id'           => 'spare_thumbnail',
                'desc'         => '如果此处添加了多张图片，则自动随机获取',
                'type'         => 'group',
                'min'          => 1,
                'button_title' => '添加备用缩略图',
                'default'      => array(
                    array(
                        'img' => $imagepath . 'thumbnail.svg',
                    ),
                ),
                'fields'       => array(
                    array(
                        'id'      => 'img',
                        'library' => 'image',
                        'type'    => 'upload',
                    ),
                ),
            ),
        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'post',
        'title'       => '文章列表',
        'icon'        => 'fa fa-fw fa-file-text-o',
        'description' => '',
        'fields'      => array(
            array(
                'title'    => __('默认排序方式', 'zib_language'),
                'subtitle' => '文章列表全局默认排序方式',
                'id'       => 'list_orderby',
                'default'  => "modified",
                'inline'   => true,
                'type'     => "radio",
                'options'  => array(
                    'date'     => __('发布时间'),
                    'modified' => __('更新时间'),
                ),
            ),
            array(
                'title'   => __('新窗口打开文章', 'zib_language'),
                'id'      => 'target_blank',
                'type'    => 'switcher',
                'default' => false,
            ),
            array(
                'title'   => __('列表标题粗体显示', 'zib_language'),
                'class'   => 'compact',
                'id'      => 'item_heading_bold',
                'type'    => 'switcher',
                'default' => false,
            ),
            array(
                'title'   => __('显示文章作者', 'zib_language'),
                'class'   => 'compact',
                'id'      => 'post_list_author',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'id'      => 'paging_ajax_s',
                'title'   => '列表翻页模式',
                'default' => '1',
                'type'    => "radio",
                'inline'  => true,
                'desc'    => '您可以在<a href="' . esc_url(admin_url('options-reading.php')) . '">WP设置-阅读-博客页面至多显示</a>，以调整单页加载数量',
                'options' => array(
                    '1' => __('AJAX追加列表翻页', 'zib_language'),
                    '0' => __('数字翻页按钮', 'zib_language'),
                ),
            ),
            array(
                'dependency' => array('paging_ajax_s', '==', '1'),
                'title'      => ' ',
                'subtitle'   => 'AJAX自动加载',
                'class'      => 'compact',
                'id'         => 'paging_ajax_ias_s',
                'type'       => 'switcher',
                'label'      => '页面滚动到列表尽头时，自动加载下一页',
                'default'    => true,
            ),
            array(
                'dependency' => array('paging_ajax_s|paging_ajax_ias_s', '!=|!=', '0|'),
                'title'      => ' ',
                'subtitle'   => '自动加载页数',
                'desc'       => 'AJAX自动加载最多加载几页（为0则不限制,直到加载全部列表）',
                'id'         => 'ias_max',
                'class'      => 'compact',
                'default'    => 3,
                'max'        => 10,
                'min'        => 0,
                'step'       => 1,
                'unit'       => '页',
                'type'       => 'spinner',
            ),
            array(
                'title'    => '列表小部件',
                'subtitle' => '移动端优先显示',
                'id'       => 'list_meta_show',
                'default'  => "like",
                'type'     => "radio",
                'inline'   => true,
                'help'     => '在移动设备由于显示空间不足，则会隐藏部分部件，此处选择的部件将会一直显示',
                'options'  => array(
                    'view' => __('阅读量', 'zib_language'),
                    'like' => __('点赞数', 'zib_language'),
                    'comm' => __('评论', 'zib_language'),
                ),
            ),
            array(
                'title'   => '显示列表标签',
                'id'      => 'list_badge_show',
                'default' => array('pay', 'tag', 'topics', 'cat'),
                'type'    => "checkbox",
                'inline'  => true,
                'help'    => '分类、专题、标签在对应的页面不会显示，例如：在分类页不会显示分类',
                'options' => array(
                    'pay'    => __('付费信息', 'zib_language'),
                    'cat'    => __('分类', 'zib_language'),
                    'topics' => __('专题', 'zib_language'),
                    'tag'    => __('标签', 'zib_language'),
                ),
            ),
            array(
                'title'   => __('列表样式', 'zib_language'),
                'id'      => 'list_show_type',
                'help'    => '当文章显示为列表模式时有效',
                'default' => "separate",
                'type'    => "image_select",
                'options' => array(
                    'separate'  => $f_imgpath . 'list_separate.png',
                    'no_margin' => $f_imgpath . 'list_no_margin.png',
                ),
            ),
            array(
                'title'   => __('默认列表模式', 'zib_language'),
                'id'      => 'list_type',
                'default' => "thumb",
                'type'    => "radio",
                'desc'    => '<i class="fa fa-fw fa-info-circle fa-fw"></i> 文字模式、自动图文模式、多图模式仅在开启侧边栏的页面有效</br><a target="_blank" href="https://www.zibll.com/958.html">查看官方教程</a>',
                'options' => array(
                    'text'         => __('列表文字模式', 'zib_language'),
                    'thumb'        => __('列表图文模式（无缩略图时使用备用缩略图）', 'zib_language'),
                    'thumb_if_has' => __('列表自动图文模式（无缩略图时自动转换为文字模式） ', 'zib_language'),
                    'card'         => __('卡片模式 ', 'zib_language'),
                ),
            ),
            array(
                'dependency' => array('list_type', '!=', 'card'),
                'title'      => __('列表卡片模式'),
                'type'       => 'content',
                'content'    => '当默认模式不为卡片模式时，可以在下方单独为不同页面设置为卡片模式',
            ),
            array(
                'dependency' => array('list_type', '!=', 'card'),
                'title'      => ' ',
                'class'      => 'compact',
                'subtitle'   => '首页列表 卡片模式',
                'id'         => 'list_card_home',
                'type'       => 'switcher',
                'default'    => false,
            ),
            array(
                'dependency' => array('list_type', '!=', 'card'),
                'title'      => ' ',
                'subtitle'   => '标签页列表 卡片模式',
                'class'      => 'compact',
                'id'         => 'list_card_tag',
                'type'       => 'switcher',
                'default'    => false,
            ),
            array(
                'dependency' => array('list_type', '!=', 'card'),
                'title'      => ' ',
                'subtitle'   => '专题页列表 卡片模式',
                'class'      => 'compact',
                'id'         => 'list_card_topics',
                'type'       => 'switcher',
                'default'    => false,
            ),
            array(
                'dependency' => array('list_type', '!=', 'card'),
                'title'      => ' ',
                'subtitle'   => '用户页列表 卡片模式',
                'class'      => 'compact',
                'id'         => 'list_card_author',
                'type'       => 'switcher',
                'default'    => false,
            ),

            array(
                'dependency'  => array('list_type', '!=', 'card'),
                'id'          => 'list_card_cat',
                'title'       => ' ',
                'subtitle'    => '自定义卡片模式',
                'default'     => '',
                'class'       => 'compact',
                'desc'        => '选择的分类、专题将会在对应页面显示为卡片模式 | <a href="' . admin_url('edit-tags.php?taxonomy=category') . '">管理分类</a> | <a href="' . admin_url('edit-tags.php?taxonomy=topics') . '">管理专题</a>',
                'options'     => 'categories',
                'query_args'  => array(
                    'taxonomy'   => array('topics', 'category'),
                    'orderby'    => 'taxonomy',
                    'hide_empty' => false,
                ),
                'placeholder' => '输入关键词以搜索分类或专题',
                'chosen'      => true,
                'multiple'    => true,
                'ajax'        => true,
                'settings'    => array(
                    'min_length' => 2,
                ),
                'type'        => 'select',
            ),
            array(
                'title'      => '列表配置',
                'id'         => 'list_list_option',
                'type'       => 'accordion',
                'accordions' => array(
                    array(
                        'title'  => '列表模式：参数配置',
                        'fields' => array(
                            array(
                                'id'      => 'style',
                                'title'   => '列表样式',
                                'default' => 'null',
                                'type'    => "image_select",
                                'options' => array(
                                    'null'   => $f_imgpath . 'list-style-null.jpg',
                                    'style2' => $f_imgpath . 'list-style-2.jpg',
                                ),
                            ),
                            array(
                                'id'      => 'img_position',
                                'title'   => '缩略图',
                                'default' => 'left',
                                'options' => array(
                                    'left'  => '靠左',
                                    'right' => '靠右',
                                ),
                                'type'    => "radio",
                                'inline'  => true,
                            ),
                            array(
                                'title'   => '缩略图长宽比例',
                                'id'      => 'scale',
                                'default' => 70,
                                'max'     => 200,
                                'min'     => 50,
                                'step'    => 5,
                                'unit'    => '%',
                                'type'    => 'spinner',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'title'      => '卡片配置',
                'id'         => 'list_card_option',
                'type'       => 'accordion',
                'accordions' => array(
                    array(
                        'title'  => '列表卡片模式：卡片配置',
                        'fields' => array(
                            array(
                                'id'      => 'style',
                                'title'   => '卡片样式',
                                'default' => 'null',
                                'type'    => "image_select",
                                'options' => array(
                                    'null'   => $f_imgpath . 'card-style-null.jpg',
                                    /*** 'style2' => $f_imgpath . 'card-style-2.jpg', */
                                    'style3' => $f_imgpath . 'card-style-3.jpg',
                                ),
                            ),
                            array(
                                'title'   => '缩略图长宽比例',
                                'id'      => 'scale',
                                'default' => 70,
                                'max'     => 200,
                                'min'     => 20,
                                'step'    => 5,
                                'unit'    => '%',
                                'type'    => 'spinner',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'          => 'mult_thumb_cat',
                'title'       => '列表多图显示',
                'subtitle'    => '文章列表显示4张缩略图',
                'desc'        => '文章格式为“图片、画廊”的文章默认显示为此模式</br>在此选择的分类，该分类的全部文章都会显示为此模式</br><i class="fa fa-fw fa-info-circle fa-fw"></i> 当列表模式为卡片模式或未开启侧边栏时，此显示方式无效',
                'placeholder' => '选择需要显示为多图模式的分类',
                'default'     => array(),
                'options'     => 'categories',
                'type'        => 'select',
                'chosen'      => true,
                'multiple'    => true,
            ),

            array(
                'title'      => 'AJAX翻页',
                'subtitle'   => '翻页按钮文字',
                'id'         => 'ajax_trigger',
                'default'    => '<i class="fa fa-angle-right"></i>加载更多',
                'attributes' => array(
                    'rows' => 1,
                ),
                'sanitize'   => false,
                'type'       => 'textarea',
            ),

            array(
                'title'      => ' ',
                'id'         => 'ajax_nomore',
                'class'      => 'compact',
                'subtitle'   => '列表全部加载完毕 文案',
                'default'    => '没有更多内容了',
                'desc'       => '支持HTML代码，请注意代码规范及标签闭合</br>您可以在<a href="' . esc_url(admin_url('options-reading.php')) . '">WP设置-阅读-博客页面至多显示</a>，以调整单页加载数量',
                'attributes' => array(
                    'rows' => 1,
                ),
                'sanitize'   => false,
                'type'       => 'textarea',
            ),
        ),
    ));

    //主题显示
    CSF::createSection($prefix, array(
        'title'       => '文章页面',
        'parent'      => 'post',
        'icon'        => 'fa fa-fw fa-bookmark-o',
        'description' => '',
        'fields'      => array(
            array(
                'title'   => '图片封面',
                'label'   => '允许设置文章页顶部显示封面图',
                'id'      => 'article_image_cover',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'dependency' => array('article_image_cover', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '图片封面配置',
                'class'      => 'compact',
                'id'         => 'article_image_cover_option',
                'type'       => 'fieldset',
                'fields'     => array(
                    array(
                        'title'   => '图片长宽比例',
                        'id'      => 'scale',
                        'default' => 35,
                        'max'     => 200,
                        'min'     => 20,
                        'step'    => 5,
                        'unit'    => '%',
                        'type'    => 'spinner',
                    ),
                ),
            ),
            array(
                'title'   => '幻灯片封面',
                'label'   => '允许设置幻灯片为文章封面',
                'id'      => 'article_slide_cover',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'dependency' => array('article_slide_cover', '!=', ''),
                'id'         => 'article_slide_cover_option',
                'type'       => 'accordion',
                'class'      => 'compact',
                'default'    => array(
                    'direction'    => 'horizontal',
                    'loop'         => true,
                    'button'       => false,
                    'pagination'   => true,
                    'effect'       => 'slide',
                    'auto_height'  => false,
                    'pc_height'    => 380,
                    'm_height'     => 180,
                    'spacebetween' => 15,
                    'speed'        => 0,
                    'autoplay'     => true,
                    'interval'     => 4,
                ),
                'title'      => ' ',
                'accordions' => array(
                    array(
                        'title'  => '封面幻灯片设置',
                        'fields' => CFS_Module::slide(),
                    ),
                ),
            ),
            array(
                'title'   => '视频封面',
                'label'   => '允许设置视频为文章封面',
                'id'      => 'article_video_cover',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'dependency' => array('article_video_cover', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '视频封面配置',
                'class'      => 'compact',
                'desc'       => '<a target="_blank" href="https://www.zibll.com/1900.html">查看官方封面配置教程</a>',
                'id'         => 'article_video_cover_option',
                'type'       => 'fieldset',
                'fields'     => array(
                    array(
                        'title'   => '固定长宽比例',
                        'desc'    => '为0则不固定长宽比例',
                        'id'      => 'scale',
                        'default' => 0,
                        'max'     => 200,
                        'min'     => 0,
                        'step'    => 5,
                        'unit'    => '%',
                        'type'    => 'spinner',
                    ),
                ),
            ),
            array(
                'title'   => __('内容段落缩进', 'zib_language'),
                'id'      => 'post_p_indent_s',
                'type'    => 'switcher',
                'help'    => '开启后文章内容每一个段落首行将向右偏移2个文字距离',
                'default' => false,
            ),
            array(
                'title'   => __('面包屑导航', 'zib_language'),
                'id'      => 'breadcrumbs_single_s',
                'class'   => 'compact',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'dependency' => array('breadcrumbs_single_s', '!=', ''),
                'title'      => ' ',
                'subtitle'   => __('面包屑导航用“首页”替代网站名称', 'zib_language'),
                'id'         => 'breadcrumbs_home_text',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
            ),
            array(
                'title'   => __('上一页、下一页板块', 'zib_language'),
                'id'      => 'post_prevnext_s',
                'class'   => 'compact',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'title'   => __('作者信息板块', 'zib_language'),
                'id'      => 'post_authordesc_s',
                'class'   => 'compact',
                'type'    => 'switcher',
                'default' => true,
            ),

            array(
                'title'    => '内容高度限制',
                'subtitle' => '此处为全局设置，每篇文章可单独设置',
                'id'       => 'article_maxheight_kg',
                'label'    => '全局开关',
                'default'  => false,
                'type'     => 'switcher',
            ),

            array(
                'title'    => ' ',
                'subtitle' => __('限制的最大高度', 'zib_language'),
                'desc'     => '开启后如果文章高度超过设定值则会显示展开阅读全文的按钮。每篇文章可单独开启此功能',
                'id'       => 'article_maxheight',
                'class'    => 'compact',
                'default'  => 1000,
                'max'      => 3000,
                'min'      => 600,
                'step'     => 100,
                'prefix'   => '',
                'unit'     => 'px',
                'type'     => 'slider',
            ),
            array(
                'title'   => __('精彩一言功能'),
                'type'    => 'content',
                'content' => '将一言内容插入到文章页位置，如需修改内容，文件地址在：' . get_theme_file_path() . '/yiyan/qv-yiyan.txt',
            ),
            array(
                'title'    => ' ',
                'subtitle' => '文章内容头部显示一言',
                'class'    => 'compact',
                'id'       => 'yiyan_single_content_header',
                'type'     => 'switcher',
                'default'  => false,
            ),

            array(
                'title'    => ' ',
                'subtitle' => '文章内容尾部显示一言',
                'id'       => 'yiyan_single_content_footer',
                'class'    => 'compact',
                'type'     => 'switcher',
                'default'  => false,
            ),

            array(
                'title'    => ' ',
                'subtitle' => '文章页面下方独立一言板块',
                'id'       => 'yiyan_single_box',
                'type'     => 'switcher',
                'default'  => true,
                'class'    => 'compact',
            ),

            array(
                'title'   => __('版权声明', 'zib_language'),
                'id'      => 'post_copyright_s',
                'type'    => 'switcher',
                'default' => true,
            ),

            array(
                'dependency' => array('post_copyright_s', '!=', ''),
                'title'      => ' ',
                'subtitle'   => __('版权提示内容', 'zib_language'),
                'desc'       => '支持HTML代码，请注意代码规范及标签闭合',
                'class'      => 'compact',
                'id'         => 'post_copyright',
                'default'    => '文章版权归作者所有，未经允许请勿转载。',
                'attributes' => array(
                    'rows' => 2,
                ),
                'sanitize'   => false,
                'type'       => 'textarea',
            ),

            array(
                'title'   => __('文章页脚文案', 'zib_language'),
                'id'      => 'post_button_toptext',
                'type'    => "text",
                'default' => '喜欢就支持一下吧',
                'desc'    => __('文章底部打赏、分享按钮上面的文字', 'zib_language'),
            ),

            array(
                'title'      => __('文章插入内容', 'zib_language'),
                'subtitle'   => '在文章内容前-插入内容',
                'id'         => 'post_front_content',
                'default'    => '',
                'attributes' => array(
                    'rows' => 3,
                ),
                'sanitize'   => false,
                'type'       => 'textarea',
            ),

            array(
                'title'      => ' ',
                'subtitle'   => '在文章内容后-插入内容',
                'id'         => 'post_after_content',
                'class'      => 'compact',
                'default'    => '',
                'desc'       => '在每篇文章顶部和尾部插入内容，可以插入广告或者文章说明等内容</br>支持HTML代码，请注意代码规范及标签闭合',
                'attributes' => array(
                    'rows' => 3,
                ),
                'sanitize'   => false,
                'type'       => 'textarea',
            ),

            array(
                'title'   => __('相关文章板块', 'zib_language'),
                'id'      => 'post_related_s',
                'type'    => 'switcher',
                'default' => true,
            ),

            array(
                'dependency' => array('post_related_s', '!=', ''),
                'title'      => ' ',
                'class'      => 'compact',
                'subtitle'   => __('显示样式', 'zib_language'),
                'dependency' => array('post_related_s', '!=', ''),
                'id'         => 'post_related_type',
                'default'    => "img",
                'type'       => "image_select",
                'options'    => array(
                    'img'  => $f_imgpath . 'related_img.png',
                    'list' => $f_imgpath . 'related_list.png',
                    'text' => $f_imgpath . 'related_text.png',
                ),
            ),

            array(
                'dependency' => array('post_related_s', '!=', ''),
                'title'      => ' ',
                'subtitle'   => __('板块标题', 'zib_language'),
                'id'         => 'related_title',
                'class'      => 'compact',
                'default'    => '相关推荐',
                'type'       => 'text',
            ),

            array(
                'dependency' => array('post_related_s', '!=', ''),
                'class'      => 'compact',
                'title'      => ' ',
                'subtitle'   => __('显示数量', 'zib_language'),
                'id'         => 'post_related_n',
                'default'    => 6,
                'max'        => 12,
                'min'        => 4,
                'step'       => 2,
                'unit'       => '篇',
                'type'       => 'spinner',
            ),

        ),
    ));
    //文章功能
    CSF::createSection($prefix, array(
        'parent'      => 'post',
        'title'       => '文章功能' . $new_badge['6.3'],
        'icon'        => 'fa fa-fw fa-fw fa-magic',
        'description' => '',
        'fields'      => array(
            array(
                'id'      => 'article_nav',
                'title'   => '文章目录树',
                'desc'    => '默认开关，每篇文章可单独设置。开启后请自行添加文章目录树模块到侧边栏|<a target="_blank" href="https://www.zibll.com/1717.html">查看官网教程</a>',
                'default' => true,
                'type'    => 'switcher',
            ),
            array(
                'dependency' => array('article_nav', '!=', ''),
                'id'         => 'article_nav_mobile_nav_s',
                'class'      => 'compact',
                'title'      => ' ',
                'subtitle'   => '在移动端弹出菜单内显示',
                'desc'       => '如需显示在侧边栏等其它位置，请使用小工具模块添加',
                'default'    => true,
                'type'       => 'switcher',
            ),
            array(
                'id'      => 'imagelightbox',
                'title'   => '图片灯箱',
                'default' => true,
                'desc'    => '点击图片查看原图功能，共两种模式|<a target="_blank" href="https://www.zibll.com/683.html">查看官网教程</a>',
                'type'    => 'switcher',
            ),
            array(
                'dependency' => array('imagelightbox', '!=', ''),
                'id'         => 'imagelightbox_type',
                'title'      => ' ',
                'class'      => 'compact',
                'subtitle'   => '图片灯箱模式',
                'default'    => 'group',
                'type'       => "radio",
                'options'    => array(
                    'group' => '组合模式(将文章的全部图片组合成一组灯箱)',
                    'alone' => '单张模式(点击某张图片仅显示该图片)',
                ),
            ),
            array(
                'dependency' => array('imagelightbox|imagelightbox_type', '!=|==', '|group'),
                'title'      => ' ',
                'class'      => 'compact',
                'subtitle'   => '缩略图导航',
                'inline'     => true,
                'id'         => 'imagelightbox_thumbs_s',
                'type'       => "checkbox",
                'options'    => array(
                    'pc_s' => 'PC端开启',
                    'm_s'  => '移动端开启',
                ),
                'default'    => array('pc_s', 'm_s'),
            ),
            array(
                'dependency' => array('imagelightbox|imagelightbox_type', '!=|==', '|group'),
                'title'      => ' ',
                'class'      => 'compact',
                'subtitle'   => '播放按钮',
                'inline'     => true,
                'id'         => 'imagelightbox_play_s',
                'type'       => "checkbox",
                'options'    => array(
                    'pc_s' => 'PC端开启',
                    'm_s'  => '移动端开启',
                ),
                'default'    => array('pc_s', 'm_s'),
            ),
            array(
                'dependency' => array('imagelightbox|imagelightbox_type', '!=|==', '|group'),
                'title'      => ' ',
                'class'      => 'compact',
                'subtitle'   => '缩放按钮',
                'inline'     => true,
                'id'         => 'imagelightbox_zoom_s',
                'type'       => "checkbox",
                'options'    => array(
                    'pc_s' => 'PC端开启',
                    'm_s'  => '移动端开启',
                ),
                'default'    => array('pc_s'),
            ),
            array(
                'dependency' => array('imagelightbox|imagelightbox_type', '!=|==', '|group'),
                'title'      => ' ',
                'class'      => 'compact',
                'subtitle'   => '下载按钮',
                'inline'     => true,
                'id'         => 'imagelightbox_down_s',
                'type'       => "checkbox",
                'options'    => array(
                    'pc_s' => 'PC端开启',
                    'm_s'  => '移动端开启',
                ),
                'default'    => array('pc_s'),
            ),
            array(
                'title'   => ' ',
                'id'      => 'post_like_s',
                'title'   => '文章点赞',
                'default' => true,
                'type'    => 'switcher',
            ),
            array(
                'title'   => __('分享功能', 'zib_language'),
                'id'      => 'share_s',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'title'   => __('微信分享有图', 'zib_language') . $new_badge['6.3'],
                'label'   => '使用微信JSAPI在微信app内分享',
                'id'      => 'wechat_share_s',
                'type'    => 'switcher',
                'default' => false,
            ),
            array(
                'dependency' => array('wechat_share_s', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '微信分享有图配置',
                'sanitize'   => false,
                'id'         => 'wechat_share_option',
                'type'       => 'fieldset',
                'class'      => 'compact',
                'fields'     => array(
                    array(
                        'content' => '<h4><b>JS接口安全域名：</b>' . preg_replace('/^(?:https?:\/\/)?([^\/]+).*$/im', '$1', home_url()) . '</h4>申请地址：<a target="_blank" href="https://mp.weixin.qq.com/">https://mp.weixin.qq.com/</a> | <a target="_blank" href="https://www.zibll.com/?s=微信分享">查看官方教程</a>',
                        'style'   => 'info',
                        'type'    => 'submessage',
                    ),
                    array(
                        'title' => 'AppID',
                        'id'    => 'appid',
                        'type'  => 'text',
                    ),
                    array(
                        'title' => 'AppSecret',
                        'class' => 'compact',
                        'id'    => 'app_secret',
                        'type'  => 'text',
                    ),
                    array(
                        'title'   => __('全部使用网站图标', 'zib_language'),
                        'desc'    => '默认会自动获取页面封面图片作为微信分享的图片，开启此选项后所有页面的图片均使用网站图标作为图片<br/>如果开启了图片防盗链，可开启此选项已避免图片不显示',
                        'id'      => 'only_logo',
                        'type'    => 'switcher',
                        'default' => false,
                    ),
                ),
            ),
            array(
                'title'   => __('生成海报分享', 'zib_language'),
                'help'    => '网站图片如果使用了OSS等云储存，请先设置跨域规则',
                'id'      => 'share_img',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'dependency' => array('share_img', '!=', '', '', 'visible'),
                'type'       => 'submessage',
                'style'      => 'warning',
                'content'    => '<i class="fa fa-fw fa-info-circle fa-fw"></i> 此功能如果加载出错，请检查图片的跨域设置！<a target="_blank" href="https://www.zibll.com/886.html">查看详细教程</a>',
            ),
            array(
                'dependency' => array('share_img', '!=', ''),
                'id'         => 'share_img_byimg',
                'title'      => ' ',
                'subtitle'   => __('海报分享默认图片'),
                'desc'       => '当文章没有任何图片时显示此图片，建议尺寸800*500',
                'default'    => $imagepath . 'slider-bg.jpg',
                'library'    => 'image', 'type' => 'upload',
            ),
            array(
                'dependency' => array('share_img', '!=', ''),
                'id'         => 'share_logo',
                'title'      => ' ',
                'subtitle'   => __('海报分享LOGO'),
                'desc'       => '显示在海报底部的LOGO，建议尺寸300x100，大小50kb以内',
                'class'      => 'compact',
                'default'    => $imagepath . 'logo.png',
                'library'    => 'image', 'type' => 'upload',
            ),
            array(
                'dependency' => array('share_img', '!=', ''),
                'title'      => ' ',
                'subtitle'   => __('海报分享底部文案', 'zib_language'),
                'class'      => 'compact',
                'id'         => 'share_desc',
                'default'    => __('扫一扫 立即查看', 'zib_language'),
                'type'       => 'text',
            ),
            array(
                'title'   => '文章预置参数',
                'id'      => 'post_default_mate',
                'type'    => 'fieldset',
                'default' => array(
                    'views' => array(
                        'min' => 20,
                        'max' => 50,
                    ),
                    'like'  => array(
                        'min' => 5,
                        'max' => 15,
                    ),
                ),
                'fields'  => array(
                    array(
                        'title'    => '阅读量',
                        'id'       => 'views',
                        'validate' => 'csf_validate_numeric',
                        'type'     => 'between_number',
                    ),
                    array(
                        'title'    => '点赞数',
                        'class'    => 'compact',
                        'id'       => 'like',
                        'validate' => 'csf_validate_numeric',
                        'type'     => 'between_number',
                        'desc'     => '新建文章时系统会根据此处设置的区间获取随机值填入对应项',
                    ),
                ),
            ),

        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'post',
        'title'       => '评论设置',
        'icon'        => 'fa fa-fw fa-comments',
        'description' => '',
        'fields'      => array(
            array(
                'dependency' => array('close_comments', '==', '', '', 'visible'),
                'type'       => 'submessage',
                'style'      => 'warning',
                'content'    => '<div style="text-align:cent er;"><i class="fa fa-fw fa-info-circle fa-fw"></i> WordPress默认关闭评论翻页功能，如需启用请按此进行设置：<br/>1.进入<a href="' . admin_url('options-discussion.php') . '">WP讨论设置</a>，勾选<code>分页显示评论</code><br/>2.设置默认显示<code>最前</code>一页<br/>3.设置在每个页面顶部显示<code>旧的</code>评论<br/>4.根据需要设置每一页显示数量<br/>5.根据需要设置评论嵌套（推荐开启并设置为3层）</div>',
            ),
            array(
                'title'   => '关闭文章评论功能',
                'id'      => 'close_comments',
                'type'    => 'switcher',
                'desc'    => '部分网站无需交互，或需备案审核，可在此关闭所有文章的评论功能。同时每一篇文章可单独关闭评论功能',
                'default' => false,
            ),
            array(
                'dependency' => array('close_comments', '==', '', '', 'visible'),
                'id'         => 'comment_paginate_type',
                'title'      => '评论列表翻页模式',
                'default'    => 'default',
                'type'       => "radio",
                'inline'     => true,
                'options'    => array(
                    'ajax_lists' => __('AJAX追加列表翻页', 'zib_language'),
                    'default'    => __('数字翻页按钮', 'zib_language'),
                ),
            ),
            array(
                'dependency' => array('comment_paginate_type', '==', 'ajax_lists'),
                'title'      => ' ',
                'subtitle'   => 'AJAX翻页自动加载',
                'class'      => 'compact',
                'id'         => 'comment_paging_ajax_ias_s',
                'type'       => 'switcher',
                'label'      => '页面滚动到列表尽头时，自动加载下一页',
                'default'    => true,
            ),
            array(
                'dependency' => array('comment_paginate_type|comment_paging_ajax_ias_s', '==|!=', 'ajax_lists|'),
                'title'      => ' ',
                'subtitle'   => '自动加载页数',
                'desc'       => 'AJAX翻页自动加载最多加载几页（为0则不限制，直到加载全部评论）',
                'id'         => 'comment_paging_ajax_ias_max',
                'class'      => 'compact',
                'default'    => 3,
                'max'        => 10,
                'min'        => 0,
                'step'       => 1,
                'unit'       => '页',
                'type'       => 'spinner',
            ),
            array(
                'dependency' => array('close_comments', '==', '', '', 'visible'),
                'id'         => 'comment_smilie',
                'help'       => '为了防止恶意评论，建议在后台-设置-讨论：开启"用户必须登录后才能发表评论"',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => __('允许插入表情', 'zib_language'),
            ),
            array(
                'dependency' => array('close_comments', '==', '', '', 'visible'),
                'id'         => 'comment_code',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => __('允许插入代码', 'zib_language'),
            ),
            array(
                'dependency' => array('close_comments', '==', '', '', 'visible'),
                'id'         => 'comment_img',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => __('允许插入图片', 'zib_language'),
            ),
            array(
                'dependency' => array('close_comments|comment_img', '==|!=', '|', '', 'visible'),
                'id'         => 'comment_upload_img',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => false,
                'title'      => __('允许上传图片', 'zib_language'),
            ),
            array(
                'dependency' => array('close_comments', '==', '', '', 'visible'),
                'id'         => 'comment_author_tag',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => __('显示“作者”标签', 'zib_language'),
            ),
            array(
                'dependency' => array('close_comments', '==', '', '', 'visible'),
                'id'         => 'user_edit_comment',
                'class'      => 'compact',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => '允许用户编辑评论',
            ),
            array(
                'dependency' => array('close_comments', '==', '', '', 'visible'),
                'id'         => 'comment_like_s',
                'title'      => '评论点赞功能',
                'default'    => true,
                'type'       => 'switcher',
            ),
            array(
                'dependency' => array('close_comments|comment_like_s', '==|!=', '|', '', 'visible'),
                'id'         => 'comment_corderby',
                'label'      => '显示“最新、最热”排序按钮',
                'type'       => 'switcher',
                'default'    => true,
                'title'      => __('评论排序功能', 'zib_language'),
            ),
            array(
                'dependency' => array('close_comments', '==', '', '', 'visible'),
                'title'      => __('自定义文案', 'zib_language'),
                'subtitle'   => __('自定义评论标题', 'zib_language'),
                'id'         => 'comment_title',
                'class'      => '',
                'default'    => __('评论', 'zib_language'),
                'attributes' => array(
                    'rows' => 1,
                ),
                'sanitize'   => false,
                'type'       => 'textarea',
            ),

            array(
                'dependency' => array('close_comments', '==', '', '', 'visible'),
                'id'         => 'comment_submit_text',
                'class'      => 'compact',
                'title'      => ' ',
                'subtitle'   => __('自定义评论提交按钮文案', 'zib_language'),
                'default'    => __('提交评论', 'zib_language'),
                'attributes' => array(
                    'rows' => 1,
                ),
                'sanitize'   => false,
                'type'       => 'textarea',
            ),
            array(
                'dependency' => array('close_comments', '==', '', '', 'visible'),
                'id'         => 'comment_text',
                'class'      => 'compact',
                'title'      => ' ',
                'subtitle'   => __('自定义评论框占位符文案', 'zib_language'),
                'default'    => __('欢迎您留下宝贵的见解！', 'zib_language'),
                'type'       => 'text',
            ),
        ),
    ));
    CSF::createSection($prefix, array(
        'parent'      => 'post',
        'title'       => '前台投稿',
        'icon'        => 'fa fa-fw fa-pencil',
        'description' => '',
        'fields'      => array(
            array(
                'title'   => __('前端发布文章', 'zib_language'),
                'id'      => 'post_article_s',
                'default' => true,
                'type'    => 'switcher',
                'desc'    => '此功能启用后，可以在<a href="' . zib_get_admin_csf_url('功能&权限/基本权限') . '">权限管理</a>中设置用户的发布、审核权限',
            ),
            array(
                'dependency' => array('post_article_s', '!=', '', '', 'visible'),
                'id'         => 'post_article_btn_txte',
                'class'      => 'mini-input',
                'title'      => '按钮文字',
                'desc'       => '投稿按钮的显示的文字，推荐4个字更加协调',
                'default'    => '发布文章',
                'type'       => 'text',
            ),
            array(
                'dependency'  => array('post_article_s', '!=', '', '', 'visible'),
                'title'       => __('允许选择的分类'),
                'id'          => 'post_article_cat',
                'placeholder' => '允许选择的分类，为空则允许选择全部分类',
                'default'     => array(),
                'options'     => 'categories',
                'type'        => 'select',
                'chosen'      => true,
                'multiple'    => true,
                'sortable'    => true,
            ),
            array(
                'dependency'  => array('post_article_s', '!=', ''),
                'id'          => 'post_article_user',
                'options'     => 'user',
                'default'     => 1,
                'desc'        => '当选择投稿权限为无需登录就能投稿时，投稿文章的用户',
                'placeholder' => '输入关键词以搜索用户',
                'chosen'      => true,
                'ajax'        => true,
                'settings'    => array(
                    'min_length' => 2,
                ),
                'title'       => '免登陆投稿发布用户',
                'type'        => 'select',
            ),
            array(
                'title'   => '标题字数限制' . $new_badge['6.4'],
                'desc'    => '限制标题字数可有效的防止灌水等无意义内容（英文字符按0.5个字计算）',
                'id'      => 'post_article_title_strlen_limit',
                'type'    => 'between_number',
                'desc'    => '',
                'unit'    => '字',
                'default' => array(
                    'min' => 5,
                    'max' => 30,
                ),
            ),
            array(
                'dependency' => array('post_article_s', '!=', ''),
                'title'      => __('付费内容允许设置会员价', 'zib_language'),
                'id'         => 'post_article_pay_vip_price_s',
                'default'    => true,
                'type'       => 'switcher',
                'desc'       => '前台投稿时对拥有设置付费内容权限的用户，是否开启设置会员价格<br/>开启此项，会直接在前台显示设置会员价的选项<br/>关闭此项，则用户只能设置普通价格，会员价则按照下方设置的折扣自动计算',
            ),
            array(
                'dependency' => array('post_article_s|post_article_pay_vip_price_s', '!=|==', '|'),
                'id'         => 'post_article_pay_vip_1_discount', //折扣
                'title'      => ' ',
                'subtitle'   => _pz('pay_user_vip_1_name') . '折扣',
                'default'    => 100,
                'type'       => 'number',
                'unit'       => '%',
                'class'      => 'compact',
            ),
            array(
                'dependency' => array('post_article_s|post_article_pay_vip_price_s', '!=|==', '|'),
                'id'         => 'post_article_pay_vip_2_discount', //折扣
                'class'      => 'compact',
                'title'      => ' ',
                'subtitle'   => _pz('pay_user_vip_2_name') . '折扣',
                'desc'       => '执行价的百分之多少，0为免费，100为没有折扣，不能高于100',
                'default'    => 100,
                'type'       => 'number',
                'unit'       => '%',
                'class'      => 'compact',
            ),
        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'cap',
        'title'       => '基本权限' . $new_badge['6.3'],
        'icon'        => 'fa fa-fw fa-unlock-alt',
        'description' => '',
        'fields'      => CFS_Module::user_can_fields(CFS_Module::user_caps(), '<p>用户权限、用户能力管理系统<br/>管理用户在前台的功能使用权限</p>'),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'user',
        'title'       => '消息通知',
        'icon'        => 'fa fa-fw fa-bell-o',
        'description' => '',
        'fields'      => array(
            array(
                'title'   => '站内通知',
                'label'   => '通知消息功能',
                'id'      => 'message_s',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'dependency' => array('message_s', '!=', ''),
                'title'      => ' ',
                'type'       => 'content',
                'class'      => 'compact',
                'style'      => 'warning',
                'content'    => '<div style="text-align:cent er;"><a target="_blank" href="https://www.zibll.com/1244.html">查看教程</a> | <a href="' . admin_url('users.php?page=user_messags') . '">管理系统消息</a> | <a href="' . admin_url('users.php?page=user_messags&tab=new') . '">推送系统消息</a> | <a href="' . admin_url('users.php') . '">管理用户消息</a></div>',
            ),
            array(
                'dependency' => array('message_s', '!=', ''),
                'id'         => 'msg_center_rewrite_slug',
                'title'      => '消息中心URL别名',
                'class'      => 'mini-input',
                'default'    => '',
                'desc'       => '开启固定链接之后，可以在此自定义消息中心的链接后缀URL别名，默认为<code>message</code>
                <div style="color:#ff4021;"><i class="fa fa-fw fa-info-circle fa-fw"></i>如非必要，建议留空保持默认</div>',
                'type'       => 'text',
            ),
            array(
                'dependency' => array('message_s', '!=', ''),
                'title'      => '显示通知图标',
                'id'         => 'message_icon_show',
                'default'    => array('nav_menu', 'm_nav_user'),
                'options'    => array(
                    'nav_menu' => 'PC端顶部导航',
                ),
                'desc'       => '选择需要显示消息图标的位置',
                'type'       => 'checkbox',
            ),
            array(
                'dependency' => array('message_s', '!=', ''),
                'id'         => 'message_paginate_type',
                'title'      => '列表翻页模式',
                'default'    => 'ajax_lists',
                'type'       => "radio",
                'inline'     => true,
                'options'    => array(
                    'ajax_lists' => __('AJAX追加列表翻页', 'zib_language'),
                    'default'    => __('数字翻页按钮', 'zib_language'),
                ),
            ),
            array(
                'dependency' => array('message_s', '!=', '', '', 'visible'),
                'title'      => '关闭推送',
                'subtitle'   => '关闭部分消息推送',
                'id'         => 'message_close_msg_type',
                'default'    => array(),
                'options'    => array(
                    'posts'          => '关闭文章类消息推送',
                    'comment'        => '关闭评论类消息推送',
                    'favorite'       => '关闭文章收藏消息推送',
                    'like'           => '关闭点赞消息推送',
                    'hot'            => '关闭内容成为热门消息推送',
                    'followed'       => '关闭用户关注消息推送',
                    'system'         => '关闭系统类消息推送',
                    'pay'            => '关闭订单消息推送',
                    'withdraw_reply' => '关闭提现消息推送',
                ),
                'help'       => '注意，只有关闭期间不会推送！已经推送的消息仍会显示。',
                'type'       => 'checkbox',
            ),
            array(
                'dependency' => array('message_s', '!=', '', '', 'visible'),
                'title'      => '允许用户设置',
                'label'      => '用户前台消息推送设置',
                'id'         => 'message_user_set',
                'type'       => 'switcher',
                'default'    => true,
            ),
            array(
                'dependency' => array('message_s', '!=', '', '', 'visible'),
                'title'      => '私信功能',
                'id'         => 'private_s',
                'type'       => 'switcher',
                'default'    => true,
            ),
            array(
                'dependency' => array('private_s|message_s', '!=|!=', '|'),
                'id'         => 'private_option',
                'type'       => 'fieldset',
                'title'      => '私信功能设置',
                'default'    => array(
                    'upload_img'  => false,
                    'smilie_s'    => true,
                    'code_s'      => true,
                    'image_s'     => true,
                    'submit_text' => '<i class="fa fa-send-o"></i>发送',
                    'placeholder' => '',
                ),
                'fields'     => array(
                    array(
                        'id'      => 'smilie_s',
                        'type'    => 'switcher',
                        'default' => true,
                        'title'   => __('允许插入表情', 'zib_language'),
                    ),
                    array(
                        'id'      => 'code_s',
                        'class'   => 'compact',
                        'type'    => 'switcher',
                        'default' => true,
                        'title'   => __('允许插入代码', 'zib_language'),
                    ),
                    array(
                        'id'      => 'image_s',
                        'class'   => 'compact',
                        'type'    => 'switcher',
                        'default' => true,
                        'title'   => __('允许插入图片', 'zib_language'),
                    ),
                    array(
                        'dependency' => array('image_s', '!=', ''),
                        'id'         => 'upload_img',
                        'class'      => 'compact',
                        'type'       => 'switcher',
                        'default'    => false,
                        'title'      => __('允许上传图片', 'zib_language'),
                    ),
                    array(
                        'id'         => 'submit_text',
                        'title'      => __('自定义文案', 'zib_language'),
                        'subtitle'   => __('自定义提交按钮文案', 'zib_language'),
                        'default'    => '<i class="fa fa-send-o"></i>发送',
                        'attributes' => array(
                            'rows' => 1,
                        ),
                        'sanitize'   => false,
                        'type'       => 'textarea',
                    ),

                    array(
                        'id'       => 'placeholder',
                        'class'    => 'compact',
                        'title'    => ' ',
                        'subtitle' => __('自定义占位符文案', 'zib_language'),
                        'default'  => '',
                        'type'     => 'text',
                    ),

                ),
            ),

        ),
    ));

    //注册登录
    CSF::createSection($prefix, array(
        'parent'      => 'user',
        'title'       => '注册登录',
        'icon'        => 'fa fa-fw fa-user-plus',
        'description' => '',
        'fields'      => array(
            array(
                'content' => '<p>无论您选择哪种登录模式，均可使用以下地址(请注意，以下地址仅在未登录时有效)</p>
                <li>登录地址：<code>' . add_query_arg('tab', 'signin', zib_get_template_page_url('pages/user-sign.php')) . '</code></li>
                <li>注册地址：<code>' . add_query_arg('tab', 'signup', zib_get_template_page_url('pages/user-sign.php')) . '</code></li>
                <li>找回密码地址：<code>' . add_query_arg('tab', 'resetpassword', zib_get_template_page_url('pages/user-sign.php')) . '</code></li>
                <div style="color:#ff2153;"><i class="fa fa-fw fa-info-circle fa-fw"></i>下方涉及到邮箱或者短信验证的功能，请确保邮件和短信能正常发送！</div>
                <a href="' . zib_get_admin_csf_url('全局功能/email邮件') . '">邮件设置</a> | <a href="' . zib_get_admin_csf_url('用户互动/短信接口') . '">短信设置</a>',
                'style'   => 'warning',
                'type'    => 'submessage',
            ),
            array(
                'title'   => '关闭注册登录功能',
                'label'   => '前台禁用注册/登录功能',
                'desc'    => '部分网站无需用户交互，可在此禁用用户登录/注册功能，不影响后台管理员登录',
                'id'      => 'close_sign',
                'default' => false,
                'type'    => 'switcher',
            ),
            array(
                'dependency' => array('close_sign', '==', ''),
                'title'      => '登录注册模式',
                'id'         => 'user_sign_type',
                'default'    => 'modal',
                'inline'     => true,
                'type'       => "radio",
                'options'    => array(
                    'modal' => '弹窗登录/注册',
                    'page'  => '独立页面登录/注册',
                ),
            ),
            array(
                'title'   => '代替WP自带登录页面',
                'label'   => '使用主题的登录/注册页面代替WP自带的登录注册页面',
                'id'      => 'replace_wp_login',
                'default' => true,
                'type'    => 'switcher',
            ),
            array(
                'dependency' => array('close_sign', '==', ''),
                'title'      => '弹窗登录/注册',
                'subtitle'   => '登录/注册弹窗相关配置',
                'id'         => 'user_modal_option',
                'type'       => 'accordion',
                'accordions' => array(
                    array(
                        'title'  => '登录/注册弹窗的个性化设置',
                        'fields' => array(
                            array(
                                'title'       => '左侧图片',
                                'id'          => 'background',
                                'type'        => 'gallery',
                                'add_title'   => '新增图片',
                                'edit_title'  => '编辑图片',
                                'clear_title' => '清空图片',
                                'default'     => false,
                                'desc'        => '登录框左侧图片，如选择多张图片则随机显示<br>由于登录框的高度会根据开启的功能不同而变化，所以此处的尺寸建议根据实际情况调整',
                            ),
                            array(
                                'title'   => '显示LOGO',
                                'class'   => 'compact',
                                'id'      => 'show_logo',
                                'default' => false,
                                'type'    => 'switcher',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'title'      => '登录/注册页面',
                'subtitle'   => '登录/注册页面相关配置',
                'id'         => 'user_sign_page_option',
                'type'       => 'accordion',
                'accordions' => array(
                    array(
                        'title'  => '登录/注册/找回密码的页面配置',
                        'fields' => array(
                            array(
                                'id'          => 'background',
                                'type'        => 'gallery',
                                'add_title'   => '新增背景图',
                                'edit_title'  => '编辑背景图',
                                'clear_title' => '清空背景图',
                                'title'       => '页面背景图',
                                'default'     => false,
                                'desc'        => '页面的背景图，如果选择多张图则随机获取一张。',
                            ),
                            array(
                                'title'   => '显示顶部导航',
                                'class'   => 'compact',
                                'id'      => 'show_header',
                                'default' => false,
                                'type'    => 'switcher',
                            ),
                            array(
                                'title'   => '卡片位置',
                                'id'      => 'card_position',
                                'default' => 'right',
                                'class'   => 'compact',
                                'type'    => "radio",
                                'inline'  => true,
                                'options' => array(
                                    'left'   => '靠左',
                                    'center' => '居中',
                                    'right'  => '靠右',
                                ),
                            ),
                            array(
                                'title'   => '显示卡片LOGO',
                                'id'      => 'show_logo',
                                'class'   => 'compact',
                                'default' => false,
                                'type'    => 'switcher',
                            ),
                            array(
                                'title'      => __('页脚内容', 'zib_language'),
                                'desc'       => '在页面底部添加内容，支持HTML代码(不建议内容过多)',
                                'id'         => 'footer',
                                'class'      => 'compact',
                                'default'    => 'Copyright &copy;&nbsp;' . date('Y') . '&nbsp;·&nbsp;<a href="' . home_url() . '">' . get_bloginfo('title') . '</a>&nbsp;·&nbsp;由<a target="_blank" href="https://zibll.com">Zibll主题</a>强力驱动.',
                                'attributes' => array(
                                    'rows' => 2,
                                ),
                                'sanitize'   => false,
                                'type'       => 'textarea',
                            ),

                        ),
                    ),
                ),
            ),
            array(
                'title'      => '登录框LOGO',
                'subtitle'   => '登录/注册卡片LOGO',
                'id'         => 'user_card_option',
                'type'       => 'accordion',
                'accordions' => array(
                    array(
                        'title'  => '登录/注册卡片LOGO设置',
                        'fields' => array(
                            array(
                                'title'    => __('登录框logo', 'zib_language'),
                                'subtitle' => __('日间主题', 'zib_language'),
                                'id'       => 'user_logo',
                                'subtitle' => __('日间主题', 'zib_language'),
                                'desc'     => __('登录框顶部图像，建议尺寸450px*280px'),
                                'help'     => '如果单张图能同时适应日间和夜间主题，则仅设置日间主题的图片即可（推荐这样设置）',
                                'default'  => $imagepath . 'logo.png',
                                'preview'  => true,
                                'library'  => 'image', 'type' => 'upload',
                            ),
                            array(
                                'title'    => __('登录框logo', 'zib_language'),
                                'subtitle' => __('夜间主题', 'zib_language'),
                                'id'       => 'user_logo_dark',
                                'class'    => 'compact',
                                'default'  => $imagepath . 'logo_dark.png',
                                'preview'  => true,
                                'library'  => 'image', 'type' => 'upload',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'dependency' => array('close_sign', '==', ''),
                'title'      => '绑定设置',
                'subtitle'   => '用户绑定手机/邮箱设置',
                'id'         => 'user_bind_option',
                'type'       => 'accordion',
                'accordions' => array(
                    array(
                        'title'  => '绑定手机/邮箱相关配置',
                        'fields' => array(
                            array(
                                'title'   => '手机绑定',
                                'id'      => 'bind_phone',
                                'label'   => '用户中心显示绑定、修改手机号功能',
                                'default' => false,
                                'type'    => 'switcher',
                            ),
                            array(
                                'title'   => '绑定提醒',
                                'id'      => 'bind_reminder',
                                'default' => "close",
                                'type'    => "radio",
                                'desc'    => '用户登录后如未绑定对应信息，会弹窗提示用户绑定',
                                'options' => array(
                                    'email'       => '提醒绑定邮箱',
                                    'phone'       => '提醒绑定手机',
                                    'email_phone' => '提醒绑定邮箱和手机',
                                    'close'       => '关闭',
                                ),
                            ),
                            array(
                                'dependency' => array('bind_reminder', '!=', 'close'),
                                'title'      => ' ',
                                'subtitle'   => __('绑定提醒文案', 'zib_language'),
                                'desc'       => __('提醒绑定弹窗的文案介绍，支持HTML代码', 'zib_language'),
                                'class'      => 'compact',
                                'id'         => 'bind_reminder_text',
                                'default'    => "为了您的账户安全，请务必完成账户绑定",
                                'sanitize'   => false,
                                'type'       => 'textarea',
                            ),
                            array(
                                'dependency' => array('bind_reminder', '!=', 'close'),
                                'title'      => ' ',
                                'subtitle'   => '提醒周期',
                                'id'         => 'bind_reminder_expires',
                                'class'      => 'compact',
                                'desc'       => __('多少时间内不重复弹窗提醒（允许为小数，为0则每次刷新页面都会弹出）', 'zib_language'),
                                'default'    => 24,
                                'max'        => 2000,
                                'min'        => 0,
                                'step'       => 2,
                                'unit'       => '小时',
                                'type'       => 'spinner',
                            ),
                            array(
                                'title'   => '强制绑定',
                                'id'      => 'mandatory_bind',
                                'default' => "close",
                                'type'    => "radio",
                                'desc'    => '登录必须先绑定信息，才能完成登录(对管理员无效)',
                                'options' => array(
                                    'email'       => '必须绑定邮箱',
                                    'phone'       => '必须绑定手机',
                                    'email_phone' => '必须绑定邮箱和手机',
                                    'close'       => '关闭',
                                ),
                            ),
                            array(
                                'dependency' => array('mandatory_bind', '!=', 'close'),
                                'title'      => ' ',
                                'subtitle'   => __('强制绑定文案', 'zib_language'),
                                'desc'       => __('强制绑定的文案介绍，支持HTML代码', 'zib_language'),
                                'class'      => 'compact',
                                'id'         => 'mandatory_bind_text',
                                'default'    => "为了您的账户安全，请先完成账户绑定",
                                'sanitize'   => false,
                                'type'       => 'textarea',
                            ),
                            array(
                                'title'   => '绑定邮箱需验证',
                                'id'      => 'email_set_captch',
                                'label'   => '用户修改、绑定邮箱需先验证',
                                'default' => true,
                                'type'    => 'switcher',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'title'   => '手机号登录',
                'label'   => '允许使用手机号作为用户名登录',
                'id'      => 'user_signin_phone_s',
                'default' => false,
                'type'    => 'switcher',
            ),
            array(
                'title'   => '免密登录',
                'label'   => '使用验证码免密登录',
                'id'      => 'user_signin_nopas_s',
                'default' => false,
                'type'    => 'switcher',
            ),
            array(
                'dependency' => array('user_signin_nopas_s', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '免密登录方式',
                'id'         => 'user_signin_nopas_type',
                'class'      => 'compact',
                'default'    => "email",
                'type'       => "radio",
                'options'    => array(
                    'email'       => '邮箱验证',
                    'phone'       => '手机验证',
                    'email_phone' => '邮箱或手机验证',
                ),
            ),
            array(
                'dependency' => array('user_signin_nopas_s', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '登录方式优先显示',
                'id'         => 'user_signin_nopas_active',
                'class'      => 'compact',
                'default'    => "nopas",
                'inline'     => true,
                'type'       => "radio",
                'options'    => array(
                    'nopas' => '免密登录',
                    'pas'   => '帐号密码登录',
                ),
            ),
            array(
                'title'   => '注册需验证',
                'label'   => __('注册需要验证邮箱或手机号', 'zib_language'),
                'id'      => 'user_signup_captch',
                'default' => false,
                'type'    => 'switcher',
            ),
            array(
                'dependency' => array('user_signup_captch', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '注册验证方式',
                'id'         => 'captch_type',
                'class'      => 'compact',
                'default'    => "email",
                'type'       => "radio",
                'options'    => array(
                    'email'       => '邮箱验证',
                    'phone'       => '手机验证',
                    'email_phone' => '邮箱或手机验证',
                ),
            ),
            array(
                'dependency' => array('user_signup_captch', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '注册无需重复密码',
                'class'      => 'compact',
                'id'         => 'user_signup_no_repas',
                'default'    => true,
                'type'       => 'switcher',
            ),
            array(
                'title'    => '找回密码验证',
                'subtitle' => '找回密码验证方式',
                'id'       => 'user_repas_captch_type',
                'default'  => "email",
                'type'     => "radio",
                'options'  => array(
                    'email'       => '邮箱验证',
                    'phone'       => '手机验证',
                    'email_phone' => '邮箱或手机验证',
                ),
            ),
            array(
                'title'   => __('显示用户协议', 'zib_language'),
                'id'      => 'user_agreement_s',
                'default' => false,
                'type'    => 'switcher',
            ),
            array(
                'dependency' => array('user_agreement_s', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '用户协议页面',
                'class'      => 'compact',
                'id'         => 'user_agreement_page',
                'default'    => '',
                'desc'       => '请新建页面写入用户协议后，在此选择用户协议页面',
                'options'    => 'page',
                'query_args' => array(
                    'posts_per_page' => -1,
                ),
                'type'       => 'select',
            ),
            array(
                'title'   => __('显示隐私协议', 'zib_language'),
                'id'      => 'user_privacy_s',
                'default' => false,
                'type'    => 'switcher',
            ),
            array(
                'dependency' => array('user_privacy_s', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '隐私协议页面',
                'class'      => 'compact',
                'id'         => 'user_privacy_page',
                'default'    => '',
                'desc'       => '请新建页面写入隐私协议后，在此选择隐私协议页面',
                'options'    => 'page',
                'query_args' => array(
                    'posts_per_page' => -1,
                ),
                'type'       => 'select',
            ),
            array(
                'title'    => __('用户昵称限制', 'zib_language'),
                'subtitle' => __('禁止的昵称关键词', 'zib_language'),
                'desc'     => __('前台注册或修改昵称时，不能使用包含这些关键字的昵称(请用逗号或换行分割)', 'zib_language'),
                'id'       => 'user_nickname_out',
                'default'  => "赌博,博彩,彩票,性爱,色情,做爱,爱爱,淫秽,傻b,妈的,妈b,admin,test",
                'sanitize' => false,
                'type'     => 'textarea',
            ),
        ),
    ));

    //社交登录
    CSF::createSection($prefix, array(
        'parent'      => 'user',
        'title'       => '第三方登录',
        'icon'        => 'fa fa-fw fa-qq',
        'description' => '',
        'fields'      => array(
            array(
                'content' => '<i class="fa fa-fw fa-info-circle fa-fw"></i>使用第三方社交帐号登录功能，必须先设置好服务器伪静态，以及<a href="' . admin_url('options-permalink.php') . '">WP固定连接</a>（不能为朴素），否则会出现404错误！ | <a target="_blank" href="https://www.zibll.com/3025.html">查看官方教程</a>',
                'style'   => 'warning',
                'type'    => 'submessage',
                'class'   => 'text-center',
            ),
            array(
                'title'    => __('接入插件', 'zib_language'),
                'subtitle' => '使用Wechat Social社交登录插件',
                'id'       => 'social',
                'type'     => 'switcher',
                'default'  => false,
                'desc'     => 'Wechat Social社交登录（需安装迅虎网络的<a target="_blank" href="https://www.wpweixin.net/product/1067.html">Wechat Social</a>社会化登录插件）</br>此功能以及下方的社会化登录二选一',
            ),
            array(
                'title'    => __('按钮样式', 'zib_language'),
                'subtitle' => __('显示为大按钮', 'zib_language'),
                'id'       => 'oauth_button_lg',
                'default'  => false,
                'type'     => 'switcher',
            ),
            array(
                'title'   => __('微信自动登录', 'zib_language'),
                'label'   => '在微信APP内自动弹出微信登录（依赖微信公众号登录功能）',
                'id'      => 'weixingzh_auto',
                'default' => false,
                'type'    => 'switcher',
            ),
            array(
                'dependency' => array('weixingzh_auto', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '微信自动登录频率限制',
                'id'         => 'weixingzh_auto_expires',
                'class'      => 'compact',
                'desc'       => __('用户拒绝登录后多少小时内不会再次弹出(允许为小数)', 'zib_language'),
                'default'    => 3,
                'max'        => 2000,
                'min'        => 0,
                'step'       => 1,
                'unit'       => '小时',
                'type'       => 'spinner',
            ),
            array(
                'dependency' => array('social', '==', '', '', 'visible'),
                'id'         => 'oauth_agent',
                'title'      => '代理登录',
                'subtitle'   => '启用模式',
                'desc'       => '此功能可以让多个网站使用同一套社交登录接口进行社交登录 | <a target="_blank" href="https://www.zibll.com/2290.html">查看官方教程</a>',
                'default'    => 'close',
                'inline'     => true,
                'type'       => "radio",
                'options'    => array(
                    'server' => '代理登录服务端',
                    'client' => '代理登录客户端',
                    'close'  => '关闭',
                ),
            ),
            array(
                'dependency' => array('social|oauth_agent', '==|==', '|server'),
                'title'      => ' ',
                'subtitle'   => '代理服务器配置',
                'id'         => 'oauth_agent_server_option',
                'type'       => 'fieldset',
                'class'      => 'compact',
                'fields'     => array(
                    array(
                        'content' => '将此网站设置为社交登录<code>代理服务器</code>，其它网站可设置为代理登录客户端并接入此网站进行社交登录',
                        'style'   => 'info',
                        'type'    => 'submessage',
                    ),
                    array(
                        'title'   => '接口地址',
                        'content' => '<input type="text" readonly="readonly" value="' . home_url('/') . '">',
                        'style'   => 'info',
                        'type'    => 'content',
                    ),
                    array(
                        'title'      => '通讯密钥',
                        'default'    => substr(md5(time()), 0, 15),
                        'class'      => 'compact',
                        'id'         => 'key',
                        'type'       => 'text',
                        'attributes' => array(
                            'data-readonly-id' => 'agent_key',
                            'readonly'         => 'readonly',
                        ),
                        'desc'       => '<a href="javascript:;" class="but jb-yellow remove-readonly" readonly-id="agent_key">修改密钥</a>',
                    ),
                ),
            ),
            array(
                'dependency' => array('social|oauth_agent', '==|==', '|client'),
                'title'      => ' ',
                'subtitle'   => '代理登录配置',
                'id'         => 'oauth_agent_client_option',
                'type'       => 'fieldset',
                'class'      => 'compact',
                'fields'     => array(
                    array(
                        'content' => '将此网站设置为社交登录<code>代理客户端</code>，可直接接入其它设置为代理服务器的网站进行社交登录</br>请在设置为<code>代理登录服务端</code>的网站获取对应参数填入下方',
                        'style'   => 'info',
                        'type'    => 'submessage',
                    ),
                    array(
                        'title' => '接口地址',
                        'id'    => 'url',
                        'type'  => 'text',
                    ),
                    array(
                        'title' => '通讯密钥',
                        'class' => 'compact',
                        'id'    => 'key',
                        'type'  => 'text',
                    ),
                    array(
                        'id'          => 'oauth_s',
                        'title'       => '启用社交登录',
                        'default'     => '',
                        'desc'        => '<i class="fa fa-fw fa-info-circle fa-fw"></i>此处启用的方式，请确保服务端均已开启并正常使用<br/>如果此处启用的登录方式和下方相同登录方式同时开启，则此处优先',
                        'class'       => 'compact',
                        'placeholder' => '选择需要开启的社交登录方式',
                        'options'     => array(
                            'qq'        => 'QQ登录',
                            'weixin'    => '微信登录(开放平台模式)',
                            'weixingzh' => '微信登录(公众号模式)',
                            'weibo'     => '微博',
                            'github'    => 'GitHub',
                            'gitee'     => '码云',
                            'baidu'     => '百度',
                            'alipay'    => '支付宝',
                        ),
                        'type'        => 'select',
                        'chosen'      => true,
                        'multiple'    => true,
                    ),
                ),
            ),

            array(
                'dependency' => array('social', '==', '', '', 'visible'),
                'title'      => __('QQ登录', 'zib_language'),
                'id'         => 'oauth_qq_s',
                'default'    => false,
                'type'       => 'switcher',
            ),
            array(
                'dependency' => array('oauth_qq_s|social', '!=|==', '|'),
                'title'      => ' ',
                'subtitle'   => 'QQ登录配置',
                'id'         => 'oauth_qq_option',
                'type'       => 'fieldset',
                'class'      => 'compact',
                'fields'     => array(
                    array(
                        'content' => '<h4><b>回调地址：</b>' . esc_url(home_url('/oauth/qq/callback')) . '</h4>QQ登录申请地址：<a target="_blank" href="https://connect.qq.com/">https://connect.qq.com</a> | <a target="_blank" href="https://www.zibll.com/979.html">查看官方教程</a>',
                        'style'   => 'info',
                        'type'    => 'submessage',
                    ),
                    array(
                        'title' => 'AppID',
                        'id'    => 'appid',
                        'type'  => 'text',
                    ),
                    array(
                        'title' => 'AppKey',
                        'class' => 'compact',
                        'id'    => 'appkey',
                        'type'  => 'text',
                    ),
                ),
            ),
            array(
                'dependency' => array('social', '==', '', '', 'visible'),
                'title'      => __('微信登录(公众号模式)', 'zib_language'),
                'id'         => 'oauth_weixingzh_s',
                'default'    => false,
                'type'       => 'switcher',
            ),
            array(
                'dependency' => array('oauth_weixingzh_s|social', '!=|==', '|'),
                'title'      => ' ',
                'subtitle'   => '微信公众号登录配置',
                'sanitize'   => false,
                'id'         => 'oauth_weixingzh_option',
                'type'       => 'fieldset',
                'class'      => 'compact',
                'fields'     => array(
                    array(
                        'content' => '<h4><b>服务器接口URL：</b>' . esc_url(home_url('/oauth/weixingzh/callback')) . '</br><span class="c-yellow">请先检测此地址能否被访问，如果不能请先配置伪静态和固定链接！(直接访问不显示404就OK)</span></h4><h4><b>JS接口安全域名、网页授权域名：</b>' . preg_replace('/^(?:https?:\/\/)?([^\/]+).*$/im', '$1', home_url()) . '</h4>申请地址：<a target="_blank" href="https://mp.weixin.qq.com/">https://mp.weixin.qq.com/</a> | <a target="_blank" href="https://www.zibll.com/2206.html">查看官方教程</a></br><i class="fa fa-fw fa-info-circle fa-fw"></i> 微信公众号登录与微信登录请二选一开启，推荐优先使用此功能<br/>启用此功能后，可开启微信官方JSAPI支付功能',
                        'style'   => 'info',
                        'type'    => 'submessage',
                    ),
                    array(
                        'title' => '公众号AppID',
                        'id'    => 'appid',
                        'type'  => 'text',
                    ),
                    array(
                        'title' => '公众号AppSecret',
                        'class' => 'compact',
                        'id'    => 'appkey',
                        'type'  => 'text',
                    ),
                    array(
                        'title' => '接口验证token',
                        'desc'  => '此处token用于在微信平台校验服务器URL时使用，自行填写，和微信平台一致即可。 <a target="_blank" href="https://developers.weixin.qq.com/doc/offiaccount/Basic_Information/Access_Overview.html">查看说明</a>',
                        'id'    => 'token',
                        'type'  => 'text',
                    ),
                    array(
                        'title'      => '新关注消息',
                        'desc'       => '用户首次扫码关注后自动回复的消息',
                        'class'      => 'compact',
                        'default'    => '感谢您的关注
' . home_url(),
                        'id'         => 'subscribe_msg',
                        'attributes' => array(
                            'rows' => 2,
                        ),
                        'sanitize'   => false,
                        'type'       => 'textarea',
                    ),
                    array(
                        'title'      => '扫码登录消息',
                        'desc'       => '已经关注的用户扫码登录时候自动回复的消息',
                        'class'      => 'compact',
                        'default'    => '感谢您的关注
' . home_url(),
                        'id'         => 'scan_msg',
                        'attributes' => array(
                            'rows' => 2,
                        ),
                        'sanitize'   => false,
                        'type'       => 'textarea',
                    ),
                    array(
                        'id'         => 'auto_reply',
                        'type'       => 'accordion',
                        'accordions' => array(
                            array(
                                'title'  => '公众号自动回复配置',
                                'fields' => array(
                                    array(
                                        'title'        => ' ',
                                        'subtitle'     => '文本消息自动回复',
                                        'id'           => 'text',
                                        'sanitize'     => false,
                                        'type'         => 'group',
                                        'type'         => 'group',
                                        'type'         => 'group',
                                        'button_title' => '添加文本自动回复',
                                        'default'      => array(),
                                        'fields'       => array(
                                            array(
                                                'title'   => '关键词',
                                                'default' => '',
                                                'id'      => 'in',
                                                'type'    => 'text',
                                            ),
                                            array(
                                                'id'      => 'mode', //运算符号对比
                                                'class'   => 'compact',
                                                'title'   => '匹配方式',
                                                'default' => 'include',
                                                'inline'  => true,
                                                'type'    => "radio",
                                                'help'    => "包含：收到的消息中含有设置的关键词，等于：收到的消息与设置的关键词完全相同",
                                                'options' => array(
                                                    'include' => '包含关键词',
                                                    'same'    => '等于关键词',
                                                ),
                                            ),
                                            array(
                                                'title'      => '回复内容',
                                                'class'      => 'compact',
                                                'default'    => '',
                                                'id'         => 'out',
                                                'attributes' => array(
                                                    'rows' => 1,
                                                ),
                                                'sanitize'   => false,
                                                'type'       => 'textarea',
                                            ),

                                        ),
                                    ),
                                    array(
                                        'title'      => ' ',
                                        'subtitle'   => '图片消息自动回复',
                                        'class'      => 'compact',
                                        'default'    => '',
                                        'id'         => 'image',
                                        'attributes' => array(
                                            'rows' => 1,
                                        ),
                                        'sanitize'   => false,
                                        'type'       => 'textarea',
                                    ),
                                    array(
                                        'title'      => ' ',
                                        'subtitle'   => '语音消息自动回复',
                                        'class'      => 'compact',
                                        'default'    => '',
                                        'id'         => 'voice',
                                        'attributes' => array(
                                            'rows' => 1,
                                        ),
                                        'sanitize'   => false,
                                        'type'       => 'textarea',
                                    ),
                                    array(
                                        'title'      => ' ',
                                        'subtitle'   => '其他消息自动回复',
                                        'class'      => 'compact',
                                        'default'    => '',
                                        'id'         => 'default',
                                        'attributes' => array(
                                            'rows' => 1,
                                        ),
                                        'sanitize'   => false,
                                        'type'       => 'textarea',
                                    ),
                                ),
                            ),
                            array(
                                'title'  => '公众号自定义菜单配置',
                                'fields' => array(CFS_Module::gzh_menu()),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'dependency' => array('social|oauth_weixin_s|oauth_weixingzh_s', '==|!=|!=', '||'),
                'type'       => 'submessage',
                'style'      => 'danger',
                'content'    => '<div style="text-align:center"><b><i class="fa fa-fw fa-ban fa-fw"></i> 微信公众号登录和微信登录请勿同时开启，二选一即可，推荐优先使用公众号登录</b></div>',
            ),
            array(
                'dependency' => array('social', '==', '', '', 'visible'),
                'title'      => __('微信登录(开放平台模式)', 'zib_language'),
                'id'         => 'oauth_weixin_s',
                'default'    => false,
                'type'       => 'switcher',
            ),
            array(
                'dependency' => array('oauth_weixin_s|social', '!=|==', '|'),
                'title'      => ' ',
                'subtitle'   => '微信登录配置',
                'id'         => 'oauth_weixin_option',
                'type'       => 'fieldset',
                'class'      => 'compact',
                'fields'     => array(
                    array(
                        'content' => '<h4>授权回调域：<code>' . preg_replace('/^(?:https?:\/\/)?([^\/]+).*$/im', '$1', home_url()) . '</code></h4><h4>回调地址：' . esc_url(home_url('/oauth/weixin/callback')) . '</h4>微信登录申请地址：<a target="_blank" href="https://open.weixin.qq.com/">https://open.weixin.qq.com</a></br><i class="fa fa-fw fa-info-circle fa-fw"></i> 微信公众号登录与微信登录请二选一开启',
                        'style'   => 'info',
                        'type'    => 'submessage',
                    ),
                    array(
                        'title' => '开放平台或订阅号AppID',
                        'id'    => 'appid',
                        'type'  => 'text',
                    ),
                    array(
                        'title' => '开放平台或订阅号AppSecret',
                        'class' => 'compact',
                        'id'    => 'appkey',
                        'type'  => 'text',
                    ),
                ),
            ),
            array(
                'dependency' => array('social', '==', '', '', 'visible'),
                'title'      => __('微博登录', 'zib_language'),
                'id'         => 'oauth_weibo_s',
                'default'    => false,
                'type'       => 'switcher',
            ),
            array(
                'dependency' => array('oauth_weibo_s|social', '!=|==', '|'),
                'title'      => ' ',
                'subtitle'   => '微博登录配置',
                'id'         => 'oauth_weibo_option',
                'type'       => 'fieldset',
                'class'      => 'compact',
                'fields'     => array(
                    array(
                        'content' => '<h4><b>回调地址：</b>' . esc_url(home_url('/oauth/weibo/callback')) . '</h4>微博登录申请地址：<a target="_blank" href="https://open.weibo.com/authentication/">https://open.weibo.com/authentication</a>',
                        'style'   => 'info',
                        'type'    => 'submessage',
                    ),
                    array(
                        'title' => 'AppKey',
                        'id'    => 'appid',
                        'type'  => 'text',
                    ),
                    array(
                        'title' => 'AppSecret',
                        'class' => 'compact',
                        'id'    => 'appkey',
                        'type'  => 'text',
                    ),
                ),
            ),
            array(
                'dependency' => array('social', '==', '', '', 'visible'),
                'title'      => __('码云(gitee)登录', 'zib_language'),
                'id'         => 'oauth_gitee_s',
                'default'    => false,
                'type'       => 'switcher',
            ),
            array(
                'dependency' => array('oauth_gitee_s|social', '!=|==', '|'),
                'title'      => ' ',
                'subtitle'   => '码云(gitee)登录配置',
                'id'         => 'oauth_gitee_option',
                'type'       => 'fieldset',
                'class'      => 'compact',
                'fields'     => array(
                    array(
                        'content' => '<h4><b>回调地址：</b>' . esc_url(home_url('/oauth/gitee/callback')) . '</h4>码云(gitee)登录申请地址：<a target="_blank" href="https://gitee.com/oauth/applications/">https://gitee.com/oauth/applications</a>',
                        'style'   => 'info',
                        'type'    => 'submessage',
                    ),
                    array(
                        'title' => 'AppID',
                        'id'    => 'appid',
                        'type'  => 'text',
                    ),
                    array(
                        'title' => 'AppKey',
                        'class' => 'compact',
                        'id'    => 'appkey',
                        'type'  => 'text',
                    ),
                ),
            ),
            array(
                'dependency' => array('social', '==', '', '', 'visible'),
                'title'      => __('GitHub登录', 'zib_language'),
                'id'         => 'oauth_github_s',
                'default'    => false,
                'type'       => 'switcher',
            ),
            array(
                'dependency' => array('oauth_github_s|social', '!=|==', '|'),
                'title'      => ' ',
                'subtitle'   => 'GitHub登录配置',
                'id'         => 'oauth_github_option',
                'type'       => 'fieldset',
                'class'      => 'compact',
                'fields'     => array(
                    array(
                        'content' => '<h4><b>回调地址：</b>' . esc_url(home_url('/oauth/github/callback')) . '</h4>GitHub登录申请地址：<a target="_blank" href="https://github.com/settings/developers">https://github.com/settings/developers</a> | <a target="_blank" href="https://www.zibll.com/1001.html">查看官方教程</a>',
                        'style'   => 'info',
                        'type'    => 'submessage',
                    ),
                    array(
                        'title' => 'AppID',
                        'id'    => 'appid',
                        'type'  => 'text',
                    ),
                    array(
                        'title' => 'AppKey',
                        'class' => 'compact',
                        'id'    => 'appkey',
                        'type'  => 'text',
                    ),
                ),
            ),
            array(
                'dependency' => array('social', '==', '', '', 'visible'),
                'title'      => __('百度登录', 'zib_language'),
                'id'         => 'oauth_baidu_s',
                'default'    => false,
                'type'       => 'switcher',
            ),
            array(
                'dependency' => array('oauth_baidu_s|social', '!=|==', '|'),
                'title'      => ' ',
                'subtitle'   => '百度登录配置',
                'id'         => 'oauth_baidu_option',
                'type'       => 'fieldset',
                'class'      => 'compact',
                'fields'     => array(
                    array(
                        'content' => '<h4><b>回调地址：</b>' . esc_url(home_url('/oauth/baidu/callback')) . '</h4>百度登录申请地址：<a target="_blank" href="http://developer.baidu.com/">http://developer.baidu.com</a>',
                        'style'   => 'info',
                        'type'    => 'submessage',
                    ),
                    array(
                        'title' => 'API Key',
                        'id'    => 'appid',
                        'type'  => 'text',
                    ),
                    array(
                        'title' => 'Secret Key',
                        'class' => 'compact',
                        'id'    => 'appkey',
                        'type'  => 'text',
                    ),
                ),
            ),
            array(
                'dependency' => array('social', '==', '', '', 'visible'),
                'title'      => __('支付宝登录', 'zib_language'),
                'id'         => 'oauth_alipay_s',
                'default'    => false,
                'type'       => 'switcher',
            ),
            array(
                'dependency' => array('oauth_alipay_s|social', '!=|==', '|'),
                'title'      => ' ',
                'subtitle'   => '支付宝登录配置',
                'id'         => 'oauth_alipay_option',
                'type'       => 'fieldset',
                'class'      => 'compact',
                'fields'     => array(
                    array(
                        'content' => '<h4><b>回调地址：</b>' . esc_url(home_url('/oauth/alipay/callback')) . '</h4>支付宝登录申请地址：<a target="_blank" href="https://open.alipay.com/platform/developerIndex.html">https://open.alipay.com/platform/developerIndex.html</a></br>由于移动端支付宝登陆只能在支付宝内打开才有效，所以支付宝登陆不会在移动端显示',
                        'style'   => 'info',
                        'type'    => 'submessage',
                    ),
                    array(
                        'title'    => '支付宝应用ID',
                        'subtitle' => 'AppID',
                        'id'       => 'appid',
                        'type'     => 'text',
                    ),
                    array(
                        'title'      => '支付宝应用私钥',
                        'class'      => 'compact',
                        'subtitle'   => 'appPrivateKey',
                        'id'         => 'appkrivatekey',
                        'attributes' => array(
                            'rows' => 4,
                        ),
                        'sanitize'   => false,
                        'type'       => 'textarea',
                    ),
                ),
            ),
        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'user',
        'title'       => '禁封/举报',
        'icon'        => 'fa fa-fw fa-ban',
        'description' => '',
        'fields'      => array(
            array(
                'title'   => __('禁封功能', 'zib_language'),
                'label'   => '启用后可以设置用户禁封，即小黑屋和封号的功能',
                'id'      => 'user_ban_s',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'dependency' => array('user_ban_s', '!=', ''),
                'title'      => __('举报功能', 'zib_language'),
                'label'      => '前台显示举报按钮，用户可以举报其它不良信息',
                'desc'       => '<div style="color:#ff4021;"><i class="fa fa-fw fa-info-circle fa-fw"></i>启用后请在<a href="' . zib_get_admin_csf_url('功能&权限/基本权限') . '">权限管理</a>中设置该权限（管理员可以直接禁封用户，则不会显示此按钮）</div>',
                'id'         => 'user_report_s',
                'type'       => 'switcher',
                'default'    => true,
            ),
            array(
                'title'        => '预置原因',
                'subtitle'     => '举报/禁封的时候可选择的原因',
                'id'           => 'ban_preset_reason',
                'sanitize'     => false,
                'type'         => 'group',
                'button_title' => '添加原因',
                'default'      => array(
                    array(
                        't' => '发布色情、违法内容',
                    ),
                    array(
                        't' => '存在欺诈骗钱行为',
                    ),
                    array(
                        't' => '骚扰他人',
                    ),
                    array(
                        't' => '涉嫌侵权',
                    ),
                    array(
                        't' => '发布垃圾广告信息',
                    ),
                ),
                'fields'       => array(
                    array(
                        'default' => '',
                        'id'      => 't',
                        'type'    => 'text',
                    ),
                ),
            ),
            array(
                'title'      => __('申诉说明', 'zib_language'),
                'desc'       => '用户申诉时候显示的内容(支持HTML代码，请注意代码规范)',
                'id'         => 'ban_appeal_desc',
                'default'    => '<div>为了良好的交流环境，申诉请阅读以下事项</div>
<li>首次违规将拉入小黑屋7天</li>
<li>3次违规后将直接禁封帐号</li>
<li>违规情节严重将无法提交申诉</li>
<li>申诉提交后约2-3个工作日进行审核</li>
<li>如有其它疑问请于客服联系</li>',
                'sanitize'   => false,
                'type'       => 'textarea',
                'attributes' => array(
                    'rows' => 5,
                ),
            ),
            array(
                'title'        => '申诉所需资料',
                'subtitle'     => '用户提交申诉时候需要提供的资料',
                'help'         => '此处的信息收集，仅用于记录和申诉审核',
                'id'           => 'ban_appeal_keys',
                'class'        => 'compact',
                'sanitize'     => false,
                'type'         => 'group',
                'button_title' => '添加申诉资料',
                'default'      => array(
                    array(
                        't' => '真实姓名',
                    ),
                    array(
                        't' => '邮箱',
                    ),
                    array(
                        't' => '手机号',
                    ),
                ),
                'fields'       => array(
                    array(
                        'default' => '',
                        'class'   => 'mini-input',
                        'id'      => 't',
                        'type'    => 'text',
                    ),
                ),
            ),
            array(
                'dependency' => array('user_report_s', '!=', ''),
                'title'      => __('举报可上传图片', 'zib_language'),
                'label'      => '举报时允许上传图片进行举证',
                'help'       => '最多上传3张',
                'id'         => 'user_report_img_s',
                'type'       => 'switcher',
                'default'    => true,
            ),
            array(
                'dependency' => array('user_report_s', '!=', ''),
                'title'      => __('举报说明', 'zib_language'),
                'desc'       => '举报时候显示的内容(支持HTML代码，请注意代码规范)',
                'class'      => 'compact',
                'id'         => 'user_report_desc',
                'default'    => '<div>举报说明：</div>
<li>请确保举报的内容属实</li>
<li>我们将会在收到举报后2个工作日内进行处理</li>
<li>举报属实我们将根据社区管理条例对该用户进行封号处理</li>
<li>如有其它疑问请于客服联系</li>',
                'sanitize'   => false,
                'type'       => 'textarea',
                'attributes' => array(
                    'rows' => 5,
                ),
            ),
        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'user',
        'title'       => '身份认证',
        'icon'        => 'fa fa-fw fa-check-circle',
        'description' => '',
        'fields'      => array(
            array(
                'content' => '用户身份认证功能，默认前台可以直接显示申请认证的弹窗，如果您需要一个页面用于展示认证信息以及认证申请，您可以新建一个页面并选择“zibll-用户身份认证”页面模板即可</br><a target="_blank" href="https://www.zibll.com/2956.html">查看官方教程</a>',
                'style'   => 'warning',
                'type'    => 'submessage',
            ),
            array(
                'title'   => __('启用用户身份认证', 'zib_language'),
                'id'      => 'user_auth_s',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'dependency' => array('user_auth_s', '!=', ''),
                'title'      => '申请设置',
                'id'         => 'apply_option',
                'type'       => 'fieldset',
                'fields'     => array(
                    array(
                        'title'   => __('允许用户申请', 'zib_language'),
                        'id'      => 's',
                        'type'    => 'switcher',
                        'default' => true,
                    ),
                    array(
                        'dependency' => array('s', '==', ''),
                        'title'      => __('停用说明', 'zib_language'),
                        'desc'       => '',
                        'id'         => 'disable_desc',
                        'default'    => '由于系统正在维护，暂时无法申请身份认证<br/>
详情请联系管理员',
                        'sanitize'   => false,
                        'type'       => 'textarea',
                        'attributes' => array(
                            'rows' => 3,
                        ),
                    ),
                    array(
                        'title'   => '申请要求',
                        'desc'    => '用户等级达到几级可申请，为0则不限制(依赖用户等级功能)',
                        'id'      => 'limit_level',
                        'default' => 2,
                        'max'     => _pz('user_level_max', 10),
                        'min'     => 0,
                        'step'    => 1,
                        'unit'    => '级',
                        'type'    => 'spinner',
                    ),
                    array(
                        'dependency' => array('s', '!=', ''),
                        'title'      => __('申请介绍', 'zib_language'),
                        'desc'       => '用户申请认证的时候显示的介绍内容',
                        'id'         => 'desc',
                        'default'    => '<div class="ml10">
  <li>认证用户会在昵称后显示认证徽章，同时享受多种优先待遇</li>
  <li>申请认证请确保信息属实，提交申请后一般2-3个工作日处理完成</li>
  <li>处理完成后会有消息及邮件通知，请注意查看</li>
</div>',
                        'sanitize'   => false,
                        'type'       => 'textarea',
                        'attributes' => array(
                            'rows' => 3,
                        ),
                    ),
                ),
            ),

        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'user',
        'title'       => '用户等级',
        'icon'        => 'fa fa-fw fa-vimeo',
        'description' => '',
        'fields'      => array(
            array(
                'title'   => __('启用用户等级', 'zib_language'),
                'id'      => 'user_level_s',
                'type'    => 'switcher',
                'default' => true,
            ),
            array(
                'title'   => '最高等级',
                'desc'    => '<i class="fa fa-fw fa-info-circle fa-fw"></i>修改此项后请先刷新页面后，在做其它配置修改(不建议超过30级)',
                'id'      => 'user_level_max',
                'default' => 6,
                'max'     => 30,
                'min'     => 3,
                'step'    => 1,
                'unit'    => '级',
                'type'    => 'spinner',
            ),
            array(
                'type'  => 'tabbed',
                'id'    => 'user_level_opt',
                'title' => '等级参数配置',
                'tabs'  => CFS_Module::user_level_tab(),
            ),
            array(
                'title'      => '升级经验值',
                'id'         => 'user_integral_opt',
                'type'       => 'accordion',
                'accordions' => array(
                    array(
                        'title'  => '升级经验值得分配置',
                        'fields' => CFS_Module::user_integral(),
                    ),
                ),
            ),
        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'user',
        'title'       => '用户积分' . $new_badge['6.4'],
        'icon'        => 'fa fa-fw fa-rub',
        'description' => '',
        'fields'      => array(
            array(
                'content' => '<p><b>用户积分功能：</b></p>
                <li>开启后用户可以通过任务赚积分，积分可用于商品购买</li>
                <li>请一定要注意积分与现金之间的汇率设置，避免出现逻辑错误</li>
                <li>您可以在用户管理中，为某一个用户手动赠送积分</li>
                <li><a href="' . admin_url('users.php') . '">用户管理</a> | <a target="_blank" href="https://www.zibll.com/?s=积分">官方教程</a></li>',
                'style'   => 'warning',
                'type'    => 'submessage',
            ),
            array(
                'title'   => '积分功能',
                'label'   => __('启用用户积分功能', 'zib_language'),
                'id'      => 'points_s',
                'default' => true,
                'type'    => 'switcher',
            ),
            /** //待处理
            array(
            'title'    => '积分抵扣',
            'subtitle' => __('允许使用积分抵扣现金', 'zib_language'),
            'desc'     => __('关闭后则只有积分商品才能使用积分支付', 'zib_language'),
            'id'       => 'points_deduction_s',
            'default'  => false,
            'type'     => 'switcher',
            ),
             */
            array(
                'dependency' => array('points_deduction_s', '!=', ''),
                'id'         => 'points_deduction_rate',
                'title'      => ' ',
                'subtitle'   => '积分抵扣汇率',
                'desc'       => '多少积分可以抵扣1元现金',
                'default'    => 30,
                'type'       => 'number',
                'unit'       => '积分',
                'class'      => 'compact',
            ),
            array(
                'title'    => '购买积分',
                'subtitle' => __('允许购买积分', 'zib_language'),
                'id'       => 'points_pay_s',
                'default'  => false,
                'type'     => 'switcher',
            ),
            array(
                'class'                  => 'compact',
                'dependency'             => array('points_pay_s', '!=', ''),
                'title'                  => '积分商品选项',
                'subtitle'               => '',
                'desc'                   => '用户购买积分时候，可快速选择的购买分数，可实现折扣购买',
                'id'                     => 'pay_points_product',
                'type'                   => 'group',
                'accordion_title_prefix' => '积分 ',
                'sanitize'               => false,
                'button_title'           => '添加积分商品',
                'default'                => array(
                    array(
                        'points'    => 150,
                        'pay_price' => 5,
                        'tag'       => '',
                        'tag_class' => '',
                    ),
                    array(
                        'points'    => 300,
                        'pay_price' => 10,
                        'tag'       => '',
                        'tag_class' => '',
                    ),
                    array(
                        'points'    => 1500,
                        'pay_price' => 45,
                        'tag'       => '推荐',
                        'tag_class' => 'jb-cyan',
                    ),
                    array(
                        'points'    => 3000,
                        'pay_price' => 80,
                        'tag'       => '特惠',
                        'tag_class' => 'jb-pink',
                    ),
                ),
                'fields'                 => array(
                    array(
                        'id'      => 'points',
                        'title'   => '积分',
                        'default' => 600,
                        'type'    => 'number',
                        'unit'    => '积分',
                    ),
                    array(
                        'id'      => 'pay_price',
                        'title'   => '销售金额',
                        'desc'    => '（必填）设置不同的销售金额实现折扣的功能',
                        'default' => 20,
                        'type'    => 'number',
                        'unit'    => '元',
                        'class'   => 'compact',
                    ),
                    array(
                        'id'         => 'tag',
                        'title'      => '小标签',
                        'class'      => 'compact',
                        'desc'       => '支持HTML，请注意控制长度',
                        'attributes' => array(
                            'rows' => 1,
                        ),
                        'type'       => 'textarea',
                    ),
                    array(
                        'dependency' => array('tag', '!=', ''),
                        'title'      => '标签颜色',
                        'id'         => "tag_class",
                        'class'      => 'compact skin-color',
                        'default'    => "jb-yellow",
                        'type'       => "palette",
                        'options'    => CFS_Module::zib_palette(),
                    ),
                ),
            ),
            array(
                'class'      => 'compact',
                'dependency' => array('points_pay_s', '!=', ''),
                'title'      => '自定义积分购买',
                'subtitle'   => __('允许用户手动输入购买的积分数量', 'zib_language'),
                'id'         => 'pay_points_product_custom_s',
                'default'    => true,
                'type'       => 'switcher',
            ),
            array(
                'class'      => 'compact',
                'dependency' => array('pay_points_product_custom_s|points_pay_s', '!=|!=', '|'),
                'title'      => ' ',
                'subtitle'   => '自定义积分购买限制',
                'id'         => 'pay_points_product_custom_limit',
                'type'       => 'between_number',
                'desc'       => '',
                'unit'       => '积分',
                'default'    => array(
                    'min' => 300,
                    'max' => 50000,
                ),
            ),
            array(
                'dependency' => array('pay_points_product_custom_s|points_pay_s', '!=|!=', '|'),
                'id'         => 'pay_points_rate',
                'class'      => 'compact',
                'title'      => ' ',
                'subtitle'   => '积分购买汇率',
                'desc'       => '1元现金可购买多少积分',
                'default'    => 30,
                'type'       => 'number',
                'unit'       => '积分',
                'class'      => 'compact',
            ),
            array(
                'dependency' => array('points_pay_s', '!=', ''),
                'id'         => 'pay_points_desc',
                'title'      => '积分购买说明',
                'subtitle'   => '',
                'class'      => '',
                'default'    => '<div>购买积分可用于本站部分内容消费</div>
<div>购买后无法退款</div>
<div>如有疑问，请与客服联系</div>',
                'desc'       => '用户购买积分时显示的内容，建议为提醒事项、购买协议等，支持HTML代码，清楚代码规范',
                'attributes' => array(
                    'rows' => 4,
                ),
                'sanitize'   => false,
                'type'       => 'textarea',
            ),
            array(
                'title'      => '积分任务',
                'subtitle'   => '免费获取积分的任务配置',
                'id'         => 'points_free_opt',
                'type'       => 'accordion',
                'accordions' => array(
                    array(
                        'title'  => '免费获取积分的任务配置',
                        'fields' => CFS_Module::points_free(),
                    ),
                ),
            ),
        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'user',
        'title'       => '签到奖励' . $new_badge['6.4'],
        'icon'        => 'fa fa-fw fa-calendar-check-o',
        'description' => '',
        'fields'      => array(
            array(
                'content' => '<p><b>用户签到功能：</b></p>
                <li>开启后用户可以通过签到获取积分以及升级的经验值</li>
                <li>此功能依赖于用户积分功能或用户等级功能</li>
                <li><a href="' . zib_get_admin_csf_url('用户互动/用户等级') . '">等级功能配置</a> | <a href="' . zib_get_admin_csf_url('用户互动/用户积分') . '">积分功能配置</a> | <a target="_blank" href="https://www.zibll.com/?s=签到">官方教程</a></li>',
                'style'   => 'warning',
                'type'    => 'submessage',
            ),
            array(
                'title'   => '签到功能',
                'label'   => __('启用用户签到奖励功能', 'zib_language'),
                'id'      => 'checkin_s',
                'default' => true,
                'type'    => 'switcher',
            ),
            array(
                'title'   => ' ',
                'label'   => __('在菜单栏用户卡片中显示签到按钮', 'zib_language'),
                'id'      => 'checkin_header_user_show',
                'default' => true,
                'type'    => 'switcher',
            ),
            array(
                'dependency' => array('checkin_header_user_show', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '按钮样式',
                'sanitize'   => false,
                'id'         => 'checkin_header_user_option',
                'type'       => 'fieldset',
                'class'      => 'compact',
                'fields'     => array(
                    array(
                        'title'   => '按钮文字',
                        'default' => "签到领取今日奖励",
                        'id'      => 'text',
                        'type'    => 'text',
                    ),
                    array(
                        'title'   => '按钮颜色',
                        'id'      => "class",
                        'class'   => 'compact skin-color',
                        'default' => "c-yellow",
                        'type'    => "palette",
                        'options' => CFS_Module::zib_palette(),
                    ),
                ),
            ),
            array(
                'id'       => 'checkin_reward_points',
                'title'    => '单次签到奖励',
                'subtitle' => '奖励积分',
                'default'  => 30,
                'type'     => 'number',
                'unit'     => '积分',
            ),
            array(
                'id'       => 'checkin_reward_integral',
                'class'    => 'compact',
                'title'    => ' ',
                'subtitle' => '奖励经验值',
                'default'  => 40,
                'type'     => 'number',
                'unit'     => '经验值',
            ),
            array(
                'type'  => 'tabbed',
                'id'    => 'continuous_checkin_reward',
                'title' => '连续签到奖励',
                'tabs'  => CFS_Module::checkin_reward(),
            ),

        ),
    ));

    //用户功能
    CSF::createSection($prefix, array(
        'parent'      => 'user',
        'title'       => '用户功能',
        'icon'        => 'fa fa-fw fa-user-o',
        'description' => '',
        'fields'      => array(
            array(
                'id'      => 'user_center_rewrite_slug',
                'title'   => '用户中心URL别名',
                'class'   => 'mini-input',
                'default' => '',
                'desc'    => '开启固定链接之后，可以在此自定义用户中心的链接后缀URL别名，默认为<code>user</code>
                <div style="color:#ff4021;"><i class="fa fa-fw fa-info-circle fa-fw"></i>如非必要，建议留空保持默认</div>',
                'type'    => 'text',
            ),
            array(
                'id'      => 'user_join_day_my_name',
                'title'   => '网站简称',
                'class'   => 'mini-input',
                'default' => '本站',
                'desc'    => '用于显示：已加入{%s}365天，例如：此处填写<code>子比网</code>，则显示为：已加入子比网365天',
                'type'    => 'text',
            ),
            array(
                'title'   => __('用户默认头像', 'zib_language'),
                'id'      => 'avatar_default_img',
                'desc'    => __('用户默认头像，建议尺寸100px*100px'),
                'default' => $imagepath . 'avatar-default.png',
                'library' => 'image', 'type' => 'upload',
            ),
            array(
                'title'   => __('用户默认封面', 'zib_language'),
                'id'      => 'user_cover_img',
                'desc'    => __('默认封面图，建议尺寸1000x400,如果分类页未开启侧边栏，请选择更大的尺寸'),
                'help'    => '用户可在用户中心设置自己的封面图，如用户未单独设置则显示此图像',
                'default' => $imagepath . 'user_t.jpg',
                'library' => 'image',
                'type'    => 'upload',
            ),

            array(
                'title'   => __('用户默认签名', 'zib_language'),
                'help'    => __('用户未设置签名时候，显示的签名', 'zib_language'),
                'default' => '这家伙很懒，什么都没有写...',
                'id'      => 'user_desc_std',
                'type'    => 'text',
            ),

            array(
                'title'   => __('用一言代替用户签名', 'zib_language'),
                'class'   => 'compact',
                'id'      => 'yiyan_avatar_desc',
                'type'    => 'switcher',
                'default' => false,
            ),

            array(
                'id'      => 'post_rewards_s',
                'title'   => '用户打赏功能',
                'default' => true,
                'type'    => 'switcher',
            ),

            array(
                'dependency' => array('post_rewards_s', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '自定义打赏按钮文字',
                'class'      => 'compact',
                'id'         => 'post_rewards_text',
                'default'    => '赞赏',
                'type'       => 'text',
            ),

        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'user',
        'title'       => '短信接口',
        'icon'        => 'fa fa-fw fa-comments-o',
        'description' => '',
        'fields'      => array(
            array(
                'content' => '<p><b>如需网站使用手机账户等相关功能，请在下方设置短信接口</b></p>
                <li>阿里云短信和腾讯云短信都是国内品质较高的短信平台，可靠信高，申请简单，但需要网站备案！其它接口无需备案</li>
                <li>短信能正常发送后，请记得开启手机绑定、手机号登录、手机验证等功能</li>
                <li>如需定制其它短信接口，欢迎<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=770349780&amp;site=qq&amp;menu=yes" title="QQ联系">与我QQ联系</a></li>
                <li><a target="_blank" href="https://www.zibll.com/?s=短信" class="loginbtn">官方教程</a> | <a href="' . zib_get_admin_csf_url('用户互动/注册登录') . '">登录/注册功能设置</a></li>',
                'style'   => 'warning',
                'type'    => 'submessage',
            ),
            array(
                'id'      => 'sms_sdk',
                'default' => 'null',
                'title'   => '设置短信接口',
                'type'    => "select",
                'options' => array(
                    'ali'     => __('阿里云短信', 'zib_language'),
                    'tencent' => __('腾讯云短信', 'zib_language'),
                    'smsbao'  => __('短信宝', 'zib_language'),
                    'fcykj'   => __('风吹雨短信', 'zib_language'),
                ),
            ),
            array(
                'id'         => 'sms_ali_option',
                'type'       => 'accordion',
                'title'      => '阿里云',
                'accordions' => array(
                    array(
                        'title'  => '阿里云短信配置',
                        'fields' => array(
                            array(
                                'title'   => 'AccessKey Id',
                                'id'      => 'keyid',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => 'AccessKey Secret',
                                'class'   => 'compact',
                                'id'      => 'keysecret',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => '签名',
                                'class'   => 'compact',
                                'id'      => 'sign_name',
                                'desc'    => '阿里云短信已审核的的短信签名，示例：子比主题',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'class'   => 'compact',
                                'title'   => '模板CODE',
                                'id'      => 'template_code',
                                'desc'    => '阿里云短信已审核的的短信模板代码，示例：SMS_207952000<br>
                                <a target="_blank" href="https://www.zibll.com/1483.html">阿里云短信接入教程</a>
                                <a target="_blank" href="https://www.aliyun.com/product/sms?userCode=qyth9w2q">申请地址</a>',
                                'default' => '',
                                'type'    => 'text',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'         => 'sms_tencent_option',
                'type'       => 'accordion',
                'title'      => '腾讯云',
                'accordions' => array(
                    array(
                        'title'  => '腾讯云短信配置',
                        'fields' => array(
                            array(
                                'title'   => 'SDK AppID',
                                'id'      => 'app_id',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => 'App Key',
                                'class'   => 'compact',
                                'id'      => 'app_key',
                                'desc'    => '腾讯云短信应用的SDK AppID和AppKey',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            /**
                            array(
                            'title' => 'Access Id',
                            'class' => 'compact',
                            'id' => 'secret_id',
                            'default' => '',
                            'type' => 'text'
                            ),
                            array(
                            'title' => 'Access Key',
                            'class' => 'compact',
                            'id' => 'secret_key',
                            'default' => '',
                            'type' => 'text'
                            ), */
                            array(
                                'title'   => '签名',
                                'class'   => 'compact',
                                'id'      => 'sign_name',
                                'desc'    => '已审核的的短信签名，示例：子比主题',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'class'   => 'compact',
                                'title'   => '模板ID',
                                'id'      => 'template_id',
                                'desc'    => '已审核的的短信模板ID，示例：825011<br>
                                <a target="_blank" href="https://www.zibll.com/?s=腾讯云短信">腾讯云短信接入教程</a>
                                <a target="_blank" href="https://cloud.tencent.com/product/sms">申请地址</a>',
                                'default' => '',
                                'type'    => 'text',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'         => 'sms_smsbao_option',
                'type'       => 'accordion',
                'title'      => '短信宝',
                'accordions' => array(
                    array(
                        'title'  => '短信宝配置',
                        'fields' => array(
                            array(
                                'title'   => '用户名',
                                'id'      => 'userame',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => '密码',
                                'class'   => 'compact',
                                'id'      => 'password',
                                'desc'    => '',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => 'ApiKey',
                                'class'   => 'compact',
                                'id'      => 'api_key',
                                'desc'    => '短信宝ApiKey（可选）<br/>ApiKey是短信宝新推出的接口方式，更高效安全，ApiKey和密码二选一即可',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'class'   => 'compact',
                                'title'   => '模板内容',
                                'id'      => 'template',
                                'desc'    => '已通过审核的验证码模板内容，必须要有<code style="color: #ee3f17;padding:0px 3px">{code}</code>变量<br>示例：<code>【子比主题】您的验证码为{code}，在{time}分钟内有效。</code><br>
                                <a target="_blank" href="https://www.zibll.com/?s=短信">接入教程</a> | <a target="_blank" href="http://www.smsbao.com/">短信宝官网</a>',
                                'default' => '',
                                'type'    => 'text',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'         => 'sms_fcykj_option',
                'type'       => 'accordion',
                'title'      => '风吹雨短信',
                'accordions' => array(
                    array(
                        'title'  => '风吹雨短信配置',
                        'fields' => array(
                            array(
                                'title'   => 'Appid',
                                'id'      => 'appid',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => 'Auth Token',
                                'class'   => 'compact',
                                'id'      => 'auth_token',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'class'   => 'compact',
                                'title'   => '模板ID',
                                'id'      => 'template_id',
                                'desc'    => '已通过审核的验证码模板ID，示例：<code>101</code><br>
                                <a target="_blank" href="https://www.zibll.com/?s=短信">接入教程</a> | <a target="_blank" href="https://sms.fcykj.net/">风吹雨官网</a>',
                                'default' => '',
                                'type'    => 'text',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'content' => '<p><b>短信发送测试：</b>
                <br/>输入接收短信的手机号码，在此发送验证码为888888的测试短信</p>
                <ajaxform class="ajax-form" ajax-url="' . admin_url('admin-ajax.php') . '">
                <p><input type="text" style="max-width:300px;" ajax-name="phone_number" placeholder="13800008888"></p>
                <div class="ajax-notice"></div>
                <p><a href="javascript:;" class="but jb-yellow ajax-submit"><i class="fa fa-paper-plane-o"></i> 发送测试短信</a></p>
                <input type="hidden" ajax-name="action" value="test_send_sms">
                </ajaxform>',
                'style'   => 'warning',
                'type'    => 'submessage',
            ),
        ),
    ));
    CSF::createSection($prefix, array(
        'parent'      => 'pay',
        'title'       => '商城配置',
        'icon'        => 'fa fa-fw fa-shopping-bag',
        'description' => '',
        'fields'      => array(
            array(
                'content' => '<p><b>虚拟商城系统</b></p>
                <li>付费功能主要分为文章付费、付费会员、余额系统、推广返佣、创作分成等功能组成，您可以根据您的需要开启对应功能</li>
                <li>使用支付功能请先配置好<a href="' . zib_get_admin_csf_url('商城&付费/收款接口') . '">收款接口</a></li>
                <li><a target="_blank" href="https://www.zibll.com/zibll_word/%e5%95%86%e5%9f%8e%e5%8a%9f%e8%83%bd">查看官方教程</a></li>',
                'style'   => 'warning',
                'type'    => 'submessage',
            ),
            array(
                'title'   => '免登陆购买',
                'id'      => 'pay_no_logged_in',
                'default' => true,
                'help'    => '开启后如果用户未登录则使用浏览器缓存验证是否购买',
                'type'    => 'switcher',
            ),
            array(
                'dependency' => array('pay_no_logged_in', '!=', ''),
                'class'      => 'compact',
                'title'      => ' ',
                'subtitle'   => __('Cookie时间', 'zib_language'),
                'id'         => 'pay_cookie_day',
                'desc'       => '免登陆购买的浏览器缓存有效时间',
                'default'    => 15,
                'max'        => 31,
                'min'        => 1,
                'step'       => 1,
                'unit'       => '天',
                'type'       => 'spinner',
            ),
            array(
                'dependency' => array('pay_no_logged_in', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '未登录提醒',
                'class'      => 'compact',
                'id'         => 'pay_no_logged_remind',
                'default'    => '您当前未登录！建议登陆后购买，可保存购买订单',
                'attributes' => array(
                    'rows' => 2,
                ),
                'sanitize'   => false,
                'type'       => 'textarea',
            ),

            array(
                'title'    => '购买按钮',
                'subtitle' => __('直接显示支付宝、微信购买按钮', 'zib_language'),
                'id'       => 'pay_show_allbut',
                'desc'     => __('开启余额功能或积分支付功能后，此功能将失效', 'zib_language'),
                'default'  => false,
                'type'     => 'switcher',
            ),
            array(
                'dependency' => array('pay_show_allbut', '==', ''),
                'title'      => '快捷支付方式',
                'class'      => 'compact',
                'id'         => 'default_payment',
                'default'    => 'wechat',
                'type'       => "radio",
                'help'       => '点击购买之后优先弹出的付款方式，用户可点击切换付款方式',
                'desc'       => __('开启余额功能或积分支付功能后，此功能将失效', 'zib_language'),
                'inline'     => true,
                'options'    => array(
                    'wechat' => __('微信', 'zib_language'),
                    'alipay' => __('支付宝', 'zib_language'),
                ),
            ),

            array(
                'title'   => '模块显示位置',
                'id'      => 'pay_box_position',
                'default' => 'top',
                'type'    => "radio",
                'desc'    => "在文章页面中购买模块的显示位置</br>如需在侧边栏显示购买模块，可在小工具模块中为侧边栏添加“付费购买”模块",
                'options' => array(
                    'box_top'    => __('文章模块上方', 'zib_language'),
                    'top'        => __('文章内容顶部', 'zib_language'),
                    'bottom'     => __('文章内容底部', 'zib_language'),
                    'box_bottom' => __('文章模块下方', 'zib_language'),
                ),
            ),
            array(
                'title'   => __('货币符号', 'zib_language'),
                'desc'    => '（例如 R币）',
                'id'      => 'pay_mark',
                'class'   => 'mini-input',
                'default' => '￥',
                'type'    => 'text',
            ),
            array(
                'title'    => __('免费资源', 'zib_language'),
                'subtitle' => __('免费资源必须登录后才能查看', 'zib_language'),
                'id'       => 'pay_free_logged_show',
                'class'    => 'compact',
                'default'  => true,
                'type'     => 'switcher',
            ),
            array(
                'title'    => '订单数据',
                'subtitle' => __('在用户中心显示订单数据', 'zib_language'),
                'class'    => 'compact',
                'id'       => 'pay_show_user',
                'default'  => true,
                'type'     => 'switcher',
            ),
            array(
                'title'    => '销量显示',
                'subtitle' => __('商品详情显示销售数量', 'zib_language'),
                'id'       => 'pay_show_paycount',
                'class'    => 'compact',
                'default'  => true,
                'type'     => 'switcher',
            ),
            array(
                'title'    => __('提现设置', 'zib_language'),
                'subtitle' => __('提现最低金额限制', 'zib_language'),
                'id'       => 'pay_rebate_withdraw_lowest_money',
                'desc'     => __('当用户可提现总金额(推广佣金、余额、创作分成)高于多少时候，才能发起提现(不能为0，不能为小数)', 'zib_language'),
                'default'  => '50',
                'type'     => 'number',
                'unit'     => '元',
            ),
            array(
                'title'    => __(' ', 'zib_language'),
                'class'    => 'compact',
                'subtitle' => __('提现手续费', 'zib_language') . $new_badge['6.3'],
                'id'       => 'withdraw_service_charge',
                'desc'     => __('', 'zib_language'),
                'default'  => 0,
                'type'     => 'number',
                'unit'     => '%',
            ),
            array(
                'title'      => ' ',
                'subtitle'   => __('提现协议', 'zib_language'),
                'class'      => 'compact',
                'id'         => 'pay_rebate_withdraw_text_details',
                'default'    => '<div>可提现金额达到50元后即可发起提现</div>
<div>申请提现需后台人工处理，一般2-3小时，请耐心等待</div>
<div>如有其它疑问，请与客服联系</div>',
                'desc'       => '用户申请提现时展示的内容，建议为提现须知等（使用HTML代码请注意代码准确性）',
                'sanitize'   => false,
                'type'       => 'textarea',
                'attributes' => array(
                    'rows' => 4,
                ),
            ),

            array(
                'title'        => '客户服务',
                'subtitle'     => '用户服务内容',
                'id'           => 'pay_service',
                'type'         => 'group',
                'button_title' => '添加属性',
                'default'      => array(),
                'fields'       => array(
                    array(
                        'title'   => '服务内容',
                        'default' => '',
                        'id'      => 'value',
                        'type'    => 'text',
                    ),
                    array(
                        'id'           => 'icon',
                        'type'         => 'icon',
                        'title'        => '自定义图标',
                        'class'        => 'compact',
                        'button_title' => '选择图标',
                        'default'      => 'fa fa-check-circle-o',
                    ),
                ),
            ),
            array(
                'type'  => 'tabbed',
                'id'    => 'pay_type_option',
                'title' => '商品设置',
                'tabs'  => array(
                    /**
                    array(
                    'title'     => '付费阅读',
                    'icon'      => 'fa fa-diamond',
                    'fields'    => array(),
                    ),
                     */
                    array(
                        'title'  => '付费下载',
                        'icon'   => 'fa fa-download',
                        'fields' => array(
                            array(
                                'title'   => '独立下载页面',
                                'id'      => 'down_alone_page',
                                'class'   => '',
                                'default' => false,
                                'desc'    => '开启后，付费资源的下载链接会跳转独立页面显示',
                                'type'    => 'switcher',
                            ),
                        ),
                    ),
                    /**
                    array(
                    'title'     => '付费视频',
                    'icon'      => 'fa fa-diamond',
                    'fields'    => array(
                    array(
                    'id' => 'video_scale_height',
                    'title' => '固定长宽比例',
                    'default' => 0,
                    'max' => 200,
                    'min' => 0,
                    'step' => 5,
                    'unit' => '%',
                    'type' => 'spinner',
                    'desc' => '为0则不固定长宽比例'
                    ),
                    ),
                    ),

                    array(
                    'title'     => '付费图片',
                    'icon'      => 'fa fa-diamond',
                    'fields'    => array(
                    ///待处理
                    ),
                    ),
                     */
                ),
            ),

            array(
                'title'   => __('商品预置参数配置', 'zib_language'),
                'content' => '在下方配置的参数新建文章时候会自动填入，方便新建文章的设置。最终以文章配置为准',
                'type'    => "content",
            ),
            array(
                'title'   => '支付类型',
                'id'      => 'pay_modo_default',
                'type'    => 'radio',
                'default' => '0',
                'options' => array(
                    '0'      => __('普通商品（金钱购买）', 'zib_language'),
                    'points' => __('积分商品（积分购买，依赖于用户积分功能）', 'zib_language'),
                ),
            ),
            array(
                'id'      => 'points_price_default',
                'title'   => '积分售价',
                'class'   => 'compact',
                'default' => '',
                'type'    => 'number',
                'unit'    => '积分',
            ),
            array(
                'title'   => _pz('pay_user_vip_1_name') . '积分售价',
                'id'      => 'vip_1_points_default',
                'class'   => 'compact',
                'default' => '',
                'type'    => 'number',
                'unit'    => '积分',
            ),
            array(
                'title'   => _pz('pay_user_vip_2_name') . '积分售价',
                'id'      => 'vip_2_points_default',
                'class'   => 'compact',
                'default' => '',
                'type'    => 'number',
                'unit'    => '积分',
            ),
            array(
                'id'      => 'pay_price_default',
                'title'   => '执行价',
                'default' => '0.01',
                'type'    => 'number',
                'unit'    => '元',
                'class'   => 'compact',
            ),
            array(
                'id'       => 'pay_original_price_default',
                'title'    => '原价',
                'subtitle' => '显示在执行价格前面，并划掉',
                'default'  => '',
                'type'     => 'number',
                'unit'     => '元',
                'class'    => 'compact',
            ),
            array(
                'title'      => '促销标签',
                'class'      => 'compact',
                'id'         => 'pay_promotion_tag_default',
                'type'       => 'textarea',
                'default'    => '<i class="fa fa-fw fa-bolt"></i> 限时特惠',
                'attributes' => array(
                    'rows' => 1,
                ),
            ),
            array(
                'title'    => _pz('pay_user_vip_1_name') . '价格',
                'id'       => 'vip_1_price_default',
                'subtitle' => '填0则为' . _pz('pay_user_vip_1_name') . '免费',
                'default'  => '0',
                'type'     => 'number',
                'unit'     => '元',
                'class'    => 'compact',
            ),
            array(
                'title'    => _pz('pay_user_vip_2_name') . '价格',
                'id'       => 'vip_2_price_default',
                'subtitle' => '填0则为' . _pz('pay_user_vip_1_name') . '免费',
                'default'  => '0',
                'type'     => 'number',
                'unit'     => '元',
                'class'    => 'compact',
            ),
            array(
                'dependency' => array('pay_rebate_s', '!=', '', 'all'),
                'title'      => '推广折扣',
                'id'         => 'pay_rebate_discount',
                'class'      => 'compact',
                'subtitle'   => __('通过推广链接购买，额外优惠的金额', 'zib_language'),
                'desc'       => __('1.需开启推广返佣功能  2.注意此金不能超过实际购买价，避免出现负数', 'zib_language'),
                'default'    => '0',
                'type'       => 'number',
                'unit'       => '元',
            ),
            array(
                'title'   => '销量浮动',
                'id'      => 'pay_cuont_default',
                'class'   => 'compact',
                'default' => array(
                    'min' => 0,
                    'max' => 0,
                ),
                'type'    => 'between_number',
                'desc'    => '为真实销量增加或减少的数量，系统会根据此处设置的区间获取随机值作为预置参数',
            ),
            array(
                'title'      => '更多详情',
                'class'      => 'compact',
                'id'         => 'pay_details_default',
                'desc'       => __(' （可插入任意的HTML代码）', 'zib_language'),
                'default'    => '',
                'sanitize'   => false,
                'type'       => 'textarea',
                'attributes' => array(
                    'rows' => 3,
                ),
            ),
            array(
                'title'      => '额外隐藏内容',
                'class'      => 'compact',
                'id'         => 'pay_extra_hide_default',
                'desc'       => __(' （可插入任意的HTML代码）', 'zib_language'),
                'default'    => '',
                'sanitize'   => false,
                'type'       => 'textarea',
                'attributes' => array(
                    'rows' => 3,
                ),
            ),
            array(
                'title'        => '付费下载',
                'subtitle'     => '资源属性',
                'class'        => 'compact',
                'id'           => 'pay_attributes_default',
                'type'         => 'group',
                'button_title' => '添加属性',
                'default'      => array(),
                'fields'       => array(
                    array(
                        'title'   => '属性名称',
                        'default' => '',
                        'id'      => 'key',
                        'type'    => 'text',
                    ),
                    array(
                        'title'   => '属性内容',
                        'class'   => 'compact',
                        'default' => '',
                        'id'      => 'value',
                        'type'    => 'text',
                    ),
                ),
            ),
            array(
                'title'    => '付费阅图片',
                'subtitle' => '免费查看数量',
                'class'    => 'compact',
                'id'       => 'pay_gallery_show_default',
                'default'  => 1,
                'min'      => 0,
                'step'     => 1,
                'unit'     => '张',
                'desc'     => '设置付费图片可免费查看前几张图片的数量的默认值',
                'type'     => 'spinner',
            ),
        ),

    ));

    CSF::createSection($prefix, array(
        'parent'      => 'pay',
        'title'       => '余额充值' . $new_badge['6.3'],
        'icon'        => 'fa fa-fw fa-jpy',
        'description' => '',
        'fields'      => array(
            array(
                'content' => '<p><b>用户余额功能：</b></p>
                <li>开启后用户可充值到余额，余额可用于全站消费</li>
                <li>在下方设置默认的分成比例，同时支持单独为每一个用户设置独立的分成比例</li>
                <li>同时您可以在用户管理中，为某一个用户手动赠送余额</li>
                <li><a href="' . admin_url('users.php') . '">用户管理</a> | <a target="_blank" href="https://www.zibll.com/?s=余额充值">官方教程</a></li>',
                'style'   => 'warning',
                'type'    => 'submessage',
            ),
            array(
                'title'   => '用户余额',
                'label'   => __('启用余额充值/支付功能', 'zib_language'),
                'id'      => 'pay_balance_s',
                'default' => true,
                'type'    => 'switcher',
            ),
            array(
                'title'   => '余额提现',
                'label'   => __('允许将余额提现', 'zib_language'),
                'id'      => 'pay_balance_withdraw_s',
                'default' => false,
                'type'    => 'switcher',
            ),
            /**
             * //待处理
            array(
            'dependency' => array('pay_balance_withdraw_s', '!=', ''),
            'class'      => 'compact',
            'title'      => '收入自动转余额',
            'label'      => '用户创作分成、推广佣金自动转入余额',
            'id'         => 'pay_auto_to_balance',
            'default'    => false,
            'type'       => 'switcher',
            ),
             */
            array(
                'id'         => 'pay_balance_desc',
                'title'      => '充值说明',
                'subtitle'   => '',
                'class'      => '',
                'default'    => '<div>充值金额可用于本站消费</div>
<div>充值后无法退款</div>
<div>如有疑问，请与客服联系</div>',
                'desc'       => '用户充值时显示的内容，建议为提醒事项、充值协议等，支持HTML代码，清楚代码规范',
                'attributes' => array(
                    'rows' => 4,
                ),
                'sanitize'   => false,
                'type'       => 'textarea',
            ),
            array(
                'dependency'             => array('pay_balance_s', '!=', ''),
                'title'                  => '充值商品选项',
                'subtitle'               => '',
                'desc'                   => '用户充值时候，可快速选择的充值金额，同时支持设置折扣',
                'id'                     => 'pay_balance_product',
                'type'                   => 'group',
                'accordion_title_prefix' => '充值 ￥',
                'sanitize'               => false,
                'button_title'           => '添加充值金额选项',
                'default'                => array(
                    array(
                        'price'     => 50,
                        'pay_price' => 0,
                        'tag'       => '',
                        'tag_class' => '',
                    ),
                    array(
                        'price'     => 100,
                        'pay_price' => 98,
                        'tag'       => '',
                        'tag_class' => '',
                    ),
                    array(
                        'price'     => 200,
                        'pay_price' => 188,
                        'tag'       => '推荐',
                        'tag_class' => 'jb-cyan',
                    ),
                    array(
                        'price'     => 500,
                        'pay_price' => 468,
                        'tag'       => '特惠',
                        'tag_class' => 'jb-pink',
                    ),
                ),
                'fields'                 => array(
                    array(
                        'id'      => 'price',
                        'title'   => '充值金额',
                        'default' => 100,
                        'type'    => 'number',
                        'unit'    => '元',
                    ),
                    array(
                        'id'      => 'pay_price',
                        'title'   => '销售金额',
                        'desc'    => '（选填）设置不同的销售金额实现充值折扣的功能，设置为0则与充值金额一致',
                        'default' => 0,
                        'type'    => 'number',
                        'unit'    => '元',
                        'class'   => 'compact',
                    ),
                    array(
                        'id'         => 'tag',
                        'title'      => '小标签',
                        'class'      => 'compact',
                        'desc'       => '支持HTML，请注意控制长度',
                        'attributes' => array(
                            'rows' => 1,
                        ),
                        'type'       => 'textarea',
                    ),
                    array(
                        'dependency' => array('tag', '!=', ''),
                        'title'      => '标签颜色',
                        'id'         => "tag_class",
                        'class'      => 'compact skin-color',
                        'default'    => "jb-yellow",
                        'type'       => "palette",
                        'options'    => CFS_Module::zib_palette(),
                    ),
                ),
            ),
            array(
                'title'    => '自定义充值金额',
                'subtitle' => __('允许用户手动输入充值金额', 'zib_language'),
                'id'       => 'pay_balance_product_custom_s',
                'default'  => true,
                'type'     => 'switcher',
            ),
            array(
                'class'      => 'compact',
                'dependency' => array('pay_balance_product_custom_s', '!=', ''),
                'title'      => '自定义充值金额限制',
                'id'         => 'pay_balance_product_custom_limit',
                'type'       => 'between_number',
                'desc'       => '',
                'unit'       => '元',
                'default'    => array(
                    'min' => 10,
                    'max' => 500,
                ),
            ),
        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'pay',
        'title'       => 'VIP 会员',
        'icon'        => 'fa fa-fw fa-diamond',
        'description' => '',
        'fields'      => array(
            array(
                'content' => '<li>开启付费会员功能之前，请先配置好收款接口，确保网站收款正常</li><li>会员功能的设置项目较多，请仔细核对，避免出现价格、时间的问题</li><li>配合设置名称、有效期等可搭配出不同类型的会员</li><li>管理员可在后台为用户单独开启会员</li><li><a href="' . admin_url('users.php') . '">会员管理</a> | <a target="_blank" href="https://www.zibll.com/767.html">官方教程</a></li>',
                'style'   => 'warning',
                'type'    => 'submessage',
            ),
            array(
                'title'    => __('导航栏购买按钮', 'zib_language'),
                'subtitle' => '在顶部导航栏显示开通会员按钮',
                'id'       => 'nav_pay_vip',
                'default'  => true,
                'help'     => '请注意顶部导航的整体宽度和内容，请勿超宽',
                'type'     => 'switcher',
            ),
            array(
                'title'    => __('用户框购买按钮', 'zib_language'),
                'subtitle' => '在导航栏用户框内显示开通会员按钮',
                'id'       => 'nav_user_pay_vip',
                'class'    => 'compact',
                'default'  => true,
                'type'     => 'switcher',
            ),
            array(
                'id'      => 'pay_user_vip_1_s',
                'title'   => '一级会员',
                'default' => true,
                'type'    => 'switcher',
            ),
            array(
                'dependency' => array('pay_user_vip_1_s', '!=', ''),
                'title'      => ' ',
                'subtitle'   => '显示名称',
                'id'         => 'pay_user_vip_1_name',
                'class'      => 'compact',
                'default'    => '黄金会员',
                'desc'       => __('会员名称（例如“黄金会员”、“超级会员”）', 'zib_language'),
                'type'       => 'text',
            ),
            array(
                'dependency' => array('pay_user_vip_1_s|pay_user_vip_2_s', '==|!=', '|'),
                'type'       => 'submessage',
                'style'      => 'danger',
                'content'    => '<div style="text-align:center"><b><i class="fa fa-fw fa-ban fa-fw"></i> 必须先开启一级会员后才能开启二级会员！</b></div>',
            ),
            array(
                'id'      => 'pay_user_vip_2_s',
                'title'   => '二级会员',
                'default' => true,
                'type'    => 'switcher',
            ),
            array(
                'dependency' => array('pay_user_vip_1_s|pay_user_vip_2_s', '!=|!=', '|'),
                'title'      => ' ',
                'subtitle'   => '显示名称',
                'id'         => 'pay_user_vip_2_name',
                'class'      => 'compact',
                'default'    => '钻石会员',
                'desc'       => __('会员名称（例如“黄金会员”、“超级会员”）', 'zib_language'),
                'type'       => 'text',
            ),
            array(
                'type'  => 'tabbed',
                'id'    => 'vip_benefit',
                'title' => '会员权益',
                'tabs'  => array(
                    array(
                        'title'  => '普通用户',
                        'icon'   => 'fa fa-user-o',
                        'fields' => array(
                            array(
                                'title'   => '免费资源每日可下载',
                                'desc'    => '普通用户每日最多可下载几个免费资源(为0则不限制)',
                                'id'      => 'pay_download_limit',
                                'default' => 0,
                                'type'    => 'number',
                                'unit'    => '个',
                            ),
                        ),
                    ),
                    array(
                        'title'  => _pz('pay_user_vip_1_name', '一级会员'),
                        'icon'   => 'fa fa-diamond',
                        'fields' => array(
                            array(
                                'title'    => '免费资源每日可下载',
                                'desc'     => _pz('pay_user_vip_1_name') . '每日最多可下载几个免费资源(为0则不限制)',
                                'id'       => 'pay_download_limit_vip_1',
                                'subtitle' => _pz('pay_user_vip_1_name'),
                                'default'  => 0,
                                'type'     => 'number',
                                'unit'     => '个',
                            ),
                        ),
                    ),
                    array(
                        'title'  => _pz('pay_user_vip_2_name', '二级会员'),
                        'icon'   => 'fa fa-diamond',
                        'fields' => array(
                            array(
                                'title'    => '免费资源每日可下载',
                                'desc'     => _pz('pay_user_vip_2_name') . '每日最多可下载几个免费资源(为0则不限制)',
                                'id'       => 'pay_download_limit_vip_2',
                                'subtitle' => _pz('pay_user_vip_2_name'),
                                'default'  => 0,
                                'type'     => 'number',
                                'unit'     => '个',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'type'  => 'tabbed',
                'id'    => 'vip_opt',
                'title' => '会员参数',
                'tabs'  => array(
                    array(
                        'title'  => _pz('pay_user_vip_1_name', '一级会员'),
                        'icon'   => 'fa fa-diamond',
                        'fields' => CFS_Module::vip_tab(1),
                    ),
                    array(
                        'title'  => _pz('pay_user_vip_2_name', '二级会员'),
                        'icon'   => 'fa fa-diamond',
                        'fields' => CFS_Module::vip_tab(2),
                    ),
                    array(
                        'title'  => '会员续费',
                        'icon'   => 'fa fa-fw fa-chain-broken',
                        'fields' => array(
                            array(
                                'dependency' => array('pay_user_vip_1_s', '!=', '', 'all', 'visible'),
                                'id'         => 'vip_renew',
                                'title'      => '会员续费',
                                'help'       => '关闭后则不能续费，只能会员到期之后再购买。永久会员不需要续费',
                                'default'    => true,
                                'type'       => 'switcher',
                            ),
                            array(
                                'dependency' => array('pay_user_vip_1_s|vip_renew', '!=|!=', '|', 'all', 'visible'),
                                'title'      => '续费介绍',
                                'subtitle'   => '一句话简介',
                                'id'         => 'vip_renew_desc',
                                'default'    => '立即续费会员，畅享VIP权益',
                                'desc'       => __('续费会员的一句话简介', 'zib_language'),
                                'type'       => 'text',
                            ),
                            array(
                                'dependency' => array('pay_user_vip_1_s|vip_renew', '!=|!=', '|', 'all', 'visible'),
                                'title'      => '续费商品',
                                'subtitle'   => '一句话简介',
                                'id'         => 'vip_renew_price_type',
                                'default'    => 'discount',
                                'desc'       => __('续费的商品价格可以设置为在购买商品的基础上打折或者立减金额，也可以自定义续费商品', 'zib_language'),
                                'type'       => "select",
                                'options'    => array(
                                    'null '     => __('保持原价(和购买会员相同)', 'zib_language'),
                                    'discount'  => __('打折', 'zib_language'),
                                    'reduce'    => __('优惠立减', 'zib_language'),
                                    'customize' => __('自定义商品', 'zib_language'),
                                ),
                            ),
                            array(
                                'dependency' => array('pay_user_vip_1_s|vip_renew|vip_renew_price_type', '!=|!=|==', '||discount', 'all'),
                                'id'         => 'vip_renew_discount',
                                'title'      => '打折比例',
                                'desc'       => '在会员商品基础上打几折？',
                                'class'      => 'compact',
                                'default'    => 8,
                                'max'        => 9.9,
                                'min'        => 0.1,
                                'step'       => 0.1,
                                'unit'       => '折',
                                'type'       => 'slider',
                            ),
                            array(
                                'dependency' => array('pay_user_vip_1_s|vip_renew|vip_renew_price_type', '!=|!=|==', '||reduce', 'all'),
                                'id'         => 'vip_renew_reduce',
                                'title'      => '优惠金额',
                                'desc'       => '在会员商品基础上优惠的金额，优惠后总金额不能为0元',
                                'class'      => 'compact',
                                'default'    => 20,
                                'max'        => 500,
                                'min'        => 0,
                                'step'       => 5,
                                'unit'       => '元',
                                'type'       => 'spinner',
                            ),
                            array(
                                'dependency'             => array('pay_user_vip_1_s|vip_renew|vip_renew_price_type', '!=|!=|==', '||customize', 'all'),
                                'id'                     => 'vip_1_renew_product',
                                'title'                  => '一级会员续费',
                                'subtitle'               => _pz('pay_user_vip_1_name') . '续费的商品选项',
                                'type'                   => 'group',
                                'accordion_title_prefix' => '续费价格：￥',
                                'max'                    => 8,
                                'button_title'           => '添加续费商品',
                                'default'                => array(
                                    array(
                                        'price'      => '69',
                                        'show_price' => '199',
                                        'tag'        => '<i class="fa fa-fw fa-bolt"></i> 限时特惠',
                                        'time'       => 3,
                                    ),
                                    array(
                                        'price'      => '169',
                                        'show_price' => '299',
                                        'tag'        => '<i class="fa fa-fw fa-bolt"></i> 站长推荐',
                                        'time'       => 6,
                                    ),
                                ),
                                'fields'                 => CFS_Module::vip_product(),
                            ),

                            array(
                                'dependency'             => array('pay_user_vip_1_s|vip_renew|vip_renew_price_type', '!=|!=|==', '||customize', 'all'),
                                'id'                     => 'vip_2_renew_product',
                                'title'                  => '二级会员续费',
                                'subtitle'               => _pz('pay_user_vip_2_name') . '续费的商品选项',
                                'type'                   => 'group',
                                'accordion_title_prefix' => '续费价格：￥',
                                'max'                    => 8,
                                'button_title'           => '添加续费商品',
                                'default'                => array(
                                    array(
                                        'price'      => '269',
                                        'show_price' => '599',
                                        'tag'        => '<i class="fa fa-fw fa-bolt"></i> 限时特惠',
                                        'time'       => 3,
                                    ),
                                    array(
                                        'price'      => '369',
                                        'show_price' => '899',
                                        'tag'        => '<i class="fa fa-fw fa-bolt"></i> 站长推荐',
                                        'time'       => 6,
                                    ),
                                ),
                                'fields'                 => CFS_Module::vip_product(),
                            ),

                        ),
                    ),

                    array(
                        'title'  => '会员升级',
                        'icon'   => 'fa fa-fw fa-line-chart',
                        'fields' => array(
                            array(
                                'dependency' => array('pay_user_vip_1_s|pay_user_vip_2_s', '!=|!=', '|', 'all', 'visible'),
                                'id'         => 'vip_upgrade',
                                'title'      => '会员升级',
                                'default'    => true,
                                'type'       => 'switcher',
                            ),
                            array(
                                'dependency' => array('pay_user_vip_1_s|pay_user_vip_2_s|vip_upgrade', '!=|!=|!=', '||', 'all', 'visible'),
                                'title'      => '升级介绍',
                                'subtitle'   => '一句话简介',
                                'id'         => 'vip_upgrade_desc',
                                'default'    => '升级VIP会员，享更多会员权益',
                                'desc'       => __('升级会员的一句话简介', 'zib_language'),
                                'type'       => 'text',
                            ),
                            array(
                                'dependency' => array('pay_user_vip_1_s|pay_user_vip_2_s|vip_upgrade', '!=|!=|!=', '||', 'all', 'visible'),
                                'id'         => 'vip_upgrade_product',
                                'type'       => 'accordion',
                                'title'      => '升级价格',
                                'subtitle'   => '会员升级的商品选项',
                                'accordions' => array(
                                    array(
                                        'title'  => '月费会员升级月费会员',
                                        'fields' => array(
                                            array(
                                                'content' => '月费会员升级为月费会员，用户会员有效期不会改变<br/>价格按照会员剩余天数计算升级价格，请在下方设置每天的单价',
                                                'style'   => 'warning',
                                                'type'    => 'submessage',
                                            ),
                                            array(
                                                'id'      => 'unit_price',
                                                'title'   => '天单价',
                                                'default' => '10',
                                                'type'    => 'number',
                                                'unit'    => '元',
                                            ),
                                            array(
                                                'id'         => 'unit_tag',
                                                'title'      => '促销标签',
                                                'class'      => 'compact',
                                                'desc'       => '支持HTML，请注意控制长度',
                                                'default'    => '<i class="fa fa-fw fa-bolt"></i> 站长推荐',
                                                'attributes' => array(
                                                    'rows' => 1,
                                                ),
                                                'type'       => 'textarea',
                                            ),
                                            array(
                                                'dependency' => array('unit_tag', '!=', ''),
                                                'title'      => '标签颜色',
                                                'id'         => "unit_tag_class",
                                                'class'      => 'compact skin-color',
                                                'default'    => "jb-yellow",
                                                'type'       => "palette",
                                                'options'    => CFS_Module::zib_palette(),
                                            ),
                                        ),
                                    ),
                                    array(
                                        'title'  => '月费会员升级永久会员',
                                        'fields' => array(
                                            array(
                                                'content' => '如果网站可以购买月费会员和永久会员，则可以开启此项<br/>允许用户由月费会员直接升级到更高一级的永久会员<br>用户之前还未到期的部分将自动一起转为永久会员，可能会涉及到差价问题，请自行告知用户<br>如果网站没有永久会员的购买选项请务必关闭此项',
                                                'style'   => 'warning',
                                                'type'    => 'submessage',
                                            ),
                                            array(
                                                'title'   => __('跨越升级', 'zib_language'),
                                                'id'      => 'jump_s',
                                                'class'   => '',
                                                'default' => false,
                                                'type'    => 'switcher',
                                            ),
                                            array(
                                                'dependency' => array('jump_s', '!=', ''),
                                                'id'         => 'jump_price',
                                                'title'      => '执行价',
                                                'desc'       => '永久会员升级永久会员的价格',
                                                'default'    => '199',
                                                'type'       => 'number',
                                                'unit'       => '元',
                                            ),
                                            array(
                                                'dependency' => array('jump_s', '!=', ''),
                                                'id'         => 'jump_show_price',
                                                'title'      => '原价',
                                                'desc'       => '显示在执行价格前面，并划掉',
                                                'default'    => '299',
                                                'type'       => 'number',
                                                'unit'       => '元',
                                                'class'      => 'compact',
                                            ),
                                            array(
                                                'dependency' => array('jump_s', '!=', ''),
                                                'id'         => 'jump_tag',
                                                'title'      => '促销标签',
                                                'class'      => 'compact',
                                                'default'    => '<i class="fa fa-fw fa-bolt"></i> 升级特惠',
                                                'desc'       => '支持HTML，请注意控制长度',
                                                'attributes' => array(
                                                    'rows' => 1,
                                                ),
                                                'type'       => 'textarea',
                                            ),
                                            array(
                                                'dependency' => array('jump_tag|jump_s', '!=|!=', '|'),
                                                'title'      => '标签颜色',
                                                'id'         => "jump_tag_class",
                                                'class'      => 'compact skin-color',
                                                'default'    => "jb-red",
                                                'type'       => "palette",
                                                'options'    => CFS_Module::zib_palette(),
                                            ),
                                        ),
                                    ),
                                    array(
                                        'title'  => '永久会员升级永久会员',
                                        'fields' => array(
                                            array(
                                                'id'      => 'permanent_price',
                                                'title'   => '执行价',
                                                'desc'    => '永久会员升级永久会员的价格',
                                                'default' => '199',
                                                'type'    => 'number',
                                                'unit'    => '元',
                                            ),
                                            array(
                                                'id'      => 'permanent_show_price',
                                                'title'   => '原价',
                                                'desc'    => '显示在执行价格前面，并划掉',
                                                'default' => '299',
                                                'type'    => 'number',
                                                'unit'    => '元',
                                                'class'   => 'compact',
                                            ),
                                            array(
                                                'id'         => 'permanent_tag',
                                                'title'      => '促销标签',
                                                'class'      => 'compact',
                                                'default'    => '<i class="fa fa-fw fa-bolt"></i> 升级特惠',
                                                'desc'       => '支持HTML，请注意控制长度',
                                                'attributes' => array(
                                                    'rows' => 1,
                                                ),
                                                'type'       => 'textarea',
                                            ),
                                            array(
                                                'dependency' => array('permanent_tag', '!=', ''),
                                                'title'      => '标签颜色',
                                                'id'         => "permanent_tag_class",
                                                'class'      => 'compact skin-color',
                                                'default'    => "jb-red",
                                                'type'       => "palette",
                                                'options'    => CFS_Module::zib_palette(),
                                            ),
                                        ),
                                    ),
                                ),
                            ),

                        ),
                    ),
                ),
            ),
            array(
                'dependency' => array('pay_user_vip_1_s', '!=', ''),
                'title'      => '会员介绍',
                'subtitle'   => '一句话简介',
                'id'         => 'pay_user_vip_desc',
                'default'    => '开通VIP会员，享受会员专属折扣以及多项特权',
                'desc'       => __('显示在开通界面顶部一句话简介，可以为会员权益简介或者活动介绍', 'zib_language'),
                'type'       => 'text',
            ),
            array(
                'dependency' => array('pay_user_vip_1_s', '!=', ''),
                'id'         => 'pay_user_vip_more',
                'title'      => ' ',
                'subtitle'   => '开通会员更多内容',
                'class'      => 'compact',
                'default'    => '<li>购买后不支持退款</li>
<li>VIP权益仅适用于本站</li>
<li>欢迎与站长联系</li>',
                'desc'       => '显示在开通界面底部位置，可以为提醒事项、用户协议等，支持HTML代码',
                'attributes' => array(
                    'rows' => 4,
                ),
                'sanitize'   => false,
                'type'       => 'textarea',
            ),
        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'pay',
        'title'       => '创作分成' . $new_badge['6.3'],
        'icon'        => 'fa fa-fw fa-inbox',
        'description' => '',
        'fields'      => array(
            array(
                'content' => '<p><b>创作分成注意事项：</b></p>
                <li>开启创作分成后，用户发布的付费内容则按设置的比例收入与用户分成</li>
                <li>在下方设置默认的分成比例，同时支持单独为每一个用户设置独立的分成比例</li>
                <li>用户分成比例是按照订单实收现金并扣除推广佣金后，再按设置的比例分成</li>
                <li style="color:#f97113;">创作分成需要配合用户权限系统使用，你需要在权限管理系统中配置【哪些用户可以在发帖或投稿时允许添加付费内容】</li>
                <li style="color:#f97113;">禁用此功能后，仍然可以在权限管理中开启用户设置付费内容，但是所有收款将不会与作者分成</li>
                <li><a href="' . zib_get_admin_csf_url('功能&权限/基本权限') . '">权限管理</a> | <a href="' . admin_url('users.php') . '">用户管理</a> | <a target="_blank" href="https://www.zibll.com/?s=分销系统">官方教程</a></li>',
                'style'   => 'warning',
                'type'    => 'submessage',
            ),
            array(
                'title'   => __('创作分成', 'zib_language'),
                'id'      => 'pay_income_s',
                'class'   => '',
                'default' => false,
                'type'    => 'switcher',
            ),
            array(
                'dependency' => array('pay_income_s', '!=', '', '', 'visible'),
                'type'       => 'tabbed',
                'id'         => 'income_rule',
                'title'      => '现金分成比例',
                'desc'       => '为0则不参与分成',
                'tabs'       => array(
                    array(
                        'title'  => '普通用户',
                        'icon'   => 'fa fa-user-o',
                        'fields' => array(
                            array(
                                'title'    => ' ',
                                'subtitle' => '普通用户分成比例',
                                'id'       => 'ratio',
                                'default'  => 60,
                                'max'      => 100,
                                'min'      => 0,
                                'step'     => 5,
                                'unit'     => '%',
                                'type'     => 'spinner',
                            ),
                        ),
                    ),
                    array(
                        'title'  => _pz('pay_user_vip_1_name', '一级会员'),
                        'icon'   => 'fa fa-diamond',
                        'fields' => array(
                            array(
                                'title'    => ' ',
                                'subtitle' => _pz('pay_user_vip_1_name', '一级会员') . '分成比例',
                                'id'       => 'ratio_vip_1',
                                'default'  => 70,
                                'max'      => 100,
                                'min'      => 0,
                                'step'     => 5,
                                'unit'     => '%',
                                'type'     => 'spinner',
                            ),
                        ),
                    ),
                    array(
                        'title'  => _pz('pay_user_vip_2_name', '二级会员'),
                        'icon'   => 'fa fa-diamond',
                        'fields' => array(
                            array(
                                'title'    => ' ',
                                'subtitle' => _pz('pay_user_vip_2_name', '一级会员') . '分成比例',
                                'id'       => 'ratio_vip_2',
                                'default'  => 80,
                                'max'      => 100,
                                'min'      => 0,
                                'step'     => 5,
                                'unit'     => '%',
                                'type'     => 'spinner',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'dependency' => array('pay_income_s', '!=', '', '', 'visible'),
                'type'       => 'tabbed',
                'id'         => 'income_points_rule',
                'title'      => '积分分成比例',
                'desc'       => '为0则不参与分成（用户采用积分支付的订单给与作者的分成比例）',
                'tabs'       => array(
                    array(
                        'title'  => '普通用户',
                        'icon'   => 'fa fa-user-o',
                        'fields' => array(
                            array(
                                'title'    => ' ',
                                'subtitle' => '普通用户分成比例',
                                'id'       => 'ratio',
                                'default'  => 100,
                                'max'      => 100,
                                'min'      => 0,
                                'step'     => 5,
                                'unit'     => '%',
                                'type'     => 'spinner',
                            ),
                        ),
                    ),
                    array(
                        'title'  => _pz('pay_user_vip_1_name', '一级会员'),
                        'icon'   => 'fa fa-diamond',
                        'fields' => array(
                            array(
                                'title'    => ' ',
                                'subtitle' => _pz('pay_user_vip_1_name', '一级会员') . '分成比例',
                                'id'       => 'ratio_vip_1',
                                'default'  => 100,
                                'max'      => 100,
                                'min'      => 0,
                                'step'     => 5,
                                'unit'     => '%',
                                'type'     => 'spinner',
                            ),
                        ),
                    ),
                    array(
                        'title'  => _pz('pay_user_vip_2_name', '二级会员'),
                        'icon'   => 'fa fa-diamond',
                        'fields' => array(
                            array(
                                'title'    => ' ',
                                'subtitle' => _pz('pay_user_vip_2_name', '一级会员') . '分成比例',
                                'id'       => 'ratio_vip_2',
                                'default'  => 100,
                                'max'      => 100,
                                'min'      => 0,
                                'step'     => 5,
                                'unit'     => '%',
                                'type'     => 'spinner',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'dependency' => array('pay_income_s', '!=', '', '', 'visible'),
                'title'      => '创作分成说明',
                'id'         => 'pay_income_desc_details',
                'default'    => '<p>在本站发布付费内容，获得的收益将参与收入分成</p>
<p>发布付费内容，请注意以下事项</p>
<p>普通用户分成比例为：60%</p>
<p>黄金会员分成比例为：70%</p>
<p>钻石会员分成比例为：80%</p>
<p>分成比例的计算方式为：（实收现金-推广佣金）x 分成比例</p>
<p>获得收入超过50元后可申请现金提现</p>
<p>申请提现后，需后台人工处理，一般2-3小时，请耐心等待</p>
<p>如需申请更高的分成比例，或有其它疑问，请与客服联系</p>',
                'desc'       => '显示在用户中心的说明，建议为发布协议或者其他说明（必填项，内容不易太少）</br>支持HTML代码，请注意代码规范及标签闭合',
                'sanitize'   => false,
                'type'       => 'textarea',
                'attributes' => array(
                    'rows' => 8,
                ),
            ),
            array(
                'dependency' => array('pay_income_s', '!=', '', '', 'visible'),
                'title'      => __('创作分成详情页面', 'zib_language'),
                'id'         => 'pay_income_desc_page_s',
                'desc'       => '您可以新建一个页面写入更加详细的创作分成说明及协议内容，再此项并选择对应的页面。',
                'class'      => '',
                'default'    => false,
                'type'       => 'switcher',
            ),
            array(
                'dependency' => array('pay_income_desc_page_s|pay_income_s', '!=|!=', ''),
                'title'      => ' ',
                'subtitle'   => '选择页面',
                'class'      => 'compact',
                'id'         => 'pay_income_desc_page',
                'default'    => '',
                'options'    => 'page',
                'query_args' => array(
                    'posts_per_page' => -1,
                ),
                'type'       => 'select',
            ),

        ))
    );

    CSF::createSection($prefix, array(
        'parent'      => 'pay',
        'title'       => '推广返佣',
        'icon'        => 'fa fa-fw fa-btc',
        'description' => '',
        'fields'      => array(
            array(
                'content' => '<p><b>推广返佣设置注意事项：</b></p>
                <li>识别模式：绑定注册->用户只要是通过任意推广链接注册的，今后此用户消费均会给推荐人返佣</li>
                <li>识别模式：仅推广链接->只有通过推广链接购买的才会给推荐人返佣，不会考虑是否是推荐注册的</li>
                <li>开启的订单类型如果一个都不勾选，则代表该用户类型不参与此功能</li>
                <li>您可以根据网站的VIP设置相互配合设置相应的规则</li>
                <li>下面的设置为全局设置，还可以单独为每一个用户设置规则和比例</li>
                <li><a href="' . admin_url('users.php') . '">用户管理</a> | <a target="_blank" href="https://www.zibll.com/?s=%E6%8E%A8%E5%B9%BF%E8%BF%94%E4%BD%A3">官方教程</a></li>',
                'style'   => 'warning',
                'type'    => 'submessage',
            ),
            array(
                'title'   => __('推广返佣', 'zib_language'),
                'id'      => 'pay_rebate_s',
                'class'   => '',
                'default' => false,
                'type'    => 'switcher',
            ),
            array(
                'dependency' => array('pay_rebate_s', '!=', '', '', 'visible'),
                'title'      => __('推广识别模式', 'zib_language'),
                'id'         => 'pay_rebate_judgment',
                'default'    => 'all',
                'type'       => "radio",
                'options'    => array(
                    'all'  => __('绑定注册', 'zib_language'),
                    'link' => __('仅推广链接', 'zib_language'),
                ),
            ),
            array(
                'dependency' => array('pay_rebate_s', '!=', '', '', 'visible'),
                'type'       => 'tabbed',
                'id'         => 'rebate_rule',
                'subtitle'   => '为不同用户类型设置返佣规则',
                'title'      => '返佣规则',
                'tabs'       => array(
                    array(
                        'title'  => '普通用户',
                        'icon'   => 'fa fa-fw fa-user-o',
                        'fields' => array(
                            array(
                                'title'   => '返佣订单',
                                'desc'    => '普通用户返利的订单类型，全部关闭，则代表普通用户不参与推广返佣',
                                'default' => array(),
                                'id'      => 'pay_rebate_user_s',
                                'type'    => 'checkbox',
                                'options' => CFS_Module::rebate_type(),
                            ),
                            array(
                                'dependency' => array('pay_rebate_user_s', '!=', '', '', 'visible'),
                                'title'      => ' ',
                                'subtitle'   => '普通用户返佣比例',
                                'id'         => 'pay_rebate_ratio',
                                'class'      => 'compact',
                                'default'    => 5,
                                'max'        => 100,
                                'min'        => 0,
                                'step'       => 1,
                                'unit'       => '%',
                                'type'       => 'spinner',
                            ),
                        ),
                    ),
                    array(
                        'title'  => _pz('pay_user_vip_1_name', '一级会员'),
                        'icon'   => 'fa fa-fw fa-diamond',
                        'fields' => array(
                            array(
                                'title'   => '返佣订单',
                                'desc'    => _pz('pay_user_vip_1_name') . '返利的订单类型，全部关闭，则代表' . _pz('pay_user_vip_1_name') . '用户不参与推广返佣',
                                'id'      => 'pay_rebate_user_s_1',
                                'default' => array('all'),
                                'type'    => 'checkbox',
                                'options' => CFS_Module::rebate_type(),
                            ),
                            array(
                                'dependency' => array('pay_rebate_user_s_1', '!=', '', '', 'visible'),
                                'title'      => ' ',
                                'subtitle'   => _pz('pay_user_vip_1_name') . '返佣比例',
                                'id'         => 'pay_rebate_ratio_vip_1',
                                'class'      => 'compact',
                                'default'    => 10,
                                'max'        => 100,
                                'min'        => 0,
                                'step'       => 1,
                                'unit'       => '%',
                                'type'       => 'spinner',
                            ),
                        ),
                    ),
                    array(
                        'title'  => _pz('pay_user_vip_2_name', '二级会员'),
                        'icon'   => 'fa fa-fw fa-diamond',
                        'fields' => array(
                            array(
                                'title'   => '返佣订单',
                                'desc'    => _pz('pay_user_vip_2_name') . '返利的订单类型，全部关闭，则代表' . _pz('pay_user_vip_2_name') . '用户不参与推广返佣',
                                'id'      => 'pay_rebate_user_s_2',
                                'default' => array('all'),
                                'type'    => 'checkbox',
                                'options' => CFS_Module::rebate_type(),
                            ),
                            array(
                                'dependency' => array('pay_rebate_user_s_2', '!=', '', '', 'visible'),
                                'title'      => ' ',
                                'subtitle'   => _pz('pay_user_vip_2_name') . '返佣比例',
                                'id'         => 'pay_rebate_ratio_vip_2',
                                'class'      => 'compact',
                                'default'    => 20,
                                'max'        => 100,
                                'min'        => 0,
                                'step'       => 1,
                                'unit'       => '%',
                                'type'       => 'spinner',
                            ),
                        ),
                    ),
                ),
            ),

            array(
                'dependency' => array('pay_rebate_s', '!=', ''),
                'title'      => __('返佣文案', 'zib_language'),
                'id'         => 'pay_rebate_text_desc',
                'subtitle'   => __('一句话简介', 'zib_language'),
                'desc'       => __('一句话简介，内容不易过多', 'zib_language'),
                'default'    => '加入分享计划，获得高额奖励',
                'type'       => 'text',
            ),
            array(
                'dependency' => array('pay_rebate_s', '!=', ''),
                'class'      => 'compact',
                'id'         => 'pay_rebate_text_details_title',
                'title'      => __('返佣详情：', 'zib_language'),
                'subtitle'   => __('返佣详情介绍的标题', 'zib_language'),
                'default'    => '返佣详解',
                'type'       => 'text',
            ),
            array(
                'dependency' => array('pay_rebate_s', '!=', ''),
                'class'      => 'compact',
                'title'      => ' ',
                'subtitle'   => __('返佣详情详细内容', 'zib_language'),
                'id'         => 'pay_rebate_text_details',
                'default'    => '<p>此处的推广链接或登陆后任意文章生成的分享链接均有效</p>
<p>通过您的推广链接打开本站后，在本站购买商品即可获得佣金</p>
<p>通过您的推广链接注册后的用户今后购买的商品均可获得佣金</p>
<p>通过您的推广链接购买部分商品还有额外优惠哦</p>
<p>当佣金积累到50元之后，即可申请提现</p>
<p>申请提现后，需后台人工处理，一般2-3小时，请耐心等待</p>
<p>如需申请更高的返佣比例，或有其它疑问，请与客服联系</p>',
                'desc'       => '返佣详情介绍，建议为规则介绍或者其他说明</br>支持HTML代码，请注意代码规范及标签闭合',
                'sanitize'   => false,
                'type'       => 'textarea',
                'attributes' => array(
                    'rows' => 6,
                ),
            ),

            array(
                'dependency' => array('pay_rebate_s', '!=', ''),
                'content'    => '<p><b>推广让利标签配置详解：</b></p>
                <li>可使用的变量：折扣<code>%discount%</code> 推荐人姓名<code>%referrer_name%</code></li>
                <li>使用变量示例：<code>%referrer_name%推荐购买 下单再减%discount%元</code> 老唐推荐购买 下单再减100元</li>
                <li><a target="_blank" href="https://www.zibll.com/?s=%E6%8E%A8%E5%B9%BF%E8%BF%94%E4%BD%A3">官方教程</a></li>',
                'style'      => 'warning',
                'type'       => 'submessage',
            ),
            array(
                'dependency' => array('pay_rebate_s', '!=', ''),
                'title'      => __('推广让利 标签', 'zib_language'),
                'desc'       => __('显示在购买模块，推广让利的标签文案', 'zib_language'),
                'id'         => 'pay_rebate_text_discount',
                'default'    => '会员推荐 下单再减%discount%元',
                'type'       => 'text',
            ),

        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'pay',
        'title'       => '收款接口',
        'icon'        => 'fa fa-fw fa-credit-card',
        'description' => '',
        'fields'      => array(
            array(
                'content' => '<p><b>以下收款接口，子比主题仅提供API接入服务，收款平台的可靠性请自行斟酌！</b></p>
                <li>涉及到资金及信息安全，请勿使用盗版主题</li>
                <li>收款接口选用，有相关执照的商家推荐使用官方接口。个人用户推荐使用讯虎PAY和Payjs</li>
                <li>如需定制其它收款接口，欢迎<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=770349780&amp;site=qq&amp;menu=yes" title="QQ联系">与我QQ联系</a></li>
                <li><a target="_blank" href="https://www.zibll.com/580.html" class="loginbtn">付费功能官方教程</a></li>',
                'style'   => 'warning',
                'type'    => 'submessage',
            ),
            array(
                'id'      => 'pay_wechat_sdk_options',
                'default' => 'null',
                'title'   => '微信收款接口',
                'type'    => "select",
                'options' => array(
                    'xhpay'           => __('迅虎PAY-微信', 'zib_language'),
                    'payjs'           => __('PAYJS-微信', 'zib_language'),
                    'xunhupay_wechat' => __('虎皮椒V3-微信', 'zib_language'),
                    'official_wechat' => __('微信官方', 'zib_language'),
                    'codepay_wechat'  => __('码支付-微信', 'zib_language'),
                    'epay'            => __('易支付-微信', 'zib_language'),
                    'vmqphp'          => __('V免签-微信', 'zib_language'),
                    'null'            => __('关闭微信收款', 'zib_language'),
                ),
            ),
            array(
                'id'      => 'pay_alipay_sdk_options',
                'default' => 'null',
                'title'   => '支付宝收款接口',
                'class'   => 'compact',
                'type'    => "select",
                'options' => array(
                    'xhpay'           => __('迅虎PAY-支付宝', 'zib_language'),
                    'payjs'           => __('PAYJS-支付宝', 'zib_language'),
                    'xunhupay_alipay' => __('虎皮椒V3-支付宝', 'zib_language'),
                    'official_alipay' => __('支付宝企业支付/当面付', 'zib_language'),
                    'codepay_alipay'  => __('码支付-支付宝', 'zib_language'),
                    'epay'            => __('易支付-支付宝', 'zib_language'),
                    'vmqphp'          => __('V免签-支付宝', 'zib_language'),
                    'null'            => __('关闭支付宝收款', 'zib_language'),
                ),
            ),
            array(
                'id'         => 'official_alipay',
                'type'       => 'accordion',
                'title'      => '支付宝官方',
                'accordions' => array(
                    array(
                        'title'  => '支付宝官方',
                        'fields' => array(
                            array(
                                'content' => '<p>支付宝官网接口</p>
                                <li>支付宝公钥为必填项目(公钥错误可以成功付款，但会回调失败)</li>
                                <li>回调地址：' . home_url('/') . '</li>
                                <li>同时填写了企业支付以及当面付参数，则优先使用当面付</li>
                                <li>申请地址：<a target="_blank" href="https://b.alipay.com/signing/productDetailV2.htm?productId=I1011000290000001003">点击跳转</a></li>',
                                'style'   => 'info',
                                'type'    => 'submessage',
                            ),
                            array(
                                'title'      => '支付宝公钥',
                                'subtitle'   => 'publickey(必填)',
                                'id'         => 'publickey',
                                'default'    => '',
                                'attributes' => array(
                                    'rows' => 4,
                                ),
                                'sanitize'   => false,
                                'type'       => 'textarea',
                            ),
                            array(
                                'content' => '<p>支付宝当面付：个人可申请，申请难度低</p>
                                <li>支持PC端扫码支付</li>
                                <li><b>支持移动端H5支付</b></li>
                                <li>如需接入此方式请填写下方参数，反之请留空</li>',
                                'style'   => 'info',
                                'type'    => 'submessage',
                            ),
                            array(
                                'title'   => '当面付：APPID',
                                'id'      => 'appid',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'      => '当面付：应用私钥',
                                'subtitle'   => 'privatekey',
                                'class'      => 'compact',
                                'id'         => 'privatekey',
                                'default'    => '',
                                'attributes' => array(
                                    'rows' => 4,
                                ),
                                'sanitize'   => false,
                                'type'       => 'textarea',
                            ),
                            array(
                                'content' => '<p>支付宝企业支付：官方接口，商家可申请，需签约<b>电脑网站支付</b>',
                                'style'   => 'info',
                                'type'    => 'submessage',
                            ),
                            array(
                                'title'   => '网站应用：APPID',
                                'id'      => 'webappid',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'      => '网站应用：应用私钥',
                                'subtitle'   => 'appPrivateKey',
                                'class'      => 'compact',
                                'id'         => 'webprivatekey',
                                'default'    => '',
                                'attributes' => array(
                                    'rows' => 4,
                                ),
                                'sanitize'   => false,
                                'type'       => 'textarea',
                            ),
                            array(
                                'title'   => '开启H5支付',
                                'id'      => 'h5',
                                'class'   => 'compact',
                                'default' => false,
                                'desc'    => '移动端自动跳转到支付宝APP支付，需签约<b>手机网站支付</b>',
                                'type'    => 'switcher',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'         => 'official_wechat',
                'type'       => 'accordion',
                'title'      => '微信官方',
                'accordions' => array(
                    array(
                        'title'  => '微信企业支付',
                        'fields' => array(
                            array(
                                'content' => '<p>微信企业支付：官方接口，商家可申请，有年费，申请较为复杂</p>
                                <p><b>native回调地址：' . ZIB_TEMPLATE_DIRECTORY_URI . '/zibpay/shop/weixin/return.php</b></p>
                                <p><b>JS接口安全域名、授权回调域：' . preg_replace('/^(?:https?:\/\/)?([^\/]+).*$/im', '$1', home_url()) . '</b></p>
                                <li>支持PC端扫码支付(Native支付)</li>
                                <li>支持微信APP内直接支付(JSAPI支付)</li>
                                <li>支持移动端网页中唤起微信app支付(H5支付)</li>',
                                'style'   => 'info',
                                'type'    => 'submessage',
                            ),
                            array(
                                'title'   => '商户号 PartnerID',
                                'id'      => 'merchantid',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => '授权绑定的AppID',
                                'class'   => 'compact',
                                'id'      => 'appid',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => '支付API密钥',
                                'class'   => 'compact',
                                'default' => '',
                                'id'      => 'key',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => 'H5支付',
                                'id'      => 'h5',
                                'class'   => 'compact',
                                'default' => false,
                                'label'   => '移动端跳转到微信APP支付(需开通 H5支付)',
                                'type'    => 'switcher',
                            ),
                            array(
                                'title'   => 'JSAPI支付',
                                'id'      => 'jsapi',
                                'class'   => 'compact',
                                'default' => false,
                                'label'   => '微信APP内直接发起支付',
                                'type'    => 'switcher',
                            ),
                            array(
                                'dependency' => array('jsapi', '!=', ''),
                                'title'      => 'AppSecret',
                                'class'      => 'compact',
                                'id'         => 'appsecret',
                                'default'    => '',
                                'type'       => 'text',
                                'desc'       => '授权绑定的公众号或小程序的AppSecret</br><i class="fa fa-fw fa-info-circle fa-fw"></i>如果此处留空，则会获取<a href="' . zib_get_admin_csf_url('用户互动/社交登录') . '">社交登录(微信公众号登录)</a>的APPID和AppSecret',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'         => 'xunhupay',
                'type'       => 'accordion',
                'title'      => '虎皮椒V3',
                'accordions' => array(
                    array(
                        'title'  => '虎皮椒V3',
                        'fields' => array(
                            array(
                                'content' => '<p>虎皮椒是迅虎网络旗下的支付产品，无需营业执照、无需企业，申请简单。适合个人站长申请，有一定的费用</p>
                                <li>支持PC端扫码支付</li>
                                <li>支付宝支持移动端跳转APP支付</li>
                                <li>微信支持微信APP内支付</li>
                                <li>开通地址：<a target="_blank" href="https://admin.xunhupay.com/sign-up/12207.html">点击跳转</a></li>',
                                'style'   => 'info',
                                'type'    => 'submessage',
                            ),
                            array(
                                'title'   => '微信：APPID',
                                'id'      => 'wechat_appid',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => '微信：秘钥secret',
                                'class'   => 'compact',
                                'id'      => 'wechat_appsecret',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title' => '支付宝：APPID',
                                'id'    => 'alipay_appid',
                                'type'  => 'text',
                            ),
                            array(
                                'title'   => '支付宝：秘钥secret',
                                'class'   => 'compact',
                                'id'      => 'alipay_appsecret',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => '自定义API网关网址',
                                'id'      => 'api_url',
                                'default' => '',
                                'type'    => 'text',
                                'desc'    => '如果服务商单独提供了网关地址，请在此填写，默认为<code>https://api.xunhupay.com/payment/do.html</code>',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'         => 'xhpay',
                'type'       => 'accordion',
                'title'      => '迅虎PAY',
                'accordions' => array(
                    array(
                        'title'  => '迅虎PAY（虎皮椒V4）',
                        'fields' => array(
                            array(
                                'content' => '<p>迅虎PAY又叫虎皮椒V4，是迅虎网络打造的一个全新的个人收款平台，申请简单，适合个人站长</p>
                                <li>微信、支付宝支持PC端扫码支付</li>
                                <li>微信支持微信内支付、APP跳转支付（H5支付）</li>
                                <li>支付宝APP跳转支付（H5支付）</li>
                                <li style="color:#ff2153;">请务请联系讯虎客服手动设置微信返回域名以及配置小票页面</li>
                                <li>开通地址：<a target="_blank" href="https://pay.xunhuweb.com">点击跳转</a></li>',
                                'style'   => 'info',
                                'type'    => 'submessage',
                            ),
                            array(
                                'title'   => '商户号 mchid',
                                'id'      => 'mchid',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => 'API密钥 key',
                                'class'   => 'compact',
                                'default' => '',
                                'id'      => 'key',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => '支付宝V2.0',
                                'id'      => 'alipay_v2',
                                'default' => false,
                                'label'   => '如开通的支付宝接口为2.0版本，需开启此项',
                                'type'    => 'switcher',
                            ),
                            array(
                                'title'   => '自定义API网关网址',
                                'id'      => 'api_url',
                                'default' => '',
                                'type'    => 'text',
                                'desc'    => '如果服务商单独提供了网关地址，请在此填写，默认为<code>https://admin.xunhuweb.com</code>',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'         => 'payjs',
                'type'       => 'accordion',
                'title'      => 'PAYJS',
                'accordions' => array(
                    array(
                        'title'  => 'PAYJS',
                        'fields' => array(
                            array(
                                'content' => '<p>PAYJS支持微信、支付宝收款，个人可申请，申请方便，有一定费用</p>
                                <li>微信、支付宝支持PC端扫码支付</li>
                                <li>微信支持微信内支付、APP跳转支付（H5支付）</li>
                                <li>支持微信内自动跳转微信收银台付款，此界面的LOGO调用的是全局桌面图标</li>
                                <li>如果选择了支付宝接口也为PAYJS，请确保您的帐号开通了支付宝收款</li>
                                <li>开通地址：<a target="_blank" href="https://payjs.cn">点击跳转</a></li>',
                                'style'   => 'info',
                                'type'    => 'submessage',
                            ),
                            array(
                                'title'   => '商户号 mchid',
                                'default' => '',
                                'id'      => 'mchid',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => 'API密钥 key',
                                'default' => '',
                                'class'   => 'compact',
                                'id'      => 'key',
                                'type'    => 'text',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'         => 'codepay',
                'type'       => 'accordion',
                'title'      => '码支付',
                'accordions' => array(
                    array(
                        'title'  => '码支付',
                        'fields' => array(
                            array(
                                'content' => '<p>码支付支持微信、支付宝收款，个人可申请</p>
                                <li>支持PC端扫码支付</li>
                                <li>请注意码支付的通知设置，基础版需要软件挂机。</li>
                                <li>在码支付后台无需填写通知地址</li>
                                <li class="c-red">由于码支付经营调整，现此接口已无法使用(2022年2月)</li>',
                                'style'   => 'info',
                                'type'    => 'submessage',
                            ),
                            array(
                                'title'   => '码支付ID',
                                'id'      => 'id',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => '通信密钥',
                                'class'   => 'compact',
                                'id'      => 'key',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => 'Token',
                                'class'   => 'compact',
                                'id'      => 'token',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => '自定义API接口',
                                'class'   => 'compact',
                                'id'      => 'apiurl',
                                'default' => '',
                                'type'    => 'text',
                                'desc'    => '此功能可接入使用码支付源码搭建的其它支付接口，留空则使用码支付官方接口<code>https://api.xiuxiu888.com/</code>',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'         => 'epay',
                'type'       => 'accordion',
                'title'      => '易支付',
                'accordions' => array(
                    array(
                        'title'  => '易支付',
                        'fields' => array(
                            array(
                                'content' => '
                                <li>主题只负责技术接入，平台可靠性请自行斟酌</li>',
                                'style'   => 'info',
                                'type'    => 'submessage',
                            ),
                            array(
                                'title'   => 'API接口网址',
                                'id'      => 'apiurl',
                                'default' => '',
                                'type'    => 'text',
                                'desc'    => '请填写完整的接口网址，例如：<code>https://pay.v8jisu.cn/</code>',
                            ),
                            array(
                                'title'   => '商户号',
                                'class'   => 'compact',
                                'id'      => 'partner',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => '商户秘钥',
                                'class'   => 'compact',
                                'id'      => 'key',
                                'default' => '',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => 'PC端扫码支付',
                                'id'      => 'qrcode',
                                'class'   => 'compact',
                                'default' => false,
                                'desc'    => 'PC端请求qrcode.php接口，免跳转直接扫码支付(提示请求二维码失败，则需关闭此功能)',
                                'type'    => 'switcher',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'         => 'vmqphp',
                'type'       => 'accordion',
                'title'      => 'V免签',
                'accordions' => array(
                    array(
                        'title'  => 'V免签',
                        'fields' => array(
                            array(
                                'content' => '<p>V免签支付系统是一款需要自行搭建的支付接口，原理和码支付类似，通过软件挂机监控的方式接入</p>V免签属于开源项目，任何人均可免费搭建使用</br>需要软件挂机，稳定性会受到网络、服务器、软件等很多因素影响</br>建议有一定基础的站长可选此接口，不推荐作为首选</br>开源地址：<a target="_blank" href="https://github.com/szvone/vmqphp">https://github.com/szvone/vmqphp</a>',
                                'style'   => 'info',
                                'type'    => 'submessage',
                            ),
                            array(
                                'title'   => '接口地址',
                                'id'      => 'apiurl',
                                'default' => '',
                                'desc'    => '搭建好的接口地址，例如：<code>https://api.qorvo.shop/</code>',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => '通讯密钥',
                                'class'   => 'compact',
                                'default' => '',
                                'id'      => 'key',
                                'type'    => 'text',
                            ),
                            array(
                                'title'   => '免跳转扫码支付',
                                'id'      => 'no_open',
                                'class'   => 'compact',
                                'default' => true,
                                'desc'    => '免跳转直接扫码支付，关闭后则跳转到V免签支付页面',
                                'type'    => 'switcher',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'over',
        'title'       => '系统工具'.$new_badge['6.4'],
        'icon'        => 'fa fa-fw fa-gavel',
        'description' => '',
        'fields'      => array(
            array(
                'id'      => 'hide_admin_bar',
                'type'    => 'switcher',
                'label'   => "开启后则不显示WordPress顶部黑条",
                'default' => true,
                'title'   => '关闭顶部admin_bar',
            ),

            array(
                'id'      => 'remove_emoji',
                'type'    => 'switcher',
                'default' => true,
                'title'   => '删除WordPress自带Emoji表情',
            ),
            array(
                'id'      => 'remove_open_sans',
                'type'    => 'switcher',
                'default' => true,
                'title'   => '禁用Google字体',
            ),
            array(
                'id'      => 'remove_more_wp_head',
                'type'    => 'switcher',
                'default' => true,
                'title'   => '清理多于的头部Meta标签',
            ),
            array(
                'id'      => 'newfilename',
                'type'    => 'switcher',
                'label'   => '上传文件自动重命名为随机英文名',
                'default' => false,
                'title'   => __('上传文件重命名', 'zib_language'),
            ),
            array(
                'id'      => 'admin_allow_upload_svg',
                'type'    => 'switcher',
                'label'   => '管理员允许',
                'default' => false,
                'title'   => __('上传SVG图片', 'zib_language'),
            ),
            array(
                'id'      => 'allow_upload_svg',
                'type'    => 'switcher',
                'class'   => 'compact',
                'label'   => '所有用户允许',
                'desc'    => '建议关闭，仅在需要时开启，开启后会存在XSS风险',
                'default' => false,
                'title'   => ' ',
            ),
            array(
                'id'      => 'display_wp_update',
                'type'    => 'switcher',
                'default' => false,
                'title'   => '禁止WordPress检测更新',
            ),

            array(
                'id'      => 'no_repetition_name',
                'label'   => '前端注册或修改资料，不允许修改为已存在的昵称(不影响后台修改)',
                'type'    => 'switcher',
                'default' => true,
                'title'   => '禁止重复昵称',
            ),
            array(
                'id'      => 'admin_user_del_fields',
                'label'   => '开启后在后台编辑用户资料时将不显示无用的多余选项',
                'type'    => 'switcher',
                'default' => true,
                'title'   => '关闭后台用户编辑多余的选项',
            ),
            array(
                'title'   => '前端页面编辑',
                'id'      => 'admin_frontend_set',
                'type'    => 'switcher',
                'default' => true,
                'label'   => '管理员可在前台快速修改页面、文章参数',
            ),
            array(
                'title'   => '禁用古腾堡编辑器',
                'id'      => 'close_gutenberg',
                'type'    => 'switcher',
                'default' => false,
                'label'   => '后台编辑器仍然使用4.9的编辑器',
                'desc'    => '<b style="color:#fb5757;"><i class="fa fa-fw fa-info-circle fa-fw"></i> 禁用后主题的所有编辑器增强功能将都不能使用！请酌情禁用！</b></br><a target="_blank" href="https://www.zibll.com/zibll_word/%e5%8f%a4%e8%85%be%e5%a0%a1%e7%bc%96%e8%be%91%e5%99%a8">查看主题强大的编辑器相关教程</a>',
            ),
            array(
                'title'   => '经典编辑器增强浮动工具栏'.$new_badge['6.4'],
                'id'      => 'mce_float_toolbar',
                'type'    => "checkbox",
                'inline'  => true,
                'desc'    => __('开启后前端编辑器会显示浮动的工具栏，更加方便书写', 'zib_language'),
                'options' => array(
                    'pc_s' => 'PC端开启',
                    'm_s'  => '移动端开启',
                ),
                'default' => array('pc_s', 'm_s'),
            ),
            array(
                'title'   => '倒计时显示',
                'id'      => 'time_ago_s',
                'type'    => 'switcher',
                'label'   => '时间格式化为：X分钟前，X小时前，X天前....',
                'default' => true,
            ),

            array(
                'dependency' => array('time_ago_s', '==', '', '', 'visible'),
                'title'      => ' ',
                'subtitle'   => '自定义时间格式',
                'id'         => 'time_format',
                'type'       => "text",
                'desc'       => '时间格式接受标准时间格式，请注意控制长度！',
                'class'      => 'compact',
                'default'    => 'n月j日 H:i',
            ),
            array(
                'title'   => __('框架文件CDN托管', 'zib_language'),
                'id'      => 'js_outlink',
                'default' => "no",
                'desc'    => '将核心框架JS文件和CSS文件托管到CDN，对于部分地区的服务器可提高加载速度。如果页面显示不正常，请关闭！',
                'type'    => "radio",
                'options' => array(
                    'no'         => __('不托管', 'zib_language'),
                    'staticfile' => __('七牛云', 'zib_language'),
                    'bootcdn'    => __('BootCDN', 'zib_language'),
                    'he'         => __('框架来源站点', 'zib_language'),
                ),
            ),
            array(
                'title'   => '前端图像上传限制',
                'id'      => 'up_max_size',
                'default' => 4,
                'desc'    => __('前端允许上传的最大图像大小（单位M,不能为0）', 'zib_language'),
                'max'     => 10,
                'min'     => 0,
                'step'    => 0.5,
                'unit'    => 'M',
                'type'    => 'spinner',
            ),
            array(
                'title'   => '前端视频上传限制',
                'id'      => 'up_video_max_size',
                'default' => 30,
                'desc'    => __('前端允许上传的视频最大大小（单位M,不能为0）', 'zib_language'),
                'max'     => 10,
                'min'     => 0,
                'step'    => 2,
                'unit'    => 'M',
                'type'    => 'spinner',
            ),
        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'over',
        'title'       => '网站安全' . $new_badge['6.3'],
        'icon'        => 'fa fa-fw fa-umbrella',
        'description' => '',
        'fields'      => array(
            array(
                'title'   => '人机验证',
                'id'      => 'verification_comment_s',
                'type'    => 'switcher',
                'label'   => '发表评论需人机验证',
                'default' => false,
            ),
            array(
                'title'   => ' ',
                'id'      => 'verification_links_s',
                'class'   => 'compact',
                'type'    => 'switcher',
                'label'   => '提交链接需人机验证',
                'default' => true,
            ),
            array(
                'title'   => ' ',
                'id'      => 'verification_newposts_s',
                'class'   => 'compact',
                'type'    => 'switcher',
                'label'   => '提交投稿需人机验证',
                'default' => false,
            ),
            array(
                'title'   => ' ',
                'id'      => 'verification_bbspost_s',
                'class'   => 'compact',
                'type'    => 'switcher',
                'label'   => '论坛发帖需人机验证',
                'default' => false,
            ),
            array(
                'title'    => '登录人机验证排除账号',
                'subtitle' => '排除的登录用户名',
                'desc'     => '<div style="color:#ff4021;"><i class="fa fa-fw fa-info-circle fa-fw"></i>(*必填)当选择第三方验证时候，可能会因为参数错误而导致管理员无法通过验证登录进入后台，所以在此设置一个排除管理员登录账号。当登录账号与此设置完全相同时候，则不会进行人机验证</div>',
                'default'  => '',
                'id'       => 'verification_signin_exclude',
                'type'     => 'text',
            ),
            array(
                'title'    => '人机验证类型',
                'subtitle' => __('有效防止机器入侵', 'zib_language'),
                'id'       => 'user_verification_type',
                'default'  => 'slider',
                'type'     => "radio",
                'options'  => array(
                    'image'    => __('图片验证码'),
                    'slider'   => __('滑动拼图验证'),
                    'tcaptcha' => __('腾讯智能验证(推荐)'),
                    'geetest'  => __('极验行为验4.0(推荐)'),
                    'null'     => __('关闭'),
                ),
            ),
            array(
                'dependency' => array('user_verification_type', '==', 'geetest'),
                'title'      => ' ',
                'subtitle'   => '极验行为验参数',
                'sanitize'   => false,
                'id'         => 'geetest_option',
                'type'       => 'fieldset',
                'class'      => 'compact',
                'fields'     => array(
                    array(
                        'content' => '极验行为验是一款性价比很高的AI智能验证产品，可申请免费使用，第四代行为验又全面升级，推荐使用<br/>申请地址：<a target="_blank" href="https://www.geetest.com">极验行为验官网</a> | <a target="_blank" href="https://www.zibll.com/?s=极验行为验">查看官方教程</a>',
                        'style'   => 'info',
                        'type'    => 'submessage',
                    ),
                    array(
                        'title' => '验证 Id',
                        'id'    => 'id',
                        'type'  => 'text',
                    ),
                    array(
                        'title' => '验证 Key',
                        'class' => 'compact',
                        'id'    => 'key',
                        'type'  => 'text',
                    ),
                ),
            ),
            array(
                'dependency' => array('user_verification_type', '==', 'tcaptcha'),
                'title'      => ' ',
                'subtitle'   => '腾讯智能验证参数',
                'sanitize'   => false,
                'id'         => 'tcaptcha_option',
                'type'       => 'fieldset',
                'class'      => 'compact',
                'fields'     => array(
                    array(
                        'content' => '使用腾讯智能验证，可有效的提高网站的安全性。<br/>申请地址：<a target="_blank" href="https://console.cloud.tencent.com/captcha/graphical">腾讯智能验证</a> | <a target="_blank" href="https://www.zibll.com/?s=腾讯验证码">查看官方教程</a>',
                        'style'   => 'info',
                        'type'    => 'submessage',
                    ),
                    array(
                        'title' => 'API密钥SecretId',
                        'id'    => 'api_secret_id',
                        'type'  => 'text',
                    ),
                    array(
                        'title' => 'API密钥SecretKey',
                        'class' => 'compact',
                        'id'    => 'api_secret_key',
                        'type'  => 'text',
                    ),
                    array(
                        'title' => '验证码CaptchaAppId',
                        'id'    => 'appid',
                        'type'  => 'text',
                    ),
                    array(
                        'title' => '验证码AppSecretKey',
                        'class' => 'compact',
                        'id'    => 'secret_key',
                        'type'  => 'text',
                    ),
                ),
            ),
            array(
                'id'      => 'disabled_pingback',
                'type'    => 'switcher',
                'default' => true,
                'title'   => '防pingback攻击',
            ),
            array(
                'title'   => '非管理员禁止进入后台',
                'id'      => 'user_disable_admin',
                'type'    => 'switcher',
                'default' => true,
                'label'   => '为了安全，如非必要请勿允许非管理员进入后台',
            ),
        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'over',
        'title'       => 'API内容审核',
        'icon'        => 'fa fa-fw fa-paw',
        'description' => '',
        'fields'      => array(
            array(
                'content' => '<p>将网站的交互功能接入API进行内容审核，用户在上传图片、发布文章、发表评论等操作时实时对用户输入内容进行审核，禁止用户输入不合法、不合规的内容。<br/>接入API审核能有效的简化人工审核难度，进一步提高网站合规性<br/> <a target="_blank" href="https://www.zibll.com/2997.html">查看官方教程</a></p>
                <div style="color:#f97113;"><i class="fa fa-fw fa-info-circle fa-fw"></i>注意事项：
                <br/> 1、此功能仅对前台操作有效，wp后台操作不审核
                <br/> 2、此功能不会审核管理员操作的内容
                <br/> 3、此功能不会在前台显示错误信息，前台使用时只有接入成功并且返回不合规时候才会向用户提示。所以此功能配置完成后请在此页面最下方进行测试！
                <br/> 4、此功能需要连接API接口，需要额外耗费一定时间，为了避免出现长时间无响应，此功能最长响应时间为12秒，如果您的服务器网络很慢，可能会无法正确审核
                <br/> 5、建议关闭违禁词的模糊匹配，开启后会很容易误报
                </div>',
                'style'   => 'warning',
                'type'    => 'submessage',
            ),
            array(
                'id'      => 'api_audit_text_sdk',
                'default' => 'null',
                'title'   => '文本审核接口',
                'type'    => "select",
                'options' => array(
                    'baidu' => __('百度', 'zib_language'),

                    'null'  => __('关闭API文本审核', 'zib_language'),
                ),
            ),
            array(
                'id'      => 'api_audit_img_sdk',
                'default' => 'null',
                'title'   => '图像审核接口',
                'class'   => 'compact',
                'type'    => "select",
                'options' => array(
                    'baidu' => __('百度', 'zib_language'),

                    'null'  => __('关闭API图像审核', 'zib_language'),
                ),
            ),
            array(
                'title'   => '文本允许疑似合规',
                'id'      => 'audit_be_like_text',
                'type'    => 'switcher',
                'label'   => '文本审核将疑似合规内容也视为通过',
                'default' => false,
            ),
            array(
                'title'   => '图片允许疑似合规',
                'id'      => 'audit_be_like_img',
                'class'   => 'compact',
                'type'    => 'switcher',
                'label'   => '图片审核将疑似合规内容也视为通过',
                'default' => false,
            ),
            array(
                'title'    => ' ',
                'subtitle' => '图片上传审核选项',
                'style'    => 'warning',
                'type'     => 'content',
            ),
            array(
                'title'   => '用户上传图片审核',
                'id'      => 'audit_upload_img',
                'class'   => 'compact',
                'type'    => 'switcher',
                'label'   => '',
                'default' => false,
            ),
            array(
                'title'    => ' ',
                'subtitle' => '文本内容审核选项',
                'style'    => 'warning',
                'type'     => 'content',
            ),
            array(
                'title'   => '用户昵称/签名审核',
                'id'      => 'audit_user_desc',
                'class'   => 'compact',
                'type'    => 'switcher',
                'label'   => '',
                'default' => false,
            ),
            array(
                'dependency' => array('private_s', '!=', '', 'all'),
                'title'      => '私信内容审核',
                'id'         => 'audit_msg_private',
                'class'      => 'compact',
                'type'       => 'switcher',
                'label'      => '',
                'default'    => false,
            ),
            array(
                'title'   => '评论内容审核',
                'id'      => 'audit_comment',
                'class'   => 'compact',
                'type'    => 'switcher',
                'label'   => '',
                'default' => false,
            ),
            array(
                'dependency' => array('post_article_s', '!=', '', 'all'),
                'title'      => '前台投稿审核',
                'id'         => 'audit_new_post',
                'class'      => 'compact',
                'type'       => 'switcher',
                'label'      => '',
                'default'    => false,
            ),
            array(
                'dependency' => array('bbs_s', '!=', '', 'all'),
                'title'      => '[论坛]发布帖子',
                'id'         => 'audit_bbs_posts',
                'type'       => 'switcher',
                'label'      => '',
                'default'    => false,
            ),
            array(
                'dependency' => array('bbs_s', '!=', '', 'all'),
                'title'      => '[论坛]创建板块',
                'class'      => 'compact',
                'id'         => 'audit_bbs_plate',
                'type'       => 'switcher',
                'label'      => '',
                'default'    => false,
            ),
            array(
                'dependency' => array('bbs_s', '!=', '', 'all'),
                'title'      => '[论坛]话题/标签/板块分类',
                'class'      => 'compact',
                'id'         => 'audit_bbs_term',
                'type'       => 'switcher',
                'label'      => '',
                'default'    => false,
            ),
            array(
                'title'    => '百度',
                'subtitle' => '接口配置',
                'id'       => 'audit_sdk_baidu',
                'type'     => 'fieldset',
                'fields'   => array(
                    array(
                        'content' => '申请地址：<a target="_blank" href="https://ai.baidu.com/censoring">https://ai.baidu.com/censoring</a> | <a target="_blank" href="https://www.zibll.com/2997.html">查看官方教程</a>',
                        'style'   => 'info',
                        'type'    => 'submessage',
                    ),
                    array(
                        'title' => 'App Key',
                        'class' => 'compact',
                        'id'    => 'appkey',
                        'type'  => 'text',
                    ),
                    array(
                        'title' => 'Secret Key',
                        'class' => 'compact',
                        'id'    => 'secretkey',
                        'type'  => 'text',
                    ),
                ),
            ),
            CFS_Module::audit_test(),
        ),
    ));

    CSF::createSection($prefix, array(
        'parent'      => 'over',
        'title'       => '百度熊掌号',
        'icon'        => 'fa fa-fw fa-paw',
        'description' => '',
        'fields'      => array(
            array(
                'content' => '<i class="fa fa-fw fa-info-circle fa-fw"></i> 由于百度官方原因，此功能已不推荐使用',
                'style'   => 'warning',
                'type'    => 'submessage',
            ),
            array(
                'title'   => __('百度熊掌号', 'zib_language'),
                'id'      => 'xzh_on',
                'default' => false,
                'desc'    => ' 开启',
                'type'    => 'switcher',
            ),

            array(
                'title'   => '熊掌号 AppID',
                'id'      => 'xzh_appid',
                'default' => '',
                'type'    => 'text',
            ),
            array(
                'title'    => __('显示熊掌号', 'zib_language'),
                'id'       => 'xzh_render_tail',
                'class'    => '',
                'default'  => true,
                'subtitle' => '文章内容底部',
                'type'     => 'switcher',
            ),

            array(
                'title'    => __('添加JSON_LD数据', 'zib_language'),
                'id'       => 'xzh_jsonld_single',
                'class'    => '',
                'default'  => true,
                'subtitle' => '文章页添加',
                'type'     => 'switcher',
            ),

            array(
                'title'    => ' ',
                'class'    => 'compact',
                'id'       => 'xzh_jsonld_page',
                'default'  => false,
                'subtitle' => '页面添加',
                'type'     => 'switcher',
            ),

            array(
                'title'    => ' ',
                'id'       => 'xzh_jsonld_img',
                'subtitle' => '不添加图片',
                'class'    => 'compact',
                'default'  => false,
                'type'     => 'switcher',
            ),
        ),
    ));
    CSF::createSection($prefix, array(
        'parent'      => 'over',
        'title'       => '文档模式',
        'icon'        => 'fa fa-fw fa-file-text',
        'description' => '',
        'fields'      => array(
            array(
                'content' => '<p><b>文档模式：</b></p><li>文档模式适合帮助文档、使用文档等类型的文章使用</li><li>此模式会自动搜索二级分类及文章生成列表，请选择一级分类</li><li>为了良好的效果，文章分类请选择最后的子分类</li><li>请勿依赖此功能，今后可能会取消此功能</li>',
                'style'   => 'warning',
                'type'    => 'submessage',
            ),
            array(
                'title'    => __('文档模式', 'zib_language'),
                'subtitle' => '开启文档模式的分类',
                'id'       => 'docs_mode_cats',
                'desc'     => __('', 'zib_language'),
                'default'  => array(),
                'options'  => 'categories',
                'type'     => 'checkbox',
            ),
            array(
                'title'   => __('在首页排除此类内容', 'zib_language'),
                'id'      => 'docs_mode_exclude',
                'class'   => 'compact',
                'type'    => 'switcher',
                'default' => true,
                'desc'    => '开启之后，在网站首页不显示文档模式的相关内容，不影响小工具、其他位置以及首页置顶文章的显示',
            ),
        ),
    ));

    CSF::createSection('zibll_options', array(
        'title'       => '主题&授权',
        'icon'        => 'fa fa-fw fa-gitlab',
        'description' => '',
        'fields'      => array(
            array(
                'type'    => 'submessage',
                'style'   => 'warning',
                'content' => '<h3 style="color:#fd4c73;"><i class="fa fa-heart fa-fw"></i> 感谢您使用Zibll子比主题</h3>
                <div><b>首次使用请在下方进行授权验证</b></div>
                <p>子比主题是一款良心、厚道的好产品！创作不易，支持正版，从我做起！</p>
                <div style="margin:10px 14px;"><li>胖脸子源码官网：<a target="_bank" href="https://www.cx202.com/">https://www.cx202.com/</li>
                <li>当前完美破解版本：<a href="https://www.cx202.com/1171.html">v6.5</a></li>
                <li>子比主题破解合集：<a href="https://www.cx202.com/tag/%e5%ad%90%e6%af%94%e4%b8%bb%e9%a2%98%e7%a0%b4%e8%a7%a3">点击查看</a></li>
                </div>',
            ),
            CFS_Module::aut(),
        ),
    ));
    $update_icon = '';
    if (ZibAut::is_update()) {
        $update_icon = ' c-red';
    }
    CSF::createSection('zibll_options', array(
        'title'       => '文档&更新',
        'icon'        => 'fa fa-fw fa-cloud-upload' . $update_icon,
        'description' => '',
        'fields'      => CFS_Module::update(),
    ));
    CSF::createSection($prefix, array(
        'title'  => '备份&导入',
        'icon'   => 'fa fa-fw fa-copy',
        'fields' => CFS_Module::backup(),
    ));
}
zib_csf_admin_options();
