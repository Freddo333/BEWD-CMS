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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '@@G2flH*,Xvx;Rgpu-%B9Rpc~ZftZJX>dgt*/h`!%M)[4%;V~W6)9Cr{pPnZDpn*' );
define( 'SECURE_AUTH_KEY',  '27y,TAF<Gn1Dpa2+2DmM*&5N~lW~VN{G $sm%|D;BF!X39661VfDUJ08$e%DA+CK' );
define( 'LOGGED_IN_KEY',    'cNT`}tlw0=eR8Ar+z0/^c(.qPdm SC{jMmQ8)z@>yF9CT%8Vs[VXD A#f;lS(b:H' );
define( 'NONCE_KEY',        '/(]uj}7F3#3us-tOWh7NP`,WvQmj5<T6I$f[pS`Xo@6H@Lt(7])4%tr4cl_4W{8M' );
define( 'AUTH_SALT',        'v]cw8KY*C- V.-:~kes/KOA]#KBwuq$Q-FAGJS#oRq,R+OYGw0x)4wn*u,,xag[ ' );
define( 'SECURE_AUTH_SALT', '$>@8)b,Et$:@SMt !.>NqR`q%[Jxs6z_j|c#zP8$i8mM[Exc)G{:Jn`Y%lk[w5pz' );
define( 'LOGGED_IN_SALT',   'RtHsc24]ufMXj${,;kCW~gmAEd1T+Y=t&+[rZi?B4(389wfNha^71t94ot3CcT. ' );
define( 'NONCE_SALT',       '!2^ka5.iMkXt+X(xc#w`EJ3pDDJg2j]J#jP$^4ZUjta5iP;>wq.==YH-L2RGC;1X' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
