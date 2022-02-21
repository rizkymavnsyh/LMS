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

define( 'DB_NAME', "rizkymau_lms" );


/** MySQL database username */

define( 'DB_USER', "rizkymau_admin" );


/** MySQL database password */

define( 'DB_PASSWORD', "evosesport123" );


/** MySQL hostname */

define( 'DB_HOST', "localhost" );


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

define( 'AUTH_KEY',         '#e3[1]{mIPOG!_8N0X+HjWdfJSRCG[Z(cd]Q@B!}AOM}NG`wFczv#vaT.d;`|AI4' );

define( 'SECURE_AUTH_KEY',  ' ER/]iJO7>9%v~z g$N2E(uj~>Spck@JurdlBFI$!9E+U-h:?R^b[Eu}kEdp}Cz5' );

define( 'LOGGED_IN_KEY',    '2C{;z=J`e5e,2oD5c|H~)M;a_hSHS`&[.>0W#.!nlQX}*({DXX^j:6j@aV~PNfrT' );

define( 'NONCE_KEY',        '2X@-u$B/kxM~lcx(.53R37FKj8H+$hN{7-#*(DoHzzQ9p*1i6v(W,3V,P)(M-:e?' );

define( 'AUTH_SALT',        'DCM9OAp|/5JQ+gz|X}|*CR3H/7A|eJvzpCsv~jr=)]{PfuBd~,U,[5zzIhT$[8!7' );

define( 'SECURE_AUTH_SALT', '{R6{P)n. Vv8dTluOx%ylR/1glnUE6>}fm{GW@]2t]{7mcar+}z/_dg/4TU@^w(Y' );

define( 'LOGGED_IN_SALT',   '28Lfa-4N&t68De) qXnw%j>|T=n5c:#V53|}I#7R&_4?F@v:_E s;XxH-_ZZCq#e' );

define( 'NONCE_SALT',       'HvaRlOMo/rb~MhY  ^UNSzMV;;}`/Up!+=*bG;d*Iz^$IH$CS`xFPuLKEVjjMGtg' );


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

