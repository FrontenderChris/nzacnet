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
define( 'DB_NAME', 'nzacnet.com' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'MC2.mysql' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '6^-<^33BiC(d~UoC*Eq5T%Y&aZD]sTgq,2hL:_&H&P}q vj_^PMR/_g]0opIj;F!' );
define( 'SECURE_AUTH_KEY',  '^5@L>t!RcUkztG~ NDbtY2,)Agqvod&Qao[1~I{4=xXg,D>x?.LT[tXaf ,l, |3' );
define( 'LOGGED_IN_KEY',    'r3]#mzjseOZ-S~{_q`2HW&m|FOT[uZ|n3bem?T~=J9bthC:RU%-NYIK*1~R,2.>W' );
define( 'NONCE_KEY',        'ATqigd}HuRWVo>Rw#;4x!wO@%&1x0?sl++a4E:A{>j[:Vk^:03v;Lb0!;-TU8@k+' );
define( 'AUTH_SALT',        '_kXO9ZYY83UPpOI(*E@ bq{Xf%+BZ[T`k5T2z;s+2S>!d4G{~(No44*T4}K`lex:' );
define( 'SECURE_AUTH_SALT', ' 79+]<=wz^u>(6%lk4V[(RU6Co29D!rJ.[n/c6 *B416?Koy3EwGgZdZ8CJAAtwc' );
define( 'LOGGED_IN_SALT',   'B;X2.K:xhN^^ZE)}SoHP:0F16MHVd^?`-:.3F1v~; U5Dr&,t<0uLtE#_yQUf8t&' );
define( 'NONCE_SALT',       '!Bh;}do?kAZ?PwG6Ff}ih5h@nW6{8c&eaQzL}0,vA>,$U1jaFMcsVQPP{K>U,yN(' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ac_';

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
define( 'WP_DEBUG', false );

/**
 * Locales
 */
define('WPLANG', 'zh_CN');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

define('WP_TEMP_DIR', ABSPATH.'wp-content/tmp');/* WordPress的临时目录。*/

define("FS_METHOD", "direct");

define("FS_CHMOD_DIR", 0777);

define("FS_CHMOD_FILE", 0777);

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
