<?php

session_start();

$mysqli = new mysqli('34.66.20.96', 'root', 'database password', 'userInfo') or die(mysqli_error($mysqli));


$fi=0;
$id = 0;
$school = '';
$state = '';
$rank = 0;
$erank = 0;
$selecti = '';
$major = '';
$decision = '';
$final = 0;
$userid = $_SESSION['userid'];
$check = 0;


if (isset($_GET['filter'])){
    $fi = $_GET['filter'];
}

if (isset($_POST['save'])){
    $school = $_POST['school'];
    $state = $_POST['state'];
    $rank = $_POST['rank'];
    $Erank = "0";
    $selecti = $_POST['selecti'];
    $major = $_POST['major'];
    $decision = $_POST['decision'];
    $check = $mysqli->query("SELECT * FROM list WHERE user='$userid' AND school='$school'");
    if($check->num_rows == 0){
        $mysqli->query("INSERT INTO list (school, state, rank, erank, selecti, major, decision, final, user) 
    VALUES('$school', '$state', '$rank', '$erank', '$selecti', '$major', '$decision', '$final', '$userid')") or
        die($mysqli->error);
    
    $_SESSION['message'] = "School has been added!";
    $_SESSION['msg_type'] = "success";

    } else{
        $_SESSION['message'] = "School has already been added!";
        $_SESSION['msg_type'] = "danger";
    }
    
    header("location: index.php");
    
}

if (isset($_GET['add'])){
    $id = $_GET['add'];
    if($id >= 1000){
        $result = $mysqli->query("SELECT * FROM libschoollist WHERE id=$id") or die($mysqli->error());
    } else{
        $result = $mysqli->query("SELECT * FROM schoollist WHERE id=$id") or die($mysqli->error());

    }    
    if (count($result)==1){
        $row = $result->fetch_array();
        $school = $row['school'];
        $state = $row['state'];
        $erank = $row['erank'];
        $rank = $row['rank'];
        $check = $mysqli->query("SELECT * FROM list WHERE user='$userid' AND school='$school'");
        if($check->num_rows == 0){
            $mysqli->query("INSERT INTO list (school, state, rank, erank, selecti, major, decision, final, user) 
        VALUES('$school', '$state', '$rank', '$erank', '$selecti', '$major', '$decision', '$final', '$userid')") or
            die($mysqli->error);
        
        $_SESSION['message'] = "School has been added!";
        $_SESSION['msg_type'] = "success";

        } else{
            $_SESSION['message'] = "School has already been added!";
            $_SESSION['msg_type'] = "danger";
        }
        $mysqli->close();
    }
    header("location: index.php");

}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM list WHERE id=$id") or die($mysqli->error());
    
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    
    header("location: index.php");
}

if(isset($_POST['submit'])){

    foreach($_POST['check'] AS $id){
        if($id >= 1000){
            $result = $mysqli->query("SELECT * FROM libschoollist WHERE id=$id") or die($mysqli->error());
        } else{
            $result = $mysqli->query("SELECT * FROM schoollist WHERE id=$id") or die($mysqli->error());
    
        }                
            if (count($result)==1){
            $row = $result->fetch_array();
            $school = $row['school'];
            $state = $row['state'];
            $rank = $row['rank'];
            $erank = $row['erank'];
            $check = $mysqli->query("SELECT * FROM list WHERE user='$userid' AND school='$school'");
                if($check->num_rows == 0){
                        $mysqli->query("INSERT INTO list (school, state, rank, erank, selecti, major, decision, final, user) 
                    VALUES('$school', '$state', '$rank', '$erank', '$selecti', '$major', '$decision', '$final', '$userid')") or
                    die($mysqli->error);
                    
                    $_SESSION['message'] = "School has been added!";
                    $_SESSION['msg_type'] = "success";
        
                } else{
                    $_SESSION['message'] = "School has already been added!";
                    $_SESSION['msg_type'] = "danger";
                }
        }
    }
    $mysqli->close();
    header("location: index.php");

}

function ranking($rank){
    if($rank > 200){
        echo 'N/A';
    } else{
        echo $rank;
    }
}