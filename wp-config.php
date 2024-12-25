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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', '820904_d27f3dfabaf895aa9da0f07b34fbdbfd' );

/** Database username */
define( 'DB_USER', 'easywp_1257008' );

/** Database password */
define( 'DB_PASSWORD', 'p/JFP2xOF5OboNqSkpY6D36gdiQo6ijls+wlS7KwSac=' );

/** Database hostname */
define( 'DB_HOST', 'mysql-cluster-4-db-mysql-master.database.svc.cluster.local' );

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
define( 'AUTH_KEY',          'RxDI$G*nxmE{*_$EQm4k{*lz.3GK%+xEX{{*BFNoH d4rxYoc8{$8D?%Up~&&~|7' );
define( 'SECURE_AUTH_KEY',   'Er@N:@AX-N@3(E~Qbvs~}9<lq[k`:U#3.v/Y?DHwF>d*9/cVij`|T,=?STNPA%}p' );
define( 'LOGGED_IN_KEY',     '_;{(>T7t+N;;rbl?t:m EVVIZ{STQ-TX2gQHFkv1yW)F5T_Dn._!+r6$^O!C);Z<' );
define( 'NONCE_KEY',         '1?TnKOtd6|D/o&[wXe3zK*a~K/iBH;=;%qJ5$Ici}.2,k=}~/um(YN`7#)^3Yiy(' );
define( 'AUTH_SALT',         'E+~/&tCjR=YPW_0/Si!T H]IK`]Yw=a7jKYj+^Gw}V/YZ$.j;*37%m9.%fFS76$l' );
define( 'SECURE_AUTH_SALT',  '{{nO)NTg6V&GV[MnNz|D|Ezji2n|f]E7DgK_j@eTRq]jtcyEr)yAZ|XVUxWM8u]#' );
define( 'LOGGED_IN_SALT',    '3yG0!ajDYDwJ.TW%pNUD)$Gpx&<a6ws67DK|k&sW?aJ,+~Ay_Ayh~}D[)]OqzSm6' );
define( 'NONCE_SALT',        '7ojL~,Hei-WbMJWujMdd|*Rg-l*(M|)PSp}>h.zY8>Q)>87|hL~,x0i1YqH8h2rS' );
define( 'WP_CACHE_KEY_SALT', '62x@W1_`3ML9>P Fq{$l=j!gDW}L4]Yi72<y2V[4]V/:sQ -vz!lq{ N[wa[I`aF' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */

if(isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
  if (strpos( $_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
    $_SERVER['HTTPS']='on';
  }
};
define('WP_MEMORY_LIMIT','128M');
define('WP_MAX_MEMORY_LIMIT','256M');
define('FS_METHOD','direct');
define('AUTOSAVE_INTERVAL',160);
define('WP_POST_REVISIONS',5);


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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
