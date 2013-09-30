<?php 
// Local server settings

define('DB_NAME', 'boldnebraska_dev');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', '127.0.0.1');
 
// Overwrites the database to save keep editing the DB
define('WP_HOME','http://boldnebraska.dev');
define('WP_SITEURL','http://boldnebraska.dev');
 
// Turn on debug for local environment
define('WP_DEBUG', true);