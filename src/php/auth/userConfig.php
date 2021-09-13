<?php
define('DB_SERVER', '34.66.20.96');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'eddiecollege');
define('DB_NAME', 'userInfo');
 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>