<?php

session_start();

$mysqli = new mysqli('34.66.20.96', 'root', 'eddiecollege', 'userInfo') or die(mysqli_error($mysqli));

$username = '';
$password = '';
$focus = '';


if (isset($_POST['save'])){
    $username = $_POST['firstName'] . " " . $_POST['lastName'];
    $password = $_POST['password'];
    $cPassword = $_POST['cPassword'];
    $focus = $_POST['focus'];

    if($password == $cPassword){
        $mysqli->query("INSERT INTO users (username, password, auth, focus) VALUES('$username', '$password', 1, '$focus')") or
            die($mysqli->error);
        $mysqli->query("INSERT INTO timeline (milestone, staff, deadline, status, user) VALUES('Complete pre-writing', '', 5, 'Incomplete', '$username'), ('Develop College List', '', 5, 'Incomplete', '$username'), 
            ('Ask recommender 1 for LOR', '', 5, 'Incomplete', '$username'), ('Ask recommender 2 for LOR', '', 5, 'Incomplete', '$username'), ('Common App Essay begins', '', 6, 'Incomplete', '$username'), ('Develop activities for CA and UC', '', 6, 'Incomplete', '$username'), 
            ('Determine EA/ED schools', '', 7, 'Incomplete', '$username'), ('Student begins contacting schools ', '', 7, 'Incomplete', '$username'), ('Complete Common App Essay', '', 7, 'Incomplete', '$username'), ('UC Essay Begins', '', 7, 'Incomplete', '$username'), 
            ('Open UC application', '', 8, 'Incomplete', '$username'), ('Open Common Application ', '', 8, 'Incomplete', '$username'), ('Complete FERPA Waiver on Common Application', '', 8, 'Incomplete', '$username'), ('Open Coalition Application', '', 8, 'Incomplete', '$username'), 
            ('Complete UC Essay', '', 8, 'Incomplete', '$username'), ('Supplement Essay 1 Begins', '', 8, 'Incomplete', '$username'), ('Supplement Essay 1 Completed', '', 9, 'Incomplete', '$username'), ('Supplement Essays 2-5 Begin', '', 9, 'Incomplete', '$username'), 
            ('Instructions from Counselor on LOR and Transc.', '', 9, 'Incomplete', '$username'), ('Invite Recommenders on CA/Naviance', '', 9, 'Incomplete', '$username'), ('Understand SAT/ACT Submission Guidelines', '', 9, 'Incomplete', '$username'), ('Understand SAT/ACT Score Choice', '', 9, 'Incomplete', '$username'), 
            ('Review transcript submission process', '', 9, 'Incomplete', '$username'), ('Understand ED/EA Application Requirements', '', 9, 'Incomplete', '$username'), ('Finalize List of 10 Colleges', '', 9, 'Incomplete', '$username'), ('Populate/Review Common App Activity List', '', 9.5, 'Incomplete', '$username'), 
            ('Request Interviews from Schools Offering Them', '', 9.5, 'Incomplete', '$username'), ('Complete Populating Common Application', '', 9.5, 'Incomplete', '$username'), ('Complete Populating Coalition Application', '', 9.5, 'Incomplete', '$username'), ('Complete Populating UC Application', '', 9.5, 'Incomplete', '$username'), 
            ('Receive Admissions Interview Training', '', 10, 'Incomplete', '$username'), ('Submit Applications for ED/EA Schools', '', 10, 'Incomplete', '$username'), ('Ensure SAT/ACT/TOEFL in for EA/ED', '', 10, 'Incomplete', '$username'), ('EA/ED Essays 2-5 Completed', '', 10, 'Incomplete', '$username'), 
            ('December 1 Essays Begin', '', 11, 'Incomplete', '$username'), ('November 1: Most ED/EA Deadlines', '', 11, 'Incomplete', '$username'), ('Submit UC Application', '', 11, 'Incomplete', '$username'), ('Submit UW (11/15 deadline) application', '', 11, 'Incomplete', '$username'), 
            ('November 15: UW Deadline', '', 11.5, 'Incomplete', '$username'), ('November 30: UC Deadline', '', 11.5, 'Incomplete', '$username'), ('Complete PSU, UT, other 12/1 non-CA apps', '', 11.5, 'Incomplete', '$username'), ('Review and submit UC', '', 11.5, 'Incomplete', '$username'), 
            ('December 1 Essays Completed', '', 11.5, 'Incomplete', '$username'), ('Review and submit Other 12/1 apps', '', 11.5, 'Incomplete', '$username'), ('January 1 Essays Begin', '', 12, 'Incomplete', '$username'), ('December 1: Several Public Deadlines', '', 12, 'Incomplete', '$username'), 
            ('December 15: Most EA/ED decisions come back', '', 12, 'Incomplete', '$username'), ('January 1 Essays Completed', '', 12.5, 'Incomplete', '$username'), ('Submit RD Applications', '', 12.5, 'Incomplete', '$username'), ('Go through Final Application Checklist', '', 12.5, 'Incomplete', '$username'), 
            ('Review EA/ED results', '', 12.5, 'Incomplete', '$username'), ('Ensure SAT/ACT/TOEFL in for RD', '', 12.5, 'Incomplete', '$username'), ('January 1: Most RD Deadlines', '', 12.5, 'Incomplete', '$username')") or die($mysqli->error);
                
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "Please Confirm Password";
        $_SESSION['msg_type'] = "danger";
    }
    
    header("location: index.php");
    
}

if (isset($_POST['changeP'])){
    $staffname=$_SESSION['staffid'];
    $npassword = $_POST['npassword'];
    $cnPassword = $_POST['cnPassword'];
    if($npassword == $cnPassword){
        $mysqli->query("UPDATE users SET password='$npassword' WHERE username='$staffname'") or
            die($mysqli->error);
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "Please Confirm Password";
        $_SESSION['msg_type'] = "danger";
    }
    
    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $result = $mysqli->query("SELECT * FROM users WHERE id=$id") or die($mysqli->error());
    if (count($result)==1){
        $row = $result->fetch_array();
        $username = $row['username'];
        $mysqli->query("DELETE FROM users WHERE username='$username'") or die($mysqli->error());
        $mysqli->query("DELETE FROM timeline WHERE user='$username'") or die($mysqli->error());
        $mysqli->query("DELETE FROM academic WHERE user='$username'") or die($mysqli->error());
        $mysqli->query("DELETE FROM list WHERE user='$username'") or die($mysqli->error());
    }


    
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    
    header("location: index.php");
}

if (isset($_GET['select'])){
    $username = $_GET['select'];
    $_SESSION['userid'] = $username;
    header("Location: ../college_list");

}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM users WHERE id=$id") or die($mysqli->error());
    if (count($result)==1){
        $row = $result->fetch_array();
        $username = $row['username'];
        $password = $row['password'];
        $focus = $row['focus'];
    }
}

function focusConvert($focus){
    if($focus == 0){
        echo "N/A";
    } elseif($focus == 1){
        echo "Engineering";
    } elseif($focus == 2){
        echo "Business";
    } else{
        echo "All";
    }
}


if (isset($_POST['update'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $focus = $_POST['focus'];
    
    $mysqli->query("UPDATE users SET username='$username', password='$password', focus='$focus' WHERE id=$id") or
            die($mysqli->error);
    
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
    
    header('location: index.php');
}