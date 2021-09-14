<!DOCTYPE html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../global.css" />
    <link rel="stylesheet" href="styles.css" />
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>LCC database - Timeline</title>
    <script language = "javascript">
            function deleteCheck(id){
              if(confirm("Are you sure you want to permanently delete the selected item?")){
                window.location.href='process.php?delete=' +id+'';
              }
            }
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
  </head>
  <html>
    <body>
    <div id="content">
    <?php require_once 'process.php'; ?>
    <nav class="navbar navbar-light" style="background-color: #E0FFFF;">
        <a class="navbar-brand" href="../roster"><i class="fas fa-users"></i>  Roster</a>
        <a class="navbar-brand" href="../timeline"><i class="fa fa-list-alt"></i>   Timeline</a>
        <a class="navbar-brand" href="../college_list"><i class="fas fa-graduation-cap"></i>Colleges</a>
        <a class="navbar-brand" href="../academic"><i class="fas fa-book"></i>  Academic</a>
        <a class="navbar-brand" href=#>Current Student: <i id="student"><?php echo $_SESSION['userid']; ?></i>  </a>
        <a href="../auth" class= 'btn btn-warning' id= "logout">Logout</a>

      </nav>
    <?php 
    if(isset($_SESSION['message'])):?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
    
      <?php
          echo $_SESSION['message'];
          unset($_SESSION['message']);
      ?>
    </div>
    <?php endif ?>
    <div class="container-title">
    <?php
        $mysqli = new mysqli('34.66.20.96', 'root', 'database password', 'userInfo') or die(mysqli_error($mysqli));
        $resultA = $mysqli->query("SELECT * FROM academic WHERE year = '9' AND user = '$userid'") or die($mysqli->error);
        $resultB = $mysqli->query("SELECT * FROM academic WHERE year = '10'AND user = '$userid'") or die($mysqli->error);
        $resultC = $mysqli->query("SELECT * FROM academic WHERE year = '11'AND user = '$userid'") or die($mysqli->error);
        $resultD = $mysqli->query("SELECT * FROM academic WHERE year = '12'AND user = '$userid'") or die($mysqli->error);

    ?>
    <div class="box-title">
        <h1>Academics</h1>
    </div>
    </div>
    <div class="container-1">
    <div class="box-1">
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
                               class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>
                               <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-outline-danger btn-sm"><i class="fas fa-times"></i></a>
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
                        <button type="submit" class="btn btn-outline-success btn-sm" name="update"><i class="fas fa-check"></i></button>
                        <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-outline-danger btn-sm"><i class="fas fa-times"></i></a>
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
                        <button type="submit" class="btn btn-success btn-sm" name="save"><i class="fas fa-plus"></i></button>
                        </td>
                    </tr>
                </form>
        </table>
                </div>
        <div class="box-2">
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
                               class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>
                               <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-outline-danger btn-sm"><i class="fas fa-times"></i></a>
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
                        <button type="submit" class="btn btn-outline-success btn-sm" name="update"><i class="fas fa-check"></i></button>
                        <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-outline-danger btn-sm"><i class="fas fa-times"></i></a>
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
                        <button type="submit" class="btn btn-success btn-sm" name="save"><i class="fas fa-plus"></i></button>
                        </td>
                    </tr>
                </form>  
        </table>
                </div>
                </div>
        <div class="container-2">
        <div class="box-3">
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
                               class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>
                               <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-outline-danger btn-sm"><i class="fas fa-times"></i></a>
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
                        <button type="submit" class="btn btn-outline-success btn-sm" name="update"><i class="fas fa-check"></i></button>
                        <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-outline-danger btn-sm"><i class="fas fa-times"></i></a>
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
                        <button type="submit" class="btn btn-success btn-sm" name="save"><i class="fas fa-plus"></i></button>
                        </td>
                    </tr>
                </form>
        </table>
                </div>
        <div class="box-4">
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
                               class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>
                               <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-outline-danger btn-sm"><i class="fas fa-times"></i></a>
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
                        <button type="submit" class="btn btn-outline-success btn-sm" name="update"><i class="fas fa-check"></i></button>
                        <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-outline-danger btn-sm"><i class="fas fa-times"></i></a>
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
                        <button type="submit" class="btn btn-success btn-sm" name="save"><i class="fas fa-plus"></i></button>
                        </td>
                    </tr>
                </form>
        </table>
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
