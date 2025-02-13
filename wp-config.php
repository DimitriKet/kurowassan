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

define( 'DB_NAME', 'kurowassan' );


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

define( 'AUTH_KEY',         '/!V3u[4#LM<AU_-(i,UF@kk1sf$ae1Np=j!k5n<R).I%Y;Tc#>|kCjAHCh^R>/zK' );

define( 'SECURE_AUTH_KEY',  ';8AZ/A/Lx9I^X2m8@,eB]*^ZZA:=#a63_Za$8cT@~AWMRhycoiz=~ZUs$R?dJ&BY' );

define( 'LOGGED_IN_KEY',    '.?sBUtyZ}r6~LhMA.,.BZsa5_]fW0m}sD0To|dD1-?VJ8DhW_ vSO{/S(jN}ZcXZ' );

define( 'NONCE_KEY',        'fae9iL<D[v>y4axr0p!58R_.1<dh^J+;Knc5pR)/h(!;r+YQS8#zOgP0tq[;Pogl' );

define( 'AUTH_SALT',        'hzj_AI!O4{K7;UnVyATAXZ0{;@12l|,=nkT^L+h#=RF$[FLd3wHyQ[2Q:2Zty`AG' );

define( 'SECURE_AUTH_SALT', 'XPl;:h)Y((V67wAV>T*)nFzUi/)JreL{CW`LG[#7[IXQ|cu_Hs1po,IrouYQhJ=R' );

define( 'LOGGED_IN_SALT',   'u}2qnjG<asO{-:C]uN-xW9 Wk[.Ai7fps]XiSFJ@<{0Lz~%UOwl>n@:g3_wR.F(r' );

define( 'NONCE_SALT',       '=f#h0#tuv9lpI&61sv[dR]v=9bQ5[7Y~nzj0uMBe}/t4-$ )W#Lji 57MP##KLg$' );


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

 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/

 */

/* Add any custom values between this line and the "stop editing" line. */




define( 'WP_DEBUG_LOG', false );
define( 'SCRIPT_DEBUG', false );
define( 'SAVEQUERIES', false );
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_DISPLAY', false );

/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

