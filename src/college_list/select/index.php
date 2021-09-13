<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../global.css" />
    <link rel="stylesheet" href="styles.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>LCC database - </title>
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
  </head>
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
    <?php endif; ?>
    <div class="container">
        <a id="open" href="#" onclick="openSlideMenu()">
          <i class="fas fa-bars"></i>
        </a>
      <a href="../../auth" class= 'btn btn-warning' id= "logout">Logout</a>
      <div id="menu" class="nav">
        <a href="#" id ="cross" class="close" onclick="closeSlideMenu()">
          <i class="fas fa-times"></i>
        </a>
        <a id="navItems" class="navbar-brand" href="../../timeline"><i class="fa fa-list-alt"></i>   Timeline</a>
        <a id="navItems" class="navbar-brand" href="../../college_list"><i class="fas fa-graduation-cap"></i>Colleges</a>
        <a id="navItems" class="navbar-brand" href="../../academic"><i class="fas fa-book"></i>  Academic</a>
      </div>
      </div>
      <div id="content">
    <div class="container">
    <?php require_once 'process.php'; ?>
      <div class="row justify-content-start">
        Filters: 
        <?php if($fi==0): ?>
        <a href="index.php?filter=0"
                class="btn btn-dark">All</a>
        <?php else: ?>
        <a href="index.php?filter=0" 
              class="btn btn-primary">All</a>
        <?php endif; ?>
        <?php if($fi==1): ?>
        <a href="index.php?filter=1"
                class="btn btn-dark">Engineering</a>
        <?php else: ?>
        <a href="index.php?filter=1" 
              class="btn btn-primary">Engineering</a>
        <?php endif; ?>
        <?php if($fi==2): ?>
        <a href="index.php?filter=2"
                class="btn btn-dark">CS</a>
        <?php else: ?>
        <a href="index.php?filter=2" 
              class="btn btn-primary">CS</a>
        <?php endif; ?>
        <?php if($fi==3): ?>
        <a href="index.php?filter=3"
                class="btn btn-dark">Data Science</a>
        <?php else: ?>
        <a href="index.php?filter=3" 
              class="btn btn-primary">Data Science</a>
        <?php endif; ?>
        <?php if($fi==4): ?>
        <a href="index.php?filter=4"
                class="btn btn-dark">Business/Economics</a>
        <?php else: ?>
        <a href="index.php?filter=4" 
              class="btn btn-primary">Business/Economics</a>
        <?php endif; ?>
        <?php if($fi==5): ?>
        <a href="index.php?filter=5"
                class="btn btn-dark">Pre-Med</a>
        <?php else: ?>
        <a href="index.php?filter=5" 
              class="btn btn-primary">Pre-Med</a>
        <?php endif; ?>
        <?php if($fi==6): ?>
        <a href="index.php?filter=6"
                class="btn btn-dark">PoliSci IR</a>
        <?php else: ?>
        <a href="index.php?filter=6" 
              class="btn btn-primary">PoliSci IR</a>
        <?php endif; ?>
        <?php if($fi==7): ?>
        <a href="index.php?filter=7"
                class="btn btn-dark">English/Liberal Arts</a>
        <?php else: ?>
        <a href="index.php?filter=7" 
              class="btn btn-primary">English/Liberal Arts</a>
        <?php endif; ?>
        <?php if($fi==8): ?>
        <a href="index.php?filter=8"
                class="btn btn-dark">BFA at Mainstream School</a>
        <?php else: ?>
        <a href="index.php?filter=8" 
              class="btn btn-primary">BFA at Mainstream School</a>
        <?php endif; ?>
      </div>
      <?php
        $mysqli = new mysqli('34.66.20.96', 'root', 'eddiecollege', 'userInfo') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM list WHERE user='$userid'") or die($mysqli->error);
      ?>
      <div class="row justify-content-center">
        <div class="col">
        <form id="select" method="POST">
        <table class="table">
        <thead>
          <tr>
            <th><button type="submit" class="btn btn-success" name="submit"><i class="fas fa-plus"></i></button></th>
            <th>School</th>
            <th>State</th>
            <th>Rank</th>
            <th>Engineering Rank</th>
            <th>Action</th>
          </tr>
        </thead>
        <?php if($fi == 1){
            $resultCol = $mysqli->query("SELECT * FROM schoollist WHERE engineering=1 ORDER BY schoollist.erank ASC") or die($mysqli->error);
            $resultLib = $mysqli->query("SELECT * FROM libschoollist WHERE engineering=1 ORDER BY libschoollist.erank ASC") or die($mysqli->error);
          } elseif($fi == 2){
            $resultCol = $mysqli->query("SELECT * FROM schoollist WHERE cs=1 ORDER BY schoollist.erank ASC") or die($mysqli->error);
            $resultLib = $mysqli->query("SELECT * FROM libschoollist WHERE cs=1 ORDER BY libschoollist.erank ASC") or die($mysqli->error);
          } elseif($fi == 3){
            $resultCol = $mysqli->query("SELECT * FROM schoollist WHERE ds=1 ORDER BY schoollist.rank ASC") or die($mysqli->error);
            $resultLib = $mysqli->query("SELECT * FROM libschoollist WHERE ds=1 ORDER BY libschoollist.rank ASC") or die($mysqli->error);
          } elseif($fi == 4){
            $resultCol = $mysqli->query("SELECT * FROM schoollist WHERE business=1 ORDER BY schoollist.rank ASC") or die($mysqli->error);
            $resultLib = $mysqli->query("SELECT * FROM libschoollist WHERE business=1 ORDER BY libschoollist.rank ASC") or die($mysqli->error);
          } elseif($fi == 5){
            $resultCol = $mysqli->query("SELECT * FROM schoollist WHERE premed=1 ORDER BY schoollist.rank ASC") or die($mysqli->error);
            $resultLib = $mysqli->query("SELECT * FROM libschoollist WHERE premed=1 ORDER BY libschoollist.rank ASC") or die($mysqli->error);
          } elseif($fi == 6){
            $resultCol = $mysqli->query("SELECT * FROM schoollist WHERE polisci=1 ORDER BY schoollist.rank ASC") or die($mysqli->error);
            $resultLib = $mysqli->query("SELECT * FROM libschoollist WHERE polisci=1 ORDER BY libschoollist.rank ASC") or die($mysqli->error);
          } elseif($fi == 7){
            $resultCol = $mysqli->query("SELECT * FROM schoollist WHERE english=1 ORDER BY schoollist.rank ASC") or die($mysqli->error);
            $resultLib = $mysqli->query("SELECT * FROM libschoollist WHERE english=1 ORDER BY libschoollist.rank ASC") or die($mysqli->error);
          } elseif($fi == 8){
            $resultCol = $mysqli->query("SELECT * FROM schoollist WHERE bfa=1 ORDER BY schoollist.rank ASC") or die($mysqli->error);
            $resultLib = $mysqli->query("SELECT * FROM libschoollist WHERE bfa=1 ORDER BY libschoollist.rank ASC") or die($mysqli->error);
          } else {
            $resultCol = $mysqli->query("SELECT * FROM schoollist ORDER BY schoollist.rank ASC") or die($mysqli->error);
            $resultLib = $mysqli->query("SELECT * FROM libschoollist ORDER BY libschoollist.rank ASC") or die($mysqli->error);
          }
         ?>
        <?php
          while ($row = $resultCol->fetch_assoc()): ?>
            <tr>
            <td><input type="checkbox" name='check[]' value = '<?php echo $row['id']; ?>'/></td>
            <td><?php echo $row['school']; ?></td>
            <td><?php echo $row['state']; ?></td>
            <td><?php ranking($row['rank']); ?></td>
            <td><?php echo $row['erank']; ?></td>
            <td>
              <a href="index.php?add=<?php echo $row['id']; ?>" 
                class="btn btn-success"><i class="fas fa-plus"></i></a>
            </td>
          </tr>
          <?php endwhile; ?>
          <?php
          while ($row = $resultLib->fetch_assoc()): ?>
            <tr>
            <td><input type="checkbox" name='check[]' value = '<?php echo $row['id']; ?>'/></td>
            <td><?php echo $row['school']; ?> (Liberal Arts)</td>
            <td><?php echo $row['state']; ?></td>
            <td><?php echo $row['rank']; ?></td>
            <td><?php echo $row['erank']; ?></td>
            <td>
              <a href="index.php?add=<?php echo $row['id']; ?>" 
                class="btn btn-success"><i class="fas fa-plus"></i></a>
            </td>
          </tr>
          <?php endwhile; ?>
        </table>
        </form>
        </div>
        <div class="col">
        <table class="table table-striped table-dark">
        <thead>
          <tr>
            <th>Schools Included <a href="#" data-toggle="modal" data-target="#popup" class="btn btn-success">Add New School</a></th>
          </tr>
        </thead>
        <?php
          while ($row = $result->fetch_assoc()): ?>
            <tr>
            <td><?php echo $row['school']; ?></td>
            <td><?php echo $row['state']; ?></td>
            <td>
            <a href="process.php?delete=<?php echo $row['id']; ?>"
                  class="btn btn-danger"><i class="fas fa-times"></i></a>
            </td>
          </tr>
          <?php endwhile; ?>
        </table>
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
        <label>School</label>
        <input type="text" name="school" class="form-control" 
          value="<?php echo $school; ?>" placeholder="Enter your school">
        </div>

        <div class="form-group">
        <label>State</label>
        <input type="text" name="state" class="form-control" 
        value="<?php echo $state; ?>" placeholder="Enter the state">
        </div>

        <div class="form-group">
        <label>Rank</label>
        <input type="text" name="rank" class="form-control" 
        value="<?php echo $rank; ?>" placeholder="Enter the rank">
        </div>

        <div class="form-group">
        <label>Selectivity</label>
        <select name="selecti" >
            <option value="">--Select</option>
            <option value="Reach">Reach</option>
            <option value="Target">Target</option>
            <option value="Safety">Safety</option>
        </select>
        </div>

        <div class="form-group">
        <label>Major</label>
        <input type="text" name="major" class="form-control" 
        value="<?php echo $major; ?>" placeholder="Enter the major">
        </div>

        <div class="form-group">
        <label>Desicion Plan</label>
        <select name="decision" >
            <option value="">--Select</option>
            <option value="Regular">Regular</option>
            <option value="ED">ED</option>
            <option value="EA">EA</option>
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
  <script src="../../js/util.js"></script>
  <script src="js/select.js"></script>
