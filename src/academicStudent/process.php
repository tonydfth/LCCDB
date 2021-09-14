<?php

session_start();

$mysqli = new mysqli('34.66.20.96', 'root', 'database password', 'userInfo') or die(mysqli_error($mysqli));

$id = 0;
$subject = '';
$grade1 = '';
$grade2 = '';
$honor = '';
$year = '';
$userid = $_SESSION['userid'];

$avg1 = $mysqli->query("SELECT AVG (grade1) AS avg FROM academic WHERE user = '$userid' AND grade1 < 5") or die($mysqli->error);
$avg2 = $mysqli->query("SELECT AVG (grade2) AS avg FROM academic WHERE user = '$userid' AND grade2 < 5") or die($mysqli->error);

$avgUC1 = $mysqli->query("SELECT AVG (Round(grade1, 0)) AS avg FROM academic WHERE user = '$userid' AND grade1 < 5 AND (year = 10 OR year = 11)") or die($mysqli->error);
$avgUC2 = $mysqli->query("SELECT AVG (Round(grade2, 0)) AS avg FROM academic WHERE user = '$userid' AND grade2 < 5 AND (year = 10 OR year = 11)") or die($mysqli->error);


while($row = $avg1->fetch_assoc()){
    $gpa1 = $row['avg'];
}
while($row = $avg2->fetch_assoc()){
    $gpa2 = $row['avg'];
}

while($row = $avgUC1->fetch_assoc()){
    $gpaU1 = $row['avg'];
}
while($row = $avgUC2->fetch_assoc()){
    $gpaU2 = $row['avg'];
}

if($gpa1 == 0){
    $gpa = round($gpa2, 2);
} elseif($gpa2 == 0){
    $gpa = round($gpa1, 2);
} else{
    $gpa = round(($gpa1 + $gpa2)/2, 2);
}

if($gpaU1 == 0){
    $gpaU = round($gpaU2, 2);
} elseif($gpaUC2 == 0){
    $gpaU = round($gpaU1, 2);
} else{
    $gpaU = round(($gpaU1 + $gpaU2)/2, 2);
}

$avgHonor = $mysqli->query("SELECT AVG(honor/2) AS avg FROM academic WHERE user = '$userid'") or die($mysqli->error);
$avgHonorUC = $mysqli->query("SELECT AVG(honor/2) AS avg FROM academic WHERE user = '$userid' AND (year=10 OR year=11)") or die($mysqli->error);


while($row = $avgHonor->fetch_assoc()){
    $gpaW = round($row['avg'] + $gpa, 2);
}

while($row = $avgHonorUC->fetch_assoc()){
    $gpaUC = round($row['avg'] + $gpaU, 2);
}



if (isset($_POST['save'])){
    $subject = $_POST['subject'];
    $grade1 = $_POST['grade1'];
    $grade2 = $_POST['grade2'];
    $honor = $_POST['honor'];
    $year = $_POST['year'];
    
    $mysqli->query("INSERT INTO academic (subject, grade1, grade2, honor, year, user) VALUES('$subject', '$grade1', '$grade2', '$honor', '$year', '$userid')") or
            die($mysqli->error);
        
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
    
    header("location: index.php");
    
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM academic WHERE id=$id") or die($mysqli->error());
    
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    
    header("location: index.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM academic WHERE id=$id") or die($mysqli->error());
    if (count($result)==1){
        $row = $result->fetch_array();
        $subject = $row['subject'];
        $grade1 = $row['grade1'];
        $grade2 = $row['grade2'];
        $honor = $row['honor'];
        $year = $row['year'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $subject = $_POST['subject'];
    $grade1 = $_POST['grade1'];
    $grade2 = $_POST['grade2'];
    $honor = $_POST['honor'];
    $year = $_POST['year'];
    
    $mysqli->query("UPDATE academic SET subject='$subject', grade1='$grade1', grade2='$grade2', honor='$honor', year='$year' WHERE id=$id") or
            die($mysqli->error);
    
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
    
    header('location: index.php');
}

function gpaConvert($grade){
    if ($grade == 4.3){
        echo "A+";
    } elseif($grade == 4){
        echo "A";
    } elseif($grade == 3.7){
        echo "A-";
    } elseif($grade == 3.3){
        echo "B+";
    } elseif($grade == 3){
        echo "B";
    } elseif($grade == 2.7){
        echo "B-";
    } elseif($grade == 2.3){
        echo "C+";
    } elseif($grade == 2){
        echo "C";
    } elseif($grade == 1.7){
        echo "C-";
    } elseif($grade == 1.3){
        echo "D+";
    } elseif($grade == 1){
        echo "D";
    } elseif($grade == 0.7){
        echo "D-";
    } elseif($grade == 0.001){
        echo "F";
    } elseif ($grade == 60){
        echo "CR";
    } elseif ($grade == 70){
        echo "NC";
    } elseif ($grade == 80){
        echo "N/A";
    } else{
        echo "";
    }
}