<?php

ini_set('display_errors','off');

define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost');
define('DB_NAME', '24h');



include_once('includes/class_database.php');
include_once('includes/class_user.php');
include_once('includes/class_users.php');
include_once('includes/utils_user.php');


session_start();