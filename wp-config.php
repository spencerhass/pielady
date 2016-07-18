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
define('DB_NAME', 'pielady');

/** MySQL database username */
define('DB_USER', 'wp');

/** MySQL database password */
define('DB_PASSWORD', 'wp');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'd3bP,MP:L`rzXdMs-xop{jh&d5@U)S*go(/6R<k6D Rd)kO?9Nh%^{w#9iBv710 ');
define('SECURE_AUTH_KEY',  'yzQKTwco8mroq ~q@k<aREES{^La.j3Hw<SBPwo<x`0R6y7lprCF[wP_cJEtIAuc');
define('LOGGED_IN_KEY',    'mZ-2|6+8X1i=vS<AN`VhIPS.O!hPYSI01Q*AvO?!/l>ZFs *uv6yu8Dy @gNi.8X');
define('NONCE_KEY',        '-#Ip2Thp@RPYWCr|CX4~0;<[.da7:@oKjiB9;d3x/~i-IPU&oZ,n4dnYL&apgetI');
define('AUTH_SALT',        'vJdza,?D+0LwyRjwww:0t(yg!<,4mSRTG2/_*8`I0sk@B34UkN:%g5kNnNAv%H+4');
define('SECURE_AUTH_SALT', '3M^b(X}^;?,kL8Rto#(+9DdI1pHM/f*w4lr|Z`?8^HWl?JPcY<#Uf#$+af+o#@;p');
define('LOGGED_IN_SALT',   'qOXPnP+q$4,x_-I.Z/A2$jqS&dfRunnO7x(M7/3Vu[DYWo5XTCNc7|F86?Dmd05)');
define('NONCE_SALT',       '5=.wbl]504!c$Cx$$yM)Rh>:>~AgZNV(KT|l.Djm2k7zcmwFP=p*Dg7Nc&1!lY!a');

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
