<?php

session_start();

$mysqli = new mysqli('34.66.20.96', 'root', 'database password', 'userInfo') or die(mysqli_error($mysqli));


$user = "John Smith";

if (isset($_POST['addTask'])){
    // $user=$_SESSION['staffid'];
    $task = $_POST['task'];
    $mysqli->query("INSERT INTO currenTask (task, user) VALUES('$task', '$user')") or die($mysqli->error);    
    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM currenTask WHERE id='$id'") or die($mysqli->error());


    
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    
    header("location: index.php");
}