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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'blog' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '){)va1*(Brj]MA|^ia&:gBDfa=5~/KH%WI2ao:=H2+xeQ]uYOdog$@s1*/ 44Z^g' );
define( 'SECURE_AUTH_KEY',  'r?v1X3VP0|chxy-qqFQpZv2l$v2kaO%:7i]K)3|*1~rs*SHLD(5)WfhwO6BU7?JD' );
define( 'LOGGED_IN_KEY',    '$.>3NZn4T0aIX(,n)I+s`I:S2 3`hJ>-oMY&~jbjkYH(W;EJ1o(uzeku*>0kNoBH' );
define( 'NONCE_KEY',        'M wVRLQ6%b8VPtDSV{M/$X*(jA!2XNc6?~n3{/H$]K[YTbo42SkX>]b:$.@0@^})' );
define( 'AUTH_SALT',        'RG2h++j)AL`u8!+)5;MS@L}{SyB-|_I+kXg`3|7s5Ld& n$%HWz{P8>_.1?vD5^.' );
define( 'SECURE_AUTH_SALT', 'nsfWXR~2;hXTm Z/B0.9m&?PxHur118++fnjta 2kzl7nS`I5Uze54jkJ#cNSz/Y' );
define( 'LOGGED_IN_SALT',   'z`a>5.O0U`@ku,Ek|l&K$l$MLGhj_O.B}n#5==]iSN2U,)hL*:Hdfq?[! _s3-x#' );
define( 'NONCE_SALT',       'gg-@TDQolYVo1qE7/^_~F<e*^ghm2GH2:6 b;NMhbN}SrT )X b(ZQAc~qq,CH T' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
