<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/www/wwwroot/uqblog.8ll6.com/wordpress/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'wp' );

/** Database username */
define( 'DB_USER', 'wp' );

/** Database password */
define( 'DB_PASSWORD', 'm3465838Q' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ':Z e#(yXYVDCydjVNG&(lg0$.S+`8.vg}!/gjavJ(@|  /*y2d^l[kSF<|JX_wDJ' );
define( 'SECURE_AUTH_KEY',  'cr]#: zOvw|$pC=H7%b;.EE%O.M BKYjrLH9V86w,9}iNH_e4jy^~yIv+PRw~,wq' );
define( 'LOGGED_IN_KEY',    'e@&StDJ!#vEx1rph<IIcj1:>^@ACxJx*7;X7dp:gDlX&NY^vIx+MpFX4Z|42},wr' );
define( 'NONCE_KEY',        '`4n{&#SxM!4Tt23Nr5<rJK!RwC_scfV)aGA{a=8Q9 %FzLbQ<KRvV%l?W;Vx!0b<' );
define( 'AUTH_SALT',        'gb+M)XV7M?I%:5~ZoquszhFw=592Aeq|]|@CK|rW=d&<~-f(U J`)%N@!Yvy#VK;' );
define( 'SECURE_AUTH_SALT', '92?Iy#KQ+reYxG:^24#c%%x2/P%@3pfq%IX@8;L^imR]H*qTCG*>z|#Bq4gCAwrJ' );
define( 'LOGGED_IN_SALT',   'IT/JF5V7-5w`=i,XH.Jj-Q6MJAxk=k~EF6-CVl4<Zq-1n~!^-Y1{S|!!V8yJ*P) ' );
define( 'NONCE_SALT',       '}.hezKwy|[]&7r=k_[BaWyb$X +Ep=4NBa&;E$Q#1P]I7:N)*JRFch. XMz0=8vp' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
