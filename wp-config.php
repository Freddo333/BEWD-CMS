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
define( 'DB_NAME', 'dbs9vy3t5jxepb' );

/** MySQL database username */
define( 'DB_USER', 'u2ctwcta6ncrn' );

/** MySQL database password */
define( 'DB_PASSWORD', 'bgkj2rcse323' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'F2AJ/M;QkbK?t!oLI-MwJCmhbolEi[k]<R.HT^nqc3EJZe759bhiF[6mIgGsvEE6' );
define( 'SECURE_AUTH_KEY',   't1*cD%mH*cBuf;z>ELq` z;b?4L|Rb1v#2.99z,kgUAkt1p>]_g-O##2rSW[GUu<' );
define( 'LOGGED_IN_KEY',     'O>!gCzcKxn>=rj3|0qR/r^5kRqX($[bKPZT}1eT^F$R7?|innula*~h}%o,A|Rf.' );
define( 'NONCE_KEY',         'vx+OaT;KHMrdVW3Y0R9OM:L,NdU%X<ci$xS$l-oNTtQq73l6&p&-dy,94xFe{-Wf' );
define( 'AUTH_SALT',         '?g{wfYbD-F)b!LUexf1d=7;l~?:TkwHA_bSd5,}1teim@k/ZeUQ;W=Hr-,ES~)ui' );
define( 'SECURE_AUTH_SALT',  'hidfF%du^tHqtk{=LzGs*}p>ES,2u2 E+G$2`Z.03#WW]}9nk)E$_>ui5s~Ck?,4' );
define( 'LOGGED_IN_SALT',    '4?Mb:,{~I}YYfm]t6Nzl.%V%P%vlN/WQ@#H~?B9Vu1A^U=STHys.|1ImG`5aqj 5' );
define( 'NONCE_SALT',        'hiMhk*j>7`8@uM5UW8vR E+c(JA0tC/!uPaTX{<d+Q?w1qCrC+q.M<;%qxRA/uGa' );
define( 'WP_CACHE_KEY_SALT', 'Dd>vYLILJV|D-..GGU#,$dvS,:u.!x#@oS>*:Mn^~A_K+Cvvd{!q-nApb(Y/B+27' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'lkr_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
