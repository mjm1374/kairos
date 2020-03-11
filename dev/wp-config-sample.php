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
define( 'DB_NAME', 'kairos_web' );

/** MySQL database username */
define( 'DB_USER', 'kairos' );

/** MySQL database password */
define( 'DB_PASSWORD', '"~((K`YfKJ5}VRS[@CV~xw*xedh"{y' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         '7-x#Q#LFZ?v[wRv*aC[693IrDnl||k6S?=-L7P++VvNcgI_/|}xdwzQ5W7!zMI3_');
define('SECURE_AUTH_KEY',  'OF|&E^Gu`$W8uEmlpfKay|Fa_>:f85GjqR?<d<{]C+tqv=x#EUlZW5~2v-DW!}T9');
define('LOGGED_IN_KEY',    'QTZ[<~4(hrDQ`2{)U{`/8}.jZ-KN}cP<k.n1Uz DaMh1}ZFqS[,Q6#yo6vHJQ$+O');
define('NONCE_KEY',        'Mn,{=VT-$uIbP)x+1pdyMqLy&P}$$W#1Dh@^(Ih:;g6fDws9V|&|rM{zj)Ykv*Hz');
define('AUTH_SALT',        'n7WOP N4[u{M3<y)v{GCC+1@H}s.z)]a;fGI[tRyx 2YyU$|cfN^(i!Qz/ $dKa6');
define('SECURE_AUTH_SALT', 'UqUmgj%sM/#{Zl9!p> 6f(|GlN;9E0-etT9n)^K7$}ar|1`E/SbHU8hQK|YF#PK-');
define('LOGGED_IN_SALT',   '3XnXO3:fwc %5(T)7DYt3^N *:B--fafL+{$1C-!s5L&Y1=i<K;5JFB-+CCxm8G^');
define('NONCE_SALT',       'ix|EN;fSQ%4>=zcF]5`)mT,<f80:w@)|{ljYrq,-T-l.pjxt?-%:m;9|]71lmQn[');

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
