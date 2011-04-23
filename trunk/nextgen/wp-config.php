<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'nextgen');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '*].cfx,uk@]BHj?I)`jZ)b|Lz5S<[=Vb` e!;N6{Wp(Q_T$TQN]i1Wg&V]B=JaXk');
define('SECURE_AUTH_KEY',  'D]wEL6$yhE-#B:m0eOYRcu+>xPA(zo|B0kY-/^{L{Zq|-8b~Hd,8Fo|Ay_wmIagw');
define('LOGGED_IN_KEY',    '#7J+S[0N&VA<(s]UrrpTtvqM/)Z+>k0Mi0z0i_,YsE;Lj9]fO pv/*Qy|Z9@$x~p');
define('NONCE_KEY',        '[D9QNaL!MM0L6I4ubE!|]|I-9Oo0ab,x8Hs_3Xq4kb|Ha:&evz?{#UB.@e406vx`');
define('AUTH_SALT',        '{AZ|Nn_2Dga)X<JoLCj f9bZ>^{%PJ;$%)Ld0@R5#!KP=1@nt*e}@muTvDG&wS$1');
define('SECURE_AUTH_SALT', ';O3fKWzN6mB!QNh)c;HK#D/Ls#$i*{D&w)`M5:bpi0ax;U=.[>#Sn* F&#P2wUrC');
define('LOGGED_IN_SALT',   ')OTAUGxnA.`y=`stGl#}Za[-HFA{&!nD)Edw?qJOK..IyA=!si65J~kK)rT)t/.I');
define('NONCE_SALT',       'UY*2@lp[9m[<[`~z/zrj5xm>I`-UvR**sU6&j>0hIo!agwm(`51Q**A1[J{<*~3h');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
