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
define( 'DB_NAME', 'newscard' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         ']R3laFf5BR6Gr%tb@Zni#B=cC:Mw8fOH?$mz`zhkr?C]+8]m)69_XB`SE,mU@,!H' );
define( 'SECURE_AUTH_KEY',  'i]w<@Ev827ou~E|}h/d6PTh<d15CWUeYOl:%9@1Jt:+-6nFhA`+oY&iG~zIusfc$' );
define( 'LOGGED_IN_KEY',    'k|L1JJ`;,mm^~H.Z>r}mqOB4^N, 0tdtTNiN0pX.CR}|N;v4d{UPo0-q{23ep[H.' );
define( 'NONCE_KEY',        'd9p=!KUj4Pd}4a:4Q4QTH<c9y(Pyk~Qq71*i2oXBv1VAj?:|H#>$`We#(+n*&,@U' );
define( 'AUTH_SALT',        'MK6jCo;QMWB)}~C%6CEiF_#{J?xXk?=Qk<fVeT#3?cu.>7;0w,y,:o{:TN/LN>`H' );
define( 'SECURE_AUTH_SALT', '_<1N.=y@(wjm!]ssq/4fa$b1zI.[L??hu114[Dbkw#n{D/,XI6=k_PshCcG$$s9!' );
define( 'LOGGED_IN_SALT',   '4g{6 .JtT:~k:W<:*swZ]=a|{y0lc`Mqv44BT*-{+y[D>EvHIM|-<xomwdilb.]D' );
define( 'NONCE_SALT',       'Cqae}k0sfgQ.9ddxA/H8r(|=gZSpg$K~[>~ps_q*Lzyx#rj#oAEfjSKyK,eH=(,R' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'nc_';

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
define( 'automatic_updater_disabled', false );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
