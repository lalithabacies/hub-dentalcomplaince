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
define('DB_NAME', 'hub-dentalcomplaince');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         ' [el][wc`#Y2.50j<{P|cUn708.eyjlg8:w6gt0IMx{68g>qRfy(UkVE@v)q%+KK');
define('SECURE_AUTH_KEY',  'u*8if@(nI^wR(EXegh+bb07B,8Y!QFcc50N)T]U&.4=;$;8.:R/V/F=B(bcMzWXg');
define('LOGGED_IN_KEY',    '42vYg4GF(t`Zd?_Jn!wYV56s95Jhaw9xp%mM{J9h^Y7up+]zX*%/,2`E=`c?@B]f');
define('NONCE_KEY',        '}(XocN~%j+:v3-XCrXbcxq)Npf(^`5>>8j?~:4o^bi[a?PugQ+K6!T][QGjvlgdB');
define('AUTH_SALT',        '?~U<F}Q3f]V=_Uaj_t0)fiq8tEP;VJ}/X_.{1@6A`IK,Ye[wRa=D6DlMU<>2M+^v');
define('SECURE_AUTH_SALT', '.VqRz/NeG:Hg+SV@}(3s?tx4H]8C{;F#gzXWc2bIf8b@Q+LoO9vxEWObG<aYPi![');
define('LOGGED_IN_SALT',   'yfSE_oQ!`#lj?^9P%TK#d(Nf{xr9Y.8.phW~CGTccX9{Uy]MVHUuQtV]a7S#ygl-');
define('NONCE_SALT',       '}te@En2nn*s9aEhyA0OZqxIuOSb9*GGJAm`^Y$K9u)e~U$:p#M_S$Zv;SW._r6Y{');

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
