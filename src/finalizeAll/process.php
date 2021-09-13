<?php

session_start();

$mysqli = new mysqli('34.66.20.96', 'root', 'eddiecollege', 'userInfo') or die(mysqli_error($mysqli));


if (isset($_GET['finalizeAll'])){
    $mysqli->query("UPDATE list SET final='1'") or
            die($mysqli->error);

    
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "danger";
    
    header("location: index.php");
}

if (isset($_GET['unfinalizeAll'])){
    $mysqli->query("UPDATE list SET final='0'") or
            die($mysqli->error);

    
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "danger";
    
    header("location: index.php");
}