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

if (!file_exists($composer = dirname(__DIR__) . '/vendor/autoload.php')) {
	die('Autoloader not found. Run <code>composer install</code>.');
}
require_once $composer;

$env = require_once dirname(__DIR__) . '/.env.local.php';

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', $env['WORDPRESS_DB_NAME'] );

/** MySQL database username */
define( 'DB_USER', $env['WORDPRESS_DB_USER']);

/** MySQL database password */
define( 'DB_PASSWORD', $env['WORDPRESS_DB_PASSWORD'] );

/** MySQL hostname */
define( 'DB_HOST', $env['WORDPRESS_DB_HOST'] );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
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
define( 'AUTH_KEY',          $env['AUTH_KEY']  );
define( 'SECURE_AUTH_KEY',   $env['SECURE_AUTH_KEY']  );
define( 'LOGGED_IN_KEY',     $env['LOGGED_IN_KEY']  );
define( 'NONCE_KEY',         $env['NONCE_KEY']  );
define( 'AUTH_SALT',         $env['AUTH_SALT']  );
define( 'SECURE_AUTH_SALT',  $env['SECURE_AUTH_SALT']  );
define( 'LOGGED_IN_SALT',    $env['LOGGED_IN_SALT']  );
define( 'NONCE_SALT',        $env['NONCE_SALT']  );

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = $env['WORDPRESS_TABLE_PREFIX'];

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
define( 'WP_DEBUG', filter_var($env['WORDPRESS_DEBUG'], FILTER_VALIDATE_BOOLEAN) );
define( 'WP_CONTENT_DIR', dirname(__FILE__) ."/wp-content" );
define( 'WP_CONTENT_URL', $env['PUBLIC_URL'] . '/wp-content' );
define( 'DISALLOW_FILE_MODS', filter_var($env['WORDPRESS_DISALLOW_FILE_MODS'], FILTER_VALIDATE_BOOLEAN) ); 
define( 'WP_HOME', $env['PUBLIC_URL'] );
define( 'WP_SITEURL', $env['PUBLIC_URL'] . '/wp' );
define( 'APP_ENV', $env['APP_ENV'] );
define( 'WP_MEMORY_LIMIT', '256M' );

/* Add any custom values between this line and the "stop editing" line. */

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/wp/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

