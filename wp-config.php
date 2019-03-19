<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('DB_NAME', 'wordpressquyetbq');
define('DB_NAME', 'hoaphuongfood');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '123456a@');

/** MySQL hostname */
define('DB_HOST', '45.119.213.172');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');


define('FSMETHOD', 'direct');
define('FS_METHOD','direct');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'R119yJSl6@3-rX!6$U(K.tqueAYfd)ASo^Kc!Lx$w+%Ta_-:VqK*F^g;H4lK}ad=');
define('SECURE_AUTH_KEY',  '>g:)AY._+y?N -GxsM!l6Qt;84}3!#~{L6::t6_.WdiERnu;e8o*8D9nR$r`D[.@');
define('LOGGED_IN_KEY',    '3oo|$J3f]u.^Vz(iQK&13>fb5cMU.qKx|PkR[5E{p@px%[bveN#yw#[C# Ul@y-n');
define('NONCE_KEY',        '*2m/!x9oh,P:?y%l(9*i/GM&9E|@P_TDqDF1ER8flNXRwb<j.G~kOeU$DC)L%!52');
define('AUTH_SALT',        'a$M3h)eTu]K3kOoX-t$Zq;5rabREBQcns:m!T#gk8T}_Yn,|?jcRdo4W29%5D5n#');
define('SECURE_AUTH_SALT', 'qta,XH:O]3h}tf!Apuk1@_h~=m[7&_C<yawN&BE;Ai0BE:# J=/%=mA^mVvPFq,T');
define('LOGGED_IN_SALT',   '-~{o9Oq./o+(V8U9]^/PIxg`N>[i:z.[0@/D@$9bl9ZQB`:HP#r94Qnt?+MjO0f?');
define('NONCE_SALT',       'C/`4;AP!Z%ZW,/~J~|GYFm3SBplAiv@c0<`jY(/ETq=H9wQ*RJa`*esHspNF%o;u');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
