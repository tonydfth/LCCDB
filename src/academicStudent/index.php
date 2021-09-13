<!DOCTYPE html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../global.css" />
    <link rel="stylesheet" href="styles.css" />
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>LCC database - Timeline</title>
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <script>
      function openSlideMenu(){
        document.getElementById('menu').style.width = '250px';
        document.getElementById('content').style.marginLeft='250px';
      }
      function closeSlideMenu(){
        document.getElementById('menu').style.width = '0';
        document.getElementById('content').style.marginLeft='0';
      }
    </script>
    <script language = "javascript">
            function deleteCheck(id){
              if(confirm("Are you sure you want to permanently delete the selected item?")){
                window.location.href='process.php?delete=' +id+'';
              }
            }
    </script>
  </head>
  <html>
    <body>
    <?php require_once 'process.php'; ?>
    <?php 
    if(isset($_SESSION['message'])):?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
    
      <?php
          echo $_SESSION['message'];
          unset($_SESSION['message']);
      ?>
    </div>
    <?php endif ?>
    <div class="container">
        <a id="open" href="#" onclick="openSlideMenu()">
          <i class="fas fa-bars"></i>
        </a>
      <a href="../auth" class= 'btn btn-warning' id= "logout">Logout</a>
      <a href="#" id= "add" data-toggle="modal" data-target="#popup" class="btn btn-success"><i class="fas fa-plus"></i></a>
      <div id="menu" class="nav">
        <a href="#" id ="cross" class="close" onclick="closeSlideMenu()">
          <i class="fas fa-times"></i>
        </a>
        <a id="navItems" class="navbar-brand" href="../timelineStudent"><i class="fa fa-list-alt"></i>   Timeline</a>
        <a id="navItems" class="navbar-brand" href="../college_listStudent"><i class="fas fa-graduation-cap"></i>Colleges</a>
        <a id="navItems" class="navbar-brand" href="../academicStudent"><i class="fas fa-book"></i>  Academic</a>
      </div>
      </div>
      <div id="content">
    <div class="container">
    <?php
        $mysqli = new mysqli('34.66.20.96', 'root', 'eddiecollege', 'userInfo') or die(mysqli_error($mysqli));
        $resultA = $mysqli->query("SELECT * FROM academic WHERE year = '9' AND user = '$userid'") or die($mysqli->error);
        $resultB = $mysqli->query("SELECT * FROM academic WHERE year = '10'AND user = '$userid'") or die($mysqli->error);
        $resultC = $mysqli->query("SELECT * FROM academic WHERE year = '11'AND user = '$userid'") or die($mysqli->error);
        $resultD = $mysqli->query("SELECT * FROM academic WHERE year = '12'AND user = '$userid'") or die($mysqli->error);

    ?>
    <p id="title">Academic</p>
    <div id="bigTable">
    <div id="table">
    <div class="content flow">
    <div class="even-columns">
        <div class="col">
        <table class="table table-bordered">
        <thead>
          <tr id="heading">
            <th colspan="5">9th Grade</th>
          </tr>
          <tr id="heading">
            <th>Subject</th>
            <th>First Semester</th>
            <th>Second Semester</th>
            <th>Honor/AP</th>
            <th>Action</th>
            </tr>
          </thead>
            <?php
                while ($row = $resultA->fetch_assoc()): ?>
                <?php if ($row['id'] != $id): ?>
                      <tr>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php gpaConvert($row['grade1']); ?></td>
                        <td><?php gpaConvert($row['grade2']); ?></td>
                        <td><?php echo $row['honor']; ?></td>
                        <td>
                            <a id="button" href="index.php?edit=<?php echo $row['id']; ?>"
                               class="btn btn-info"><i class="fas fa-edit"></i></a>
                               <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-danger"><i class="fas fa-times"></i></a>
                        </td>
                </tr> 
                <?php else: ?>
                    <form action="process.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <tr>
                        <td><input id="textbox" type="text" name="subject" class="form-control" 
                        value="<?php echo $subject; ?>" placeholder="Enter the subject"></td>
                        <td><select name="grade1" >
                            <option value="<?php echo $grade1; ?>"><?php gpaConvert($grade1); ?></option>
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select></td>
                        <td><select name="grade2" >
                            <option value="<?php echo $grade2; ?>"><?php gpaConvert($grade2); ?></option>
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select></td>
                        <td><select name="honor" >
                            <option value="<?php echo $honor; ?>"><?php echo $honor; ?></option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select></td>
                        <input type="hidden" name="year" value="9">
                        <td>
                        <button type="submit" class="btn btn-success" name="update"><i class="fas fa-check"></i></button>
                        <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-danger"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                </form>
            <?php endif; ?>
            <?php endwhile; ?>  
            <form action="process.php" method="POST">
                    <tr>
                        <td><input id="textbox" type="text" name="subject" class="form-control" 
                         placeholder="Enter the subject"></td>
                        <td><select name="grade1" >
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select></td>
                        <td><select name="grade2" >
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select></td>
                        <td><select name="honor" >
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select></td>
                        <input type="hidden" name="year" value="9">
                        <td>
                        <button type="submit" class="btn btn-success" name="save"><i class="fas fa-plus"></i></button>
                        </td>
                    </tr>
                </form>
        </table>
      </div>
      <div class="col">
      <table class="table table-bordered">
        <thead>
          <tr id="heading">
            <th colspan="5">10th Grade</th>
          </tr>
          <tr id="heading">
            <th>Subject</th>
            <th>First Semester</th>
            <th>Second Semester</th>
            <th>Honor/AP</th>
            <th>Action</th>
            </tr>
          </thead>
          <?php
                while ($row = $resultB->fetch_assoc()): ?>
                <?php if ($row['id'] != $id): ?>
                      <tr>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php gpaConvert($row['grade1']); ?></td>
                        <td><?php gpaConvert($row['grade2']); ?></td>
                        <td><?php echo $row['honor']; ?></td>
                        <td>
                            <a id="button" href="index.php?edit=<?php echo $row['id']; ?>"
                               class="btn btn-info"><i class="fas fa-edit"></i></a>
                               <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-danger"><i class="fas fa-times"></i></a>
                        </td>
                        </tr> 
                <?php else: ?>
                    <form action="process.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <tr>
                        <td><input id="textbox" type="text" name="subject" class="form-control" 
                        value="<?php echo $subject; ?>" placeholder="Enter the subject"></td>
                        <td><select name="grade1" >
                            <option value="<?php echo $grade1; ?>"><?php gpaConvert($grade1); ?></option>
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select></td>
                        <td><select name="grade2" >
                            <option value="<?php echo $grade2; ?>"><?php gpaConvert($grade2); ?></option>
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select></td>
                        <td><select name="honor" >
                            <option value="<?php echo $honor; ?>"><?php echo $honor; ?></option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select></td>
                        <input type="hidden" name="year" value="10">
                        <td>
                        <button type="submit" class="btn btn-success" name="update"><i class="fas fa-check"></i></button>
                        <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-danger"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                </form>
            <?php endif; ?>
            <?php endwhile; ?>
            <form action="process.php" method="POST">
                    <tr>
                        <td><input id="textbox" type="text" name="subject" class="form-control" 
                         placeholder="Enter the subject"></td>
                        <td><select name="grade1" >
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select></td>
                        <td><select name="grade2" >
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select></td>
                        <td><select name="honor" >
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select></td>
                        <input type="hidden" name="year" value="10">
                        <td>
                        <button type="submit" class="btn btn-success" name="save"><i class="fas fa-plus"></i></button>
                        </td>
                    </tr>
                </form>  
        </table>
      </div>
      <div class="col">
      <table class="table table-bordered">
        <thead>
          <tr id="heading">
            <th colspan="5">11th Grade</th>
          </tr>
          <tr id="heading">
            <th>Subject</th>
            <th>First Semester</th>
            <th>Second Semester</th>
            <th>Honor/AP</th>
            <th>Action</th>
            </tr>
          </thead>
          <?php
                while ($row = $resultC->fetch_assoc()): ?>
                <?php if ($row['id'] != $id): ?>
                      <tr>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php gpaConvert($row['grade1']); ?></td>
                        <td><?php gpaConvert($row['grade2']); ?></td>
                        <td><?php echo $row['honor']; ?></td>
                        <td>
                            <a id="button" href="index.php?edit=<?php echo $row['id']; ?>"
                               class="btn btn-info"><i class="fas fa-edit"></i></a>
                               <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-danger"><i class="fas fa-times"></i></a>
                        </td>
                        </tr> 
                <?php else: ?>
                    <form action="process.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <tr>
                        <td><input id="textbox" type="text" name="subject" class="form-control" 
                        value="<?php echo $subject; ?>" placeholder="Enter the subject"></td>
                        <td><select name="grade1" >
                            <option value="<?php echo $grade1; ?>"><?php gpaConvert($grade1); ?></option>
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select></td>
                        <td><select name="grade2" >
                            <option value="<?php echo $grade2; ?>"><?php gpaConvert($grade2); ?></option>
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select></td>
                        <td><select name="honor" >
                            <option value="<?php echo $honor; ?>"><?php echo $honor; ?></option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select></td>
                        <input type="hidden" name="year" value="11">
                        <td>
                        <button type="submit" class="btn btn-success" name="update"><i class="fas fa-check"></i></button>
                        <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-danger"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                </form>
            <?php endif; ?>
            <?php endwhile; ?>  
            <form action="process.php" method="POST">
                    <tr>
                        <td><input id="textbox" type="text" name="subject" class="form-control" 
                         placeholder="Enter the subject"></td>
                        <td><select name="grade1" >
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select></td>
                        <td><select name="grade2" >
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select></td>
                        <td><select name="honor" >
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select></td>
                        <input type="hidden" name="year" value="11">
                        <td>
                        <button type="submit" class="btn btn-success" name="save"><i class="fas fa-plus"></i></button>
                        </td>
                    </tr>
                </form>
        </table>
      </div>
      <div class="col">
      <table class="table table-bordered">
        <thead>
          <tr id="heading">
            <th colspan="5">12th Grade</th>
          </tr>
          <tr id="heading">
            <th>Subject</th>
            <th>First Semester</th>
            <th>Second Semester</th>
            <th>Honor/AP</th>
            <th>Action</th>
            </tr>
          </thead>
          <?php
                while ($row = $resultD->fetch_assoc()): ?>
                <?php if ($row['id'] != $id): ?>
                      <tr>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php gpaConvert($row['grade1']); ?></td>
                        <td><?php gpaConvert($row['grade2']); ?></td>
                        <td><?php echo $row['honor']; ?></td>
                        <td>
                            <a id="button" href="index.php?edit=<?php echo $row['id']; ?>"
                               class="btn btn-info"><i class="fas fa-edit"></i></a>
                               <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-danger"><i class="fas fa-times"></i></a>
                        </td>
                        </tr> 
                <?php else: ?>
                    <form action="process.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <tr>
                        <td><input id="textbox" type="text" name="subject" class="form-control" 
                        value="<?php echo $subject; ?>" placeholder="Enter the subject"></td>
                        <td><select name="grade1" >
                            <option value="<?php echo $grade1; ?>"><?php gpaConvert($grade1); ?></option>
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select></td>
                        <td><select name="grade2" >
                            <option value="<?php echo $grade2; ?>"><?php gpaConvert($grade2); ?></option>
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select></td>
                        <td><select name="honor" >
                            <option value="<?php echo $honor; ?>"><?php echo $honor; ?></option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select></td>
                        <input type="hidden" name="year" value="12">
                        <td>
                        <button type="submit" class="btn btn-success" name="update"><i class="fas fa-check"></i></button>
                        <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-danger"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                </form>
            <?php endif; ?>
            <?php endwhile; ?>  
            <form action="process.php" method="POST">
                    <tr>
                        <td><input id="textbox" type="text" name="subject" class="form-control" 
                         placeholder="Enter the subject"></td>
                        <td><select name="grade1" >
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select></td>
                        <td><select name="grade2" >
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select></td>
                        <td><select name="honor" >
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select></td>
                        <input type="hidden" name="year" value="12">
                        <td>
                        <button type="submit" class="btn btn-success" name="save"><i class="fas fa-plus"></i></button>
                        </td>
                    </tr>
                </form>
        </table>
      </div>
    </div>
   </div>
   </div>
    </div>

    <div class="modal fade" id="popup">
        <div class="modal-dialog model">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Add</h1>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                    <form action="process.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="subject" class="form-control" 
                         placeholder="Enter the subject">
                        </div>

                        <div class="form-group">
                        <label>Grade1: </label>
                        <select name="grade1" >
                            <option value="4">A</option>
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select>
                        </div>

                        <div class="form-group">
                        <label>Grade2: </label>
                        <select name="grade2" >
                            <option value="4">A</option>
                            <option value="4.3">A+</option>
                            <option value="4">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.3">D+</option>
                            <option value="1">D</option>
                            <option value="0.7">D-</option>
                            <option value="0.001">F</option>
                            <option value="60">CR</option>
                            <option value="70">NC</option>
                            <option value="80">N/A</option>
                        </select>
                        </div>

                        <div class="form-group">
                        <label>Honor/AP: </label>
                        <select name="honor" >
                            <option value="0">0</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                        </div>

                        <div class="form-group">
                        <label>Year: </label>
                        <select name="year" >
                            <option value="9">9th</option>
                            <option value="9">9th</option>
                            <option value="10">10th</option>
                            <option value="11">11th</option>
                            <option value="12">12th</option>
                        </select>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-danger" data-dismiss="modal" value="Close">
                </div>
            </div>
        </div>
    </div>

        <div class="row justify-content-center">
        <p>Unweighted GPA: <?php echo $gpa; ?> </p>
        </div>
        
        <div class="row justify-content-center">
        <p>Weighted GPA: <?php echo $gpaW; ?> </p>
        </div>

        <div class="row justify-content-center">
        <p>UC GPA: <?php echo $gpaUC; ?> </p>
        </div>

      </div>
      </div>
    </body>

  <!-- jQuery -->
  <script
    src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"
  ></script>

  <!-- Scripts -->
  <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="../../js/util.js"></script>
  <script src="js/9th.js"></script>
</html>
