<?php
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

/** Absolute path to files directory containing the wordpress folder */
$domain_dir = dirname(__FILE__);

// ** Check to see if a local config file exists ** //
if ( file_exists( $domain_dir . '/local-config.php') ) {

    /** If it does exist, then use it */
    include( $domain_dir . '/local-config.php');

    /** Environment variable */
    define('WP_ENV', 'local');

    /* For developers: WordPress debugging mode. */
    define('WP_DEBUG', true);

}

else if ( file_exists( $domain_dir . '/staging-config.php') ) {

    /** If it does exist, then use it */
    include( $domain_dir . '/staging-config.php');

    /** Environment variable */
    define('WP_ENV', 'staging');

    /* For developers: WordPress debugging mode. */
    define('WP_DEBUG', false);

}

else {

    // ** MySQL settings - You can get this info from your web host ** //

    /** Environment variable */
    define('WP_ENV', 'production');

    /** The name of the database for WordPress */
    define('DB_NAME', '');

    /** MySQL database username */
    define('DB_USER', '');

    /** MySQL database password */
    define('DB_PASSWORD', '');

    /** MySQL hostname */
    define('DB_HOST', '');

    //** Set the custom content structure */
    /** Server name (your url) */
    $domain_name = 'http://localwhistler.com';

    /** Uploads directory */
    define('UPLOADS', '../content/uploads');

    /* For developers: WordPress debugging mode. */
    define('WP_DEBUG', false);

}

define('WP_SITEURL', $domain_name . '/wp');
define('WP_HOME', $domain_name);
define('WP_CONTENT_URL', $domain_name . '/content');
define('WP_CONTENT_DIR', $domain_dir . '/content');


/** Set the database table prefix */
$table_prefix  = 'wp_';

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** WordPress Localized Language, defaults to English. */
define('WPLANG', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '9(Q10-9+a;19$+i#!y}vMooUV]7>d%z$wN7qIh1.wg#MO4^{cA4YOeY=9~;B%-#6');
define('SECURE_AUTH_KEY',  '}pfj1& jH5&%tfki7H+|nGAnmAs8|i,A^OEx5fR-UY)51qbl^-nq~mP-|hl|Ci-Z');
define('LOGGED_IN_KEY',    '8U>FM&^1KiMhdp|0HVfw!wATuo>5Vn:N+LGX]eU?pcVHMJ>sS<.Fcl&Tb+fB<|<s');
define('NONCE_KEY',        'qn66IKZ|x>T#x5Bm5T CR_Q>|zvy.roIg;FBTh!bq=gDtC6!%A=#qn+J,zr(E-nw');
define('AUTH_SALT',        'X^/Ys7};11?}yd3FK|Vw{nG:V`hvB}%52:9e5(Yndf%{>/.G+ZYI)3:KnMgQOcsc');
define('SECURE_AUTH_SALT', 'Y*y-|/hCoO{[F$LE(sI?I[})v]tkrj`m]9~A`j2+SSA<!KDn2s%PwI^R<$/FCPU_');
define('LOGGED_IN_SALT',   'OYUy[Bp|tE?-CRs~JX4-zksyJlAmpaDtVtD,3[-Hc.@bF(+H04c&WV*N4mx(uk>A');
define('NONCE_SALT',       'bm9D`Olx$HaC8v(4}pM?O=C,PV@ CmgcEBRG^}x?],zeK4{]Be$p]%29MuR.S^QB');

/**#@-*/

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

?>
