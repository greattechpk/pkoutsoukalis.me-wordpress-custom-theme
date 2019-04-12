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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define('AUTH_KEY',         'uDoUV2xiDrWSNugV0sqVsGmm0PqxWsDE9MeQJX0olC7BE+B+9bRWdUZs+8LjpdeOEZrZdg/KQgBLoYIrLGN8Lw==');
define('SECURE_AUTH_KEY',  'wHH84lYfwKNQElAT6bCi9FV2+3qQylhwxuEDa+Fe+8VLRsSMuuBbQRjgXFlOUEyDt8VmyJ2rZyLkow3/N/mCEw==');
define('LOGGED_IN_KEY',    'xT3l0ULW1WPA0hGJ4wNVpzBhRh+uj55HfEdyAL1fsiwCenYq2fIbVkeN4HUgFoBF3EArBfqQLj0WT73jwS8saA==');
define('NONCE_KEY',        'VqnDqaFJJVd6Bzq11itzuuiy6Wey/ZKAi05pG8LBSaiPM73pRwu+nmiB8CWrgv4Zou1pSQvMMh5RiXXOhG3Hng==');
define('AUTH_SALT',        'njJN0OmQGHGDrkF4zPZCPjJo91XwoXxU+xiI4DCaj9UN9ko3irBzR3l/a573KD+FJ4QO4OtC+bYi4o1Ba5WttA==');
define('SECURE_AUTH_SALT', 'eRUNwfbaSdy/hxCw7lfluvnm1xbu8Nqmx2KbnKHa9Et967Z6v2ruYcHwtf1m5+Z8QVjUF0BJuHF3hCkGu3UibA==');
define('LOGGED_IN_SALT',   'XlfbhRuRbH1vwGyy25QpAAJc5t6q2JUYsv2nsDthZEnxXuIIeLl12SmypMQn5XUDX5cSBOnEGfn6aibH/R+v7Q==');
define('NONCE_SALT',       'ZJcGM2ChyBKcdAvnqko2ajvBweAq0o7OcDSEnihFoX1JDfbiWdCSXIU7R2sDKuqOiRCK8rq50XpRhasiy7c4JA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
