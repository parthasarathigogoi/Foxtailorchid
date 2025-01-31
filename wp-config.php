<?php
define( 'WP_CACHE', true );
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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u938740381_ezgLt' );

/** Database username */
define( 'DB_USER', 'u938740381_prxqc' );

/** Database password */
define( 'DB_PASSWORD', 'ZGpG4R5sPk' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'gl#J^m8 &IkM?lJxeMB^]49]n,t_[OV[dbtOWxO(O 5V^=za,UP(hFluo%Pt$$jy' );
define( 'SECURE_AUTH_KEY',   'T,<p-ZoD(n+nCj(L!1QqO]vH`Y*JdZJ*:k;Q2v>>:hn@D_+.U^ZwZz<cOo @c)Wk' );
define( 'LOGGED_IN_KEY',     '7f!sA-fYPJ:KmDY{xLO}Wgc4Xh!!7 k-9j&_~PNh&In^=TwMlXv~ d=Ip~6r5%nE' );
define( 'NONCE_KEY',         ']f$aVSZjVoDabhS_mHi3ZIzpgCbjF!4V:[x|TS)m~(hA~L2 /_&AwQ*?zz2<9Ggu' );
define( 'AUTH_SALT',         'yGE[1c3.* WeW/Xk`/cR?xDZ+>~[i=SdWaE!,3IM6P$?*&oZQ7`j2+0P`S1~@@vP' );
define( 'SECURE_AUTH_SALT',  'y!WK)8[&SvI((B[pI>T`BQcW{yypA0#Nt4Uen8!%t&oqk7,FB$lE#!j>MD??5$a)' );
define( 'LOGGED_IN_SALT',    '.RHj [W+r2Ltpis^ q9;<QL(7GP:PCXTG>JU>yDH;3~7vULT-?*%Db$kF2<<+*ZE' );
define( 'NONCE_SALT',        'IR;J&<gRU?SI=&p?Dhz)dm(4`REk.|E&D]HLCbB>jyKQUX276j)$4,hv6TL<xa0d' );
define( 'WP_CACHE_KEY_SALT', '(661sc{lwod9mh)Q,&IU9g5y/K&j`JLlIQMYW6!tV.bbZt$~U;Zit)9$yRI1a$Dc' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
