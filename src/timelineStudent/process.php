<?php

session_start();

$mysqli = new mysqli('34.66.20.96', 'root', 'eddiecollege', 'userInfo') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$milestone = '';
$staff = '';
$deadline = 0;
$status = '';
$userid = $_SESSION['userid'];


if (isset($_POST['save'])){
    $milestone = $_POST['milestone'];
    //$staff = $_POST['staff'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];
    
    $mysqli->query("INSERT INTO timeline (milestone, staff, deadline, status, user) VALUES('$milestone', '$staff', '$deadline', '$status', '$userid')") or
            die($mysqli->error);
        
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
    
    header("location: index.php");
    
}


if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM timeline WHERE id=$id") or die($mysqli->error());
    
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    
    header("location: index.php");
}


if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM timeline WHERE id=$id") or die($mysqli->error());
    if (count($result)==1){
        $row = $result->fetch_array();
        $milestone = $row['milestone'];
        //$staff = $row['staff'];
        $deadline = $row['deadline'];
        $status = $row['status'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $milestone = $_POST['milestone'];
    //$staff = $_POST['staff'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];
    
    $mysqli->query("UPDATE timeline SET milestone='$milestone', staff='$staff', deadline='$deadline', status='$status' WHERE id=$id") or
            die($mysqli->error);
    
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
    
    header('location: index.php');
}

function dateConvert($deadline){
    if ($deadline == 5){
        echo "May";
    } elseif($deadline == 6){
        echo "June";
    } elseif($deadline == 7){
        echo "July";
    } elseif($deadline == 8){
        echo "August";
    } elseif($deadline == 9){
        echo "September 1st Part";
    } elseif($deadline == 9.5){
        echo "September 2nd Part";
    } elseif($deadline == 10){
        echo "October";
    } elseif($deadline == 11){
        echo "November 1st Part";
    } elseif($deadline == 11.5){
        echo "November 2nd Part";
    } elseif($deadline == 12){
        echo "December 1st Part";
    } elseif($deadline == 12.5){
        echo "December 2nd Part";
    } else {
        echo "";
    }
}

function badgeConvert($status){
    if($status == 'Incomplete'){
        echo "'badge badge-secondary'";
    } elseif($status == 'Complete'){
        echo "'badge badge-success'";
    } elseif($status == 'In Progress'){
        echo "'badge badge-primary'";
    } else{
        return;
    }
}