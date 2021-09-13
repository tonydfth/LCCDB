<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../global.css" />
    <link rel="stylesheet" href="styles.css" />
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>LCC database - Timeline</title>
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <script language = "javascript">
            function deleteCheck(id){
              if(confirm("Are you sure you want to permanently delete the selected item?")){
                window.location.href='process.php?delete=' +id+'';
              }
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
      <?php
        $mysqli = new mysqli('34.66.20.96', 'root', 'eddiecollege', 'userInfo') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM timeline WHERE user='$userid' ORDER BY timeline.deadline ASC") or die($mysqli->error);
      ?>
        <div class="container">
          <div class="justify-content-center">
        <p id="title">Timeline</p>
        <table class="table table-hover">
        <thead>
          <tr>
            <th>Application Milestone</th>
            <th>Deadline</th>
            <th>Status</th>
            <th colspan="2">Action</th>
            <th><a href="#" data-toggle="modal" data-target="#popup" class="btn btn-success"><i class="fas fa-plus"></i></a></th>
          </tr>
        </thead>
        <?php
          while ($row = $result->fetch_assoc()): ?>
          <?php if ($row['id'] != $id): ?>
            <tr>
            <td><?php echo $row['milestone']; ?>
            </td>
            <td><?php dateConvert($row['deadline']); ?></td>
            <td id="badge" class=<?php badgeConvert($row['status']);?>><?php echo $row['status']; ?></td>
            <td>
              <a href="index.php?edit=<?php echo $row['id']; ?>" 
                class="btn btn-outline-info"><i class="fas fa-edit"></i></a>
                <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-outline-danger"><i class="fas fa-times"></i></a>
            </td>
          </tr>
          <?php else: ?>
            <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
              <tr>
              <td><p><input type="text" name="milestone" class="form-control" value="<?php echo $milestone; ?>" placeholder="Enter your milestone"></p>
              </td>
              <td><select name="deadline" >
                              <option value="<?php echo $deadline ?>"><?php dateConvert($deadline) ?></option>
                              <option value="5">May</option>
                              <option value="6">June</option>
                              <option value="7">July</option>
                              <option value="8">August</option>
                              <option value="9">September 1st Part</option>
                              <option value="9.5">September 2nd Part</option>
                              <option value="10">October</option>
                              <option value="11">November 1st Part</option>
                              <option value="11.5">November 2nd Part</option>
                              <option value="12">December 1st Part</option>
                              <option value="12.5">December 2nd Part</option>
                          </select></td>
              <td><select name="status" >
                              <option value="<?php echo $status ?>"><?php echo $status ?></option>
                              <option value="Complete">Complete</option>
                              <option value="Incomplete">Incomplete</option>
                              <option value="In Progress">In Progress</option>
                          </select></td>
              <td>
              <button type="submit" class="btn btn-outline-success" name="update"><i class="fas fa-check"></i></button>
              <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                class="btn btn-outline-danger"><i class="fas fa-times"></i></a>
              </td>
              </tr>
            </form> 
          <?php endif; ?>
          <?php endwhile; ?>
        </table>
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
                          <label>Milestone</label>
                          <input type="text" name="milestone" class="form-control" 
                          value="<?php echo $milestone; ?>" placeholder="Enter your milestone">
                        </div>


                        <div class="form-group">
                        <label>Deadline</label>
                        <td><select name="deadline" >
                              <option value="5">May</option>
                              <option value="5">May</option>
                              <option value="6">June</option>
                              <option value="7">July</option>
                              <option value="8">August</option>
                              <option value="9">September 1st Part</option>
                              <option value="9.5">September 2nd Part</option>
                              <option value="10">October</option>
                              <option value="11">November 1st Part</option>
                              <option value="11.5">November 2nd Part</option>
                              <option value="12">December 1st Part</option>
                              <option value="12.5">December 2nd Part</option>
                          </select></td>
                        </div>

                        <div class="form-group">
                        <label>Status</label>
                        <select name="status" >
                            <option value="Incomplete"></option>
                            <option value="Complete">Complete</option>
                            <option value="Incomplete">Incomplete</option>
                            <option value="In Progress">In Progress</option>
                        </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="save">Save</button>
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

  <!-- Scripts -->
  <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="../js/util.js"></script>
  <script src="js/timeline.js"></script>
