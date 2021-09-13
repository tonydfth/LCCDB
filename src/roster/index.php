.<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../global.css" />
    <link rel="stylesheet" href="styles.css" />
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <title>LCC database - </title>
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <script language = "javascript">
            function deleteCheck(id){
              if(confirm("Are you sure you want to permanently delete all records of this student?")){
                window.location.href='process.php?delete=' +id+'';
              }
            }
    </script>
    <script>
      $('#npassword, #cnPassword').on('keyup', function () {
        if ($('#npassword').val() == $('#cnPassword').val()) {
          $('#nmessage').html('Matching').css('color', 'green');
        } else 
          $('#nmessage').html('Not Matching').css('color', 'red');
      });
    </script>
    <script>
      $('#password, #cPassword').on('keyup', function () {
        if ($('#password').val() == $('#cPassword').val()) {
          $('#message').html('Matching').css('color', 'green');
        } else 
          $('#message').html('Not Matching').css('color', 'red');
      });
    </script>
    <script>
        function generateP() {
            var pass = '';
            var str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' + 
                    'abcdefghijklmnopqrstuvwxyz0123456789';
              
            for (i = 1; i <= 8; i++) {
                var char = Math.floor(Math.random()
                            * str.length + 1);
                  
                pass += str.charAt(char)
            }
              
            return pass;
        }
        function generate() {
          document.getElementById("password").value = generateP();
        }
    </script>
  </head>
    <body>
    <div id="content">
    <?php require_once 'process.php'; ?>
      <nav class="navbar navbar-light" style="background-color: #E0FFFF;">
        <a class="navbar-brand" href="../roster"><i class="fas fa-users"></i>  Roster</a>
        <a class="navbar-brand" href="../timeline"><i class="fa fa-list-alt"></i>   Timeline</a>
        <a class="navbar-brand" href="../college_list"><i class="fas fa-graduation-cap"></i>Colleges</a>
        <a class="navbar-brand" href="../academic"><i class="fas fa-book"></i>  Academic</a>
        <a class="navbar-brand" href=#>Current Student: <i id="student"><?php echo $_SESSION['userid']; ?></i> </a>
        <a href="#" data-toggle="modal" data-target="#changeP" class="btn btn-secondary">Change Password</a>
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
    <div class="container">
      <?php
        $mysqli = new mysqli('34.66.20.96', 'root', 'eddiecollege', 'userInfo') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM users WHERE auth=1 ORDER BY users.username ASC") or die($mysqli->error);
      ?>
      <div class="row justify-content-center">
        <table class="table">
        <thead>
          <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Focus</th>
            <th colspan="2">Action</th>
            <th><a href="#" data-toggle="modal" data-target="#popup" class="btn btn-success"><i class="fas fa-plus"></i></a></th>
            <th><a href="../finalizeAll" class="btn btn-info">Finalize All</a></th>

          </tr>
        </thead>
        <?php
          while ($row = $result->fetch_assoc()): ?>
          <?php if ($row['id'] != $id): ?>
          <tr>
            <?php $student = $row['username']; $finalized = $mysqli->query("SELECT * FROM list WHERE user='$student' AND final = 1") or die($mysqli->error); ?>
            <td><?php echo $student; ?>  
              <?php 
                echo '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#'.$row['id'].'" aria-expanded="false" aria-controls="'.$row['id'].'">
              Finalized Schools</button>';?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo focusConvert($row['focus']); ?></td>
            <td>
              <a href="index.php?select=<?php echo $row['username']; ?>"
                class="btn btn-outline-success">Select</a>
              <a href="index.php?edit=<?php echo $row['id']; ?>" 
                class="btn btn-outline-info">Edit</a>
                <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                  class="btn btn-outline-danger">Delete</a>
            </td>
          </tr>
          <tr>
            <td>
              <?php echo '<div class="collapse" id="'.$row['id'].'">'; ?>
              <table class = "table">
                <?php while ($schools = $finalized->fetch_assoc()): ?>
                <tr>
                  <td><?php echo $schools['school'];?><td>
                  <td><?php echo $schools['major'];?><td>
                </tr>
                <?php endwhile; ?>
              </table>
              </div>
            </td>
          </tr>
          <?php else: ?>
            <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
              <tr>
              <td><input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Enter your username"></td>
              <td><input type="text" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Enter your password"></td>
              <td><select name="focus" >
                              <option value="<?php echo $focus ?>"><?php focusConvert($focus) ?></option>
                              <option value="0">N/A</option>
                              <option value="1">Engineering</option>
                              <option value="2">Business</option>
                              <option value="3">All</option>
                          </select></td>
              <td>
              <button type="submit" class="btn btn-outline-success" name="update"><i class="fas fa-check"></i></button>
              </td>
              </tr>
            </form> 
          <?php endif; ?>
          <?php endwhile; ?>    
        </table>
      </div>
      <div class="modal fade" id="changeP">
        <div class="modal-dialog model">
          <div class="modal-content">
            <div class="modal-header">
              <h1>Change Password</h1>
            </div>
            <div class="modal-body">
              <form action="process.php" method="POST">
                <div class="form-group">
                  <label>Staff:</label>
                  <p><?php echo $_SESSION['staffid']; ?></p>
                </div>
                <div class="form-group">
                  <label>New Password: </label>
                  <input type="text" name="npassword" id="npassword" autocomplete="off" class="form-control" 
                  placeholder="New Password" required/>
                </div>

                <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="text" name="cnPassword" id="cnPassword" autocomplete="off" class="form-control" 
                  placeholder="Confirm the password" required/>
                  <span id='nmessage'></span>
                </div>
                <div class="form-group">
                  <button id="submit" type="submit" class="btn btn-outline-success" name="changeP">Save</button>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <input class="btn btn-danger" data-dismiss="modal" value="Close">
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="popup">
        <div class="modal-dialog model">
          <div class="modal-content">
            <div class="modal-header">
              <h1>Add Student Account</h1>
            </div>
            <div class="modal-body">
              <div class="row justify-content-center">
                <form action="process.php" method="POST">
                  <div class="form-group">
                  <label>First Name</label>
                  <input type="text" name="firstName" autocomplete="off" class="form-control" 
                    placeholder="Enter Your First Name" required/>
                  </div>

                  <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" name="lastName" autocomplete="off" class="form-control" 
                    placeholder="Enter Your Last Name" required/>
                  </div>

                  <div class="form-group">
                  <label>Password</label>
                  <input type="text" name="password" id="password" autocomplete="off" class="form-control" 
                  placeholder="Generate Random Password" required/>
                  </div>

                  <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="text" name="cPassword" id="cPassword" autocomplete="off" class="form-control" 
                  placeholder="Confirm the password" required/>
                  <span id='message'></span>
                  </div>

                  <div class="form-group">
                    <label>Focus: </label>
                    <select name="focus" >
                        <option value="0">N/A</option>
                        <option value="1">Engineering</option>
                        <option value="2">Business</option>
                        <option value="3">All</option>
                    </select>
                  </div>
                                  
                  <div class="form-group">
                      <button id="submit" type="submit" class="btn btn-outline-success" name="save">Save</button>
                      <button type="button" onclick="generate()" class="btn btn-outline-primary">Generate Password</button>
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
      </div>
      </div>
    </body>
    </html>
  <!-- jQuery -->
  <script
    src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"
  ></script>
  <script src="../js/util.js"></script>
  <script src="js/roster.js"></script>
