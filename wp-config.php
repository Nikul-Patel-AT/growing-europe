<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'growing-europe' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'o$>]V[]!dfS2Jrb4Oz7ABzq$e1Emp]aqYo8#|Z%?TU#KxjwcD0BlI`[HUZ=bJwtx' );
define( 'SECURE_AUTH_KEY',  '*#R0$Oc!9a4g7R>{R-+rk@rLSqK9!>:(259U&=>Aun&cii{~NAost6Pm?q6vZXY5' );
define( 'LOGGED_IN_KEY',    'LfHqDTh=Prpugw-3}x:2Yg^sIlhO!D2U0n0^aZGzf& ta#f[Zw>?0a%G&QtZX5i!' );
define( 'NONCE_KEY',        '^cs{TY)3l{f=wqR:7_SX8tT(CZo%zmys4 :R=nc#10~Hm7PMfhy;7~{~[VTCxt) ' );
define( 'AUTH_SALT',        'n%(yc*.@D18B~bA(Fo1znBr!$$wnc=1T5En94Zkfc2rlwTiODSf?gn+Iu6Da~}^.' );
define( 'SECURE_AUTH_SALT', 'yDP4_&2~mnh:t5=-j4Mnz*j{cGJ<?Q-ICw=FDMm5I^SxHO 3u~cv7%EV%G]/aP#@' );
define( 'LOGGED_IN_SALT',   'S#T>u![^3J5<k<[h;)w}XW+bw8*eD7JG:Nmz:3/VjqZtdi@zMN5e0C>j1 7[!G[2' );
define( 'NONCE_SALT',       '{2.lO -%FV`mhxrUoG}2/J4[m~1K-%iW&./P>0%EzLQo!Qno8iL$;-(oM=n9eCc[' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
