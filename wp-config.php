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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root123456');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '&ixLK<JXZFB!y0c4a.^ `$VP!`R/-y|I6-E~DW[zmT0Rk+xZuITt#b5}]nly:#Pb');
define('SECURE_AUTH_KEY',  ',^OHSebtgxX{Q@ P[JW$$L5|NBmH3_VJ!,p/;[AE:woMMhrxavKrLo%5M7I&By J');
define('LOGGED_IN_KEY',    'p L!+zhIf&?ZVY)T]e3h8ofmj6q:TjqCxqZeYW;YS@W&o^G|GDmXj7N8~}Ul^he:');
define('NONCE_KEY',        '?@|E)Qg!&1m,d==:Aw+ht%hI@4W2`7%W( j8Z4PmG^hiYS-=Z,PTW;XzG96Ci*p$');
define('AUTH_SALT',        'RM<IKZROAdnliU);I8pNeQ+xnQ_uDKObhaqcA-i&QmRlUNQKM( |%9Xt1Bl)$QZP');
define('SECURE_AUTH_SALT', 'D8ezq/k;7[)/MmW#{$csN*`!mx^,p!I%TJWC=_;6?Qdr,EF<iL9pYk+VZG|C:3#k');
define('LOGGED_IN_SALT',   'XGC3osWmcJt#8/x[KrkIUih=|4j(P(j[vyz7hq~Y:itT^t +*D>k/Tp}Q+nCDtST');
define('NONCE_SALT',       'd@%1Ps{^%~%Z:C8vECD`J3 e7 bV&$-aK.A6V7$hkSj{sGQ$<nL=`aYQY=oWrzqo');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

