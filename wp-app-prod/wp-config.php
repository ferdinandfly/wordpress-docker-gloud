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
define('DB_NAME', 'wordpress_prod');
/** MySQL database username */
define('DB_USER', 'root');
/** MySQL database password */
define('DB_PASSWORD', 'N5gc78HJzuqCmaf8');
/** MySQL hostname */
define('DB_HOST', 'db');
/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');
/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

// Forcer le HTTPS dans l'administration
define('FORCE_SSL_ADMIN', true);
define('DISABLE_WP_CRON', 'true');
/**#@+
* Authentication Unique Keys and Salts.
*
* Change these to different unique phrases!
* You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
* You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
*
* @since 2.6.0
*/
define('AUTH_KEY',         '<kUH0Yd71`nFduB;|c;)nLYB>d}4OA5Ke^py6F*|wLxk=XaDu4>?zf[,@XbV981{');
define('SECURE_AUTH_KEY',  'e;+.~:068bItGySDvy$C_X<1egn1U1CMHsQyN.%Q]sT)2%>*B3e/N/AQr3~)ekJr');
define('LOGGED_IN_KEY',    '3m)5,^.uDYaR80N=@)cQi$rZA$O,KxX,sj]-9Q.8#`{A;DsTNz6j,iP5&^zo4VQ#');
define('NONCE_KEY',        '4+qk*=iC&I]!@!f]J[R<|I:A2kYgC;(On3s9CPS>;vPLIDvHMS~H,s%%&Bf1>b*0');
define('AUTH_SALT',        '-e|8I|^O2Bq_o++Q=z_(Vbv)3}w.jpYi2`tzM%_ZS![^7>Y7TYX!~rdr=K]87nu;');
define('SECURE_AUTH_SALT', 'mG=!s?<)6IaJG+ZbK#+N=5Gbq+Vl+hAmVtp_iJ#/TY6P- C@+8e4o9,WM3Az3h.n');
define('LOGGED_IN_SALT',   '9oS[<P!{qT,Nul];Pb/=;w:zn?z4,ktTpI7>QHg/}c$` q)CX[KynJE9+NuBDyaJ');
define('NONCE_SALT',       'Ks6$(e#RhJqa@f1gDm_mxTzGJjzFxzb1aiW9Ir%U8fM&FcjwM~.fC%N{u>dpXw)_');
/**#@-*/
/**
* WordPress Database Table prefix.
*
* You can have multiple installations in one database if you give each
* a unique prefix. Only numbers, letters, and underscores please!
*/
$table_prefix  = 'wpard_';
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
define( 'WP_MEMORY_LIMIT', '64M' );
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY',true);
define('AUTOSAVE_INTERVAL', 300);
define('WP_POST_REVISIONS', 2);
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
