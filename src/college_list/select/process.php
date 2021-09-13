<?php

session_start();

$mysqli = new mysqli('34.66.20.96', 'root', 'eddiecollege', 'userInfo') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$school = '';
$state = '';
$rank = 0;
$erank = 0;
$selecti = '';
$major = '';
$decision = '';
$final = 0;
$check = 0;
$lib = 0;
$userid = $_SESSION['userid'];


$checK = $mysqli->query("SELECT * FROM users WHERE username='$userid'") or die($mysqli->error());

if (isset($_GET['filter'])){
    $fi = $_GET['filter'];
}

if (count($checK)==1){
    $row = $checK->fetch_array();
    $focus = $row['focus'];
}

if (isset($_POST['save'])){
    $school = $_POST['school'];
    $state = $_POST['state'];
    $rank = $_POST['rank'];
    $erank = $_POST['erank'];
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
        $libresult = $mysqli->query("SELECT * FROM libschoollist WHERE id=$id") or die($mysqli->error());
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
            $mysqli->query("INSERT INTO list (school, state, rank, erank, selecti, major, decision, final, lib, user) 
        VALUES('$school', '$state', '$rank', '$erank', '$selecti', '$major', '$decision', '$final', '$lib', '$userid')") or
            die($mysqli->error);
        
        $_SESSION['message'] = "School has been added!";
        $_SESSION['msg_type'] = "success";

        } else{
            $_SESSION['message'] = "School has already been added!";
            $_SESSION['msg_type'] = "danger";
        }
        $mysqli->close();
    }
    if (count($libresult)==1){
        $row = $libresult->fetch_array();
        $school = $row['school'];
        $state = $row['state'];
        $erank = $row['erank'];
        $rank = $row['rank'];
        $lib = 1;
        $check = $mysqli->query("SELECT * FROM list WHERE user='$userid' AND school='$school'");
        if($check->num_rows == 0){
            $mysqli->query("INSERT INTO list (school, state, rank, erank, selecti, major, decision, final, lib, user) 
        VALUES('$school', '$state', '$rank', '$erank', '$selecti', '$major', '$decision', '$final', '$lib', '$userid')") or
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

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM list WHERE id=$id") or die($mysqli->error());
    if (count($result)==1){
        $row = $result->fetch_array();
        $school = $row['school'];
        $state = $row['state'];
        $rank = $row['rank'];
        $Erank = "0";
        $selecti = $row['selecti'];
        $major = $row['major'];
        $decision = $row['decision'];
    }
}

if(isset($_POST['submit'])){

    foreach($_POST['check'] AS $id){
        if($id >= 1000){
            $libresult = $mysqli->query("SELECT * FROM libschoollist WHERE id=$id") or die($mysqli->error());
            $result = NULL;
        } else{
            $result = $mysqli->query("SELECT * FROM schoollist WHERE id=$id") or die($mysqli->error());
            $libresult = NULL;
        }                
            if (count($result)==1){
            $row = $result->fetch_array();
            $school = $row['school'];
            $state = $row['state'];
            $rank = $row['rank'];
            $erank = $row['erank'];
            $check = $mysqli->query("SELECT * FROM list WHERE user='$userid' AND school='$school'");
                if($check->num_rows == 0){
                        $mysqli->query("INSERT INTO list (school, state, rank, erank, selecti, major, decision, final, lib, user) 
                    VALUES('$school', '$state', '$rank', '$erank', '$selecti', '$major', '$decision', '$final', '$lib', '$userid')") or
                    die($mysqli->error);
        
                }
        }
        if (count($libresult)==1){
            $row = $libresult->fetch_array();
            $school = $row['school'];
            $state = $row['state'];
            $erank = $row['erank'];
            $rank = $row['rank'];
            $lib = 1;
            $check = $mysqli->query("SELECT * FROM list WHERE user='$userid' AND school='$school'");
            if($check->num_rows == 0){
                $mysqli->query("INSERT INTO list (school, state, rank, erank, selecti, major, decision, final, lib, user) 
            VALUES('$school', '$state', '$rank', '$erank', '$selecti', '$major', '$decision', '$final', '$lib', '$userid')") or
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

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $school = $_POST['school'];
    $state = $_POST['state'];
    $rank = $_POST['rank'];
    $Erank = "0";
    $selecti = $_POST['selecti'];
    $major = $_POST['major'];
    $decision = $_POST['decision'];
    
    $mysqli->query("UPDATE list SET school='$school', state='$state', rank='$rank', Erank='0', selecti='$selecti', major='$major', decision='$decision', final='$final' WHERE id=$id") or
            die($mysqli->error);
    
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
    
    header('location: index.php');
}



if (isset($_POST['finalize'])){
    $id = $_POST['id'];
    $school = $_POST['school'];
    $state = $_POST['state'];
    $rank = $_POST['rank'];
    $Erank = "0";
    $selecti = $_POST['selecti'];
    $major = $_POST['major'];
    $decision = $_POST['decision'];
    $final = 1;
    
    $mysqli->query("UPDATE list SET school='$school', state='$state', rank='$rank', Erank='$Erank', selecti='$selecti', major='$major', decision='$decision', final='$final' WHERE id=$id") or
            die($mysqli->error);
    
    $_SESSION['message'] = "Record has been finalized!";
    $_SESSION['msg_type'] = "success";
    
    header('location: index.php');
}

if (isset($_GET['unfinalize'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM list WHERE id=$id") or die($mysqli->error());
    if (count($result)==1){
        $row = $result->fetch_array();
        $school = $row['school'];
        $state = $row['state'];
        $rank = $row['rank'];
        $erank = "0";
        $selecti = $row['selecti'];
        $major = $row['major'];
        $decision = $row['decision'];
        $final = $row['final'];
    }
}

function rankConv($ranK){
    if($ranK == 0 || $ranK > 200){
        echo "N/A";
    } else {
        echo $ranK;
    }
}

function UCconv($ranK){
    if($ranK == 0){
        echo "Varies";
    } else {
        echo $ranK;
    }
}