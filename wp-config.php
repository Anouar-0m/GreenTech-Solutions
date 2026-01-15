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
define( 'DB_NAME', 'wordpress_b1dev' );

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
define( 'AUTH_KEY',         'n()%T&l+!UA^$`:m(G#12mfI,+kiCf*vS11ac#^Ag#2k15F@iZ:Qiy~tD)jYXVi>' );
define( 'SECURE_AUTH_KEY',  '$^|!D X#,iuGu6gluiW%;V@mP^jIr|MT{,4x(gz*M+oxnoN*2mHO2/ <TJ(xAQtS' );
define( 'LOGGED_IN_KEY',    'Wq~WmyGLcpnM#w,i&{]-+7Y[+ +fb/f[GAL`L6Zl1:PZgs?+o:}Q7kR.~)PN9v.5' );
define( 'NONCE_KEY',        'HTO#g,aweJT_Dn3iU48j qt[st&sbq9p?{4W[fy6i29/>ZEvnn=qv+Ri>yYq=,^h' );
define( 'AUTH_SALT',        '7M))n@RGB)T?OqY`GV%,97$jv}gido*; )3k9/dv6}ovbd5n2xuZ[NkLG,L}tlXN' );
define( 'SECURE_AUTH_SALT', '[:cy/DnwUz>IYf~(UlX,|FJ|8<kh2YW?b3cMOCx%%Z!=l{)hY8O,a&Rgz(5?GMY-' );
define( 'LOGGED_IN_SALT',   '6k)3$$aGyLzt{w4:lW:@oE1Zsf`2*})4MH 4<NyvfoJq#{u)n`1{?|TuM>UC;OjL' );
define( 'NONCE_SALT',       'e~x2TZRtxQQ8 /(r<zv+BX(DuukA( V_cL:fmHgwAs?XUID=*rzFGeZiR38`f=+d' );

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
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
//desactivee l editeur de fichier dans le backoffice
define( "DISALLOW_FILE_EDIT", false );
//limite le nombre de revisions a 5 
//define( "WP_POST_REVISIONS", 5 );
//sous-domaine :
//define( 'WP_HOME', 'https://localhost/wordpress' );
//define( 'WP_SITEURL', 'https://localhost/wordpress' );

//forcer le certificat SSL pour le login et l'admin 
//define( 'FORCE_SSL_ADMIN', true );
//definir une memoire plus eleve
define('WP_MEMORY_LIMIT', '256m'); //pour le front
define('WP_MAX_MEMORY_LIMIT', '512m'); //pour le back

//cacher les mises a jour de wordpress

//ameliorer le cache des objets 
define('WP_CACHE', true);




/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
