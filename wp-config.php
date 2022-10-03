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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         'W)-<ag),x;r9rKZTG7&v?#_2{5XtR|BPozzvMtat6l1=8hfrTuGbTl9|w! N@Z@8' );
define( 'SECURE_AUTH_KEY',  '@2TL(lsPCKTXYTNRJ^h3(:_9D?7M7hFPL(.ob&@0*HJA)8gc1V__m]&OJf1T% bo' );
define( 'LOGGED_IN_KEY',    'T3O9}]J=-{i;XEgL{!-dAyMNSw`/3YU7fEm.|F%uy[;p{]7;+kv!K-1tMIM/@:$*' );
define( 'NONCE_KEY',        '2VK=Cm%1rsP^E06aT%LJKp].Gc+.XihBYQ6PY{t>L;GP(l`f$I~YcvHx.c27,(wX' );
define( 'AUTH_SALT',        '4bcz)!j9qm9$<VX2+gZsSHSUjyMt9!.RG+Sx8)d46Q>lJO`7yyop4Sia%*T?HZ%N' );
define( 'SECURE_AUTH_SALT', 'aPti~?+I>_Mcli.zPhmaExvxLh,.qUwuWgv)]Nvo+Dk@*{$.r+uZ:)g%zDPdg;A@' );
define( 'LOGGED_IN_SALT',   'UkcR81bI&~T0#Yp&9LGDcjNTH xa/.|YI@`oeN>aD,r1ddn1_<qtFhw+{(g/@fCj' );
define( 'NONCE_SALT',       ',Q.lEZMG s<~fm]jlIo2FE[R8N3p=<4D9@w~W:Ij$ #ZfEo+qJV( YF~q@$0[L6H' );

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
