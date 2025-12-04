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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'U*1b[$B3{pG mo5Z;2;E(UIZNF99t3+V%qNz=>DQdGb$Uyo;E{fK{g7V^o9GilWP' );
define( 'SECURE_AUTH_KEY',   'Kp&`lP#W|]`loePO|Ig X^aFr]/O[NTtXFlddI/xG--:$~[4:2wO]=<:}>>jIqFl' );
define( 'LOGGED_IN_KEY',     'llt2}PsnxBr5QYiLaV/_jv-es+SgexqF$/fC}!O1!@^[TLlqB>Zx=28(I@2272]v' );
define( 'NONCE_KEY',         'YT[VZP*A]: P`}%u|@Fi1S2cduh<SK7e]DVuTm.sOPSxydRFn{_,uNkp~p[%HOkp' );
define( 'AUTH_SALT',         '%[`J0?6wQ~Dew3HS(-4DTj6N<|h5{O*]coLD]Jl7) b|;]ITbG8g=oVxNK2y@}d3' );
define( 'SECURE_AUTH_SALT',  'v%>e:xLO&7oaGRt?}Y21d8Enxj*nOos!Z:3pUiN$l]nt$/6(@0O8MVZVasshyfQn' );
define( 'LOGGED_IN_SALT',    'V.1>(x_9[qG;7!?bg]%{(4X*VueDd:_7o-tg7TEr6:&<)WCfh1@g {C7N#,E1S({' );
define( 'NONCE_SALT',        'wJRt`UC|2tkOPUIt(-.USqB{a(.3/hr++A1qG,PpgYbIxs+po0uPG7b,E@t(L`l,' );
define( 'WP_CACHE_KEY_SALT', 'i4;L{-)B|AOvU(myKC>SnoXwf?Bo{IhnBfmV$$$i}&/_6z.b4s}n~OQhL~ZNx%tI' );


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
define( 'WP_DEBUG_LOG', true );       // /wp-content/debug.log に保存
define( 'WP_DEBUG_DISPLAY', true );  // 画面には表示しない（本番安全）
define( 'WP_DEBUG', true );
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
