<?php

// Use these settings on the local server
if ( file_exists( dirname( __FILE__ ) . '/wp-config-local.php' ) ) {
  include( dirname( __FILE__ ) . '/wp-config-local.php' );

// Otherwise use the below settings (on live server)
} else {

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'daoma_dev');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

}

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         's-&3}b|yp5s!{Usp1WrGU^2_&XjKsGavl5!Yzp9K3q(m3F~H}?(r1{k#U}C1wJew');
define('SECURE_AUTH_KEY',  'Z:~C}3g[z< E`-t!p3q&M-8,;e>QLu{xB-J2WILlWa!Kp-SMVTw*g[R.pV2zI5&i');
define('LOGGED_IN_KEY',    '?x4+]W{1))+-BA`{.rc3w$K 9jj!F*VDm`vHm5GU|y@ox=~3}w`_7zb~R7?x{UH%');
define('NONCE_KEY',        '-H=_yhR%kz8-ronnhNi~BV@UEbc)RG|}S*ovhCW|6pk.G;{fE&S>Dim,(b~kL(+#');
define('AUTH_SALT',        '-OCFPYO3};9-XNyE{_sKt.4QMLQQcsTtmaP|1>WMk.~HRXI20_K[6vRNa+f7Pj)D');
define('SECURE_AUTH_SALT', '[AW6+$6Tu8Tm>`SJoaM4*y2@n*H~zDB*;AB?#>#O?V3DCeHJA?+W}o$1sGg|i}q.');
define('LOGGED_IN_SALT',   '; s8a+N!+5Z_ZdEFudVBe-kq<_|B+[u>mt~h0GDmx7#A|m-%-JE9T4s%|ph#|!XC');
define('NONCE_SALT',       'hn!FDB18:d5@5zjhjSB78pXO<iE-T$4hRk&kZ}&UE %^ lL>WJ`bJN;5f4ZIy(gE');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'albion_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');