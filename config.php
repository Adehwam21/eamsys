<?php
define('CURRENCY', '$');
define('WEB_URL', 'http://localhost/manu/apartment/');
define('ROOT_PATH', 'C:/xampp/htdocs/manu/apartment/');

define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'ams_db');

$connect = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (!$connect) {
    die('Database connection failed: ' . mysqli_connect_error());
}
