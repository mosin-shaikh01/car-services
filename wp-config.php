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
define( 'DB_NAME', 'car_services' );

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
define( 'AUTH_KEY',         'tk>yH5G9WjjW><p)H%pr+FlYvpn=p6ID)C~l|h)0?o?`vyYRti&!S[w${]CU8l I' );
define( 'SECURE_AUTH_KEY',  'm-)xjI1|m~#XlX,O?f0`<&+5/On]om.&a8|xvr(z1c?lnHU`Ikf<$G(ht@Rx0^32' );
define( 'LOGGED_IN_KEY',    'fx/(J$-E?}@  -My<pC]A>wvfy4RAJ0u#?8a/hf#N:^+dubbO!/G,*vL4%#D&Ow}' );
define( 'NONCE_KEY',        ',^kT8ITp.>&nT31~{rUeBlj?K-rr=DnZu-Uz{5N0LTGPu7p$Ek0y[~%E8!f/&{cl' );
define( 'AUTH_SALT',        'dsBH.l8v-:W4{~bNrW|a4M09OJwyYjK1|!k&2>SF[_oC}O UL[@l:UN<f:-r584~' );
define( 'SECURE_AUTH_SALT', '8sLxHCkS|N(q;qw?I^fU_y)* !AbfXKA}9vH[2A<f9~5|@RJd=I%<&tJu$6:(h&]' );
define( 'LOGGED_IN_SALT',   '!,^3n;kBt0<!x0Kct?AIp+i/sT4GbTX||N9$T&?QF5,8/i15*ZAC)CS7tTpl(b1z' );
define( 'NONCE_SALT',       ']8OwrT_b,k70G~_0jfmyJdaW>NBggPw cE7|^fr6@C=k1.vejQ^L~;0*^P,(Beo-' );

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
