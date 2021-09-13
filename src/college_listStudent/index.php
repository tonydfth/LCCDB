<?php
	if (isset($_POST['search'])) {
		$response = "<ul><li>No data found!</li></ul>";

		$connection = new mysqli('34.66.20.96', 'root', 'eddiecollege', 'userInfo') or die(mysqli_error($mysqli));
		$q = $connection->real_escape_string($_POST['q']);

		$sql = $connection->query("SELECT school FROM schoollist WHERE school LIKE '%$q%'");
		if ($sql->num_rows > 0) {
			$response = "<ul>";

			while ($data = $sql->fetch_array())
				$response .= "<li>" . $data['name'] . "</li>";

			$response .= "</ul>";
		}


		exit($response);
	}
?>
<!DOCTYPE html>
  <head>
    
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>LCC database - collegeList</title>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <script type="text/javascript" src="../js/jquery.autocomplete.js"></script>
    <script language = "javascript">
            function deleteCheck(id){
              if(confirm("Are you sure you want to permanently delete the selected item?")){
                window.location.href='process.php?delete=' +id+'';
              }
            }
    </script>
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
    <script>
      $(document).ready(function () {
                $("#searchBox").keyup(function () {
                    var query = $("#searchBox").val();

                    if (query.length > 0) {
                        $.ajax(
                            {
                                url: 'index.php',
                                method: 'POST',
                                data: {
                                    search: 1,
                                    q: query
                                },
                                success: function (data) {
                                    $("#response").html(data);
                                },
                                dataType: 'text'
                            }
                        );
                    }
                });

                $(document).on('click', 'li', function () {
                    var school = $(this).text();
                    $("#searchBox").val(school);
                    $("#response").html("");
                });
            });
    </script>
    <style type="text/css">
            ul {
                float: left;
                list-style: none;
                padding: 0px;
                border: 1px solid black;
                margin-top: 0px;
            }

            input, ul {
                width: 250px;
            }

            li:hover {
                color: silver;
                background: #0088cc;
            }
    </style>
  </head>
  <html>
    <body>
    <div id="content">
    <?php require_once 'process.php'; ?>
    <div class="container">
        <a id="open" href="#" onclick="openSlideMenu()">
          <i class="fas fa-bars"></i>
        </a>
        <a href="../auth" class= 'btn btn-warning' id= "logout">Logout</a>
      <div id="menu" class="nav">
        <a href="#" id ="cross" class="close" onclick="closeSlideMenu()">
          <i class="fas fa-times"></i>
        </a>
        <a id="navItems" class="navbar-brand" href="../timelineStudent"><i class="fa fa-list-alt"></i>   Timeline</a>
        <a id="navItems" class="navbar-brand" href="../college_listStudent"><i class="fas fa-graduation-cap"></i>Colleges</a>
      </div>
      </div>

    <?php 
    if(isset($_SESSION['message'])):?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
    
      <?php
          echo $_SESSION['message'];
          unset($_SESSION['message']);
      ?>
    </div>
    <?php endif ?>
    <div class="container-table">
    <?php
        $mysqli = new mysqli('34.66.20.96', 'root', 'eddiecollege', 'userInfo') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM list WHERE user='$userid' AND lib = 0 ORDER BY list.rank ASC") or die($mysqli->error);
        $libresult = $mysqli->query("SELECT * FROM list WHERE user='$userid' AND lib = 1 ORDER BY list.rank ASC") or die($mysqli->error);
    ?>
    <p id="title">Colleges</p>
    <div class="box-table">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>School</th>
            <th>State</th>
            <th>Rank</th>
            <?php if ($focus == 1): ?>
            <th>Engineering Rank</th>
            <?php elseif ($focus == 2): ?>
            <th>Business Rank</th>
            <?php elseif ($focus == 0): ?>
            <?php else: ?>
              <th>Engineering Rank</th>
              <th>Business Rank</th>
            <?php endif; ?>
            <th>Selectivity</th>
            <th>Major</th>
            <th>Decision Plan</th>
            <th>Action  <a href="#" data-toggle="modal" data-target="#popup" class="btn btn-success"><i class="fas fa-plus"></i></a></th>
            </tr>
          </thead>
            <?php
                while ($row = $result->fetch_assoc()): ?>
              <?php if ($row['id'] != $id): ?>
                    <tr>
                        <td><?php echo $row['school']; ?></td>
                        <td><?php echo $row['state']; ?></td>
                        <td><?php UCconv($row['rank']); ?></td>
                        <?php if ($focus == 1): ?>
                          <td><?php rankConv($row['erank']); ?></td>
                          <?php elseif ($focus == 2): ?>
                          <td><?php rankConv($row['brank']); ?></td>
                          <?php elseif ($focus == 0): ?>
                          <?php else: ?>
                            <td><?php rankConv($row['erank']); ?></td>
                            <td><?php rankConv($row['brank']); ?></td>
                        <?php endif; ?>
                        <td><?php echo $row['selecti']; ?></td>
                        <td><?php echo $row['major']; ?></td>
                        <td><?php echo $row['decision']; ?></td>
                        <td>
                            <?php 
                            if($row['final'] == 1):
                            ?>
                            <a href="index.php?edit=<?php echo $row['id']; ?>"
                               class="btn btn-outline-success">Finalized</a>
                            <?php else: ?>
                              <a href="index.php?edit=<?php echo $row['id']; ?>"
                               class="btn btn-outline-info"><i class="fas fa-edit"></i></a>
                              <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                                class="btn btn-outline-danger"><i class="fas fa-times"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php else: ?>
            <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="final" value="<?php echo $final; ?>">
            <input type="hidden" name="school" value="<?php echo $school; ?>">
              <tr>
              <td><?php echo $row['school']; ?></td>
              <td><?php echo $row['state']; ?></td>
              <td><?php UCconv($row['rank']); ?></td>
              <?php if ($focus == 1): ?>
                <td><?php rankConv($row['erank']); ?></td>
                <?php elseif ($focus == 2): ?>
                <td><?php rankConv($row['brank']); ?></td>
                <?php elseif ($focus == 0): ?>
                <?php else: ?>
                  <td><?php rankConv($row['erank']); ?></td>
                  <td><?php rankConv($row['brank']); ?></td>
              <?php endif; ?>
              <td><?php echo $row['selecti']; ?></td>
            <td><input id="textbox" type="text" name="major" class="form-control" 
        value="<?php echo $major; ?>" placeholder="Enter the major"></td>
            <td><select name="decision" >
            <option value="<?php echo $row['decision']; ?>"><?php echo $row['decision']; ?></option>
            <option value="Regular">Regular</option>
            <option value="ED">ED</option>
            <option value="EA">EA</option>
        </select></td>
              <td>
              <?php 
                if($final == 1):
                ?>
                  <div class="form-group">
                    <button type="submit" class="btn btn-outline-info" name="update">Update</button>
                  </div>
                <?php else: ?>
                  <div class="form-group">
                    <button type="submit" class="btn btn-outline-info" name="update">Update</button>
                </div>
                <?php endif; ?>
              </td>
              </tr>
            </form> 
            <?php endif; ?>
            <?php endwhile; ?>
            <?php
                while ($row = $libresult->fetch_assoc()): ?>
              <?php if ($row['id'] != $id): ?>
                    <tr>
                        <td><?php echo $row['school']; ?> (Liberal Arts)</td>
                        <td><?php echo $row['state']; ?></td>
                        <td><?php UCconv($row['rank']); ?></td>
                        <?php if ($focus == 1): ?>
                          <td><?php rankConv($row['erank']); ?></td>
                          <?php elseif ($focus == 2): ?>
                          <td><?php rankConv($row['brank']); ?></td>
                          <?php elseif ($focus == 0): ?>
                          <?php else: ?>
                            <td><?php rankConv($row['erank']); ?></td>
                            <td><?php rankConv($row['brank']); ?></td>
                        <?php endif; ?>
                        <td><?php echo $row['selecti']; ?></td>
                        <td><?php echo $row['major']; ?></td>
                        <td><?php echo $row['decision']; ?></td>
                        <td>
                            <?php 
                            if($row['final'] == 1):
                            ?>
                            <a href="index.php?edit=<?php echo $row['id']; ?>"
                               class="btn btn-outline-success">Finalized</a>
                            <?php else: ?>
                              <a href="index.php?edit=<?php echo $row['id']; ?>"
                               class="btn btn-outline-info"><i class="fas fa-edit"></i></a>
                              <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                                class="btn btn-outline-danger"><i class="fas fa-times"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php else: ?>
          <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="final" value="<?php echo $final; ?>">
            <input type="hidden" name="school" value="<?php echo $school; ?>">
              <tr>
              <td><?php echo $row['school']; ?></td>
              <td><?php echo $row['state']; ?></td>
              <td><?php UCconv($row['rank']); ?></td>
              <?php if ($focus == 1): ?>
                <td><?php rankConv($row['erank']); ?></td>
                <?php elseif ($focus == 2): ?>
                <td><?php rankConv($row['brank']); ?></td>
                <?php elseif ($focus == 0): ?>
                <?php else: ?>
                  <td><?php rankConv($row['erank']); ?></td>
                  <td><?php rankConv($row['brank']); ?></td>
              <?php endif; ?>
              <td><?php echo $row['selecti']; ?></td>
            <td><input id="textbox" type="text" name="major" class="form-control" 
        value="<?php echo $major; ?>" placeholder="Enter the major"></td>
            <td><select name="decision" >
            <option value="<?php echo $row['decision']; ?>"><?php echo $row['decision']; ?></option>
            <option value="Regular">Regular</option>
            <option value="ED">ED</option>
            <option value="EA">EA</option>
        </select></td>
              <td>
              <?php 
                if($final == 1):
                ?>
                  <div class="form-group">
                    <button type="submit" class="btn btn-outline-info" name="update">Update</button>
                  </div>
                <?php else: ?>
                  <div class="form-group">
                    <button type="submit" class="btn btn-outline-info" name="update">Update</button>
                </div>
                <?php endif; ?>
              </td>
              </tr>
            </form> 
            <?php endif; ?>
            <?php endwhile; ?>         
        </table>
      </div>
      <div class="box-filters">
      <?php require_once 'process.php'; ?>
        Filters: 
        <?php if($fi==0): ?>
        <a href="index.php?filter=0"
                class="btn btn-secondary">All</a>
        <?php else: ?>
        <a href="index.php?filter=0" 
              class="btn btn-outline-secondary">All</a>
        <?php endif; ?>
        <?php if($fi==1): ?>
        <a href="index.php?filter=1"
                class="btn btn-secondary">Engineering</a>
        <?php else: ?>
        <a href="index.php?filter=1" 
              class="btn btn-outline-secondary">Engineering</a>
        <?php endif; ?>
        <?php if($fi==2): ?>
        <a href="index.php?filter=2"
                class="btn btn-secondary">CS</a>
        <?php else: ?>
        <a href="index.php?filter=2" 
              class="btn btn-outline-secondary">CS</a>
        <?php endif; ?>
        <?php if($fi==3): ?>
        <a href="index.php?filter=3"
                class="btn btn-secondary">Data Science</a>
        <?php else: ?>
        <a href="index.php?filter=3" 
              class="btn btn-outline-secondary">Data Science</a>
        <?php endif; ?>
        <?php if($fi==4): ?>
        <a href="index.php?filter=4"
                class="btn btn-secondary">Business/Economics</a>
        <?php else: ?>
        <a href="index.php?filter=4" 
              class="btn btn-outline-secondary">Business/Economics</a>
        <?php endif; ?>
        <?php if($fi==5): ?>
        <a href="index.php?filter=5"
                class="btn btn-secondary">Pre-Med</a>
        <?php else: ?>
        <a href="index.php?filter=5" 
              class="btn btn-outline-secondary">Pre-Med</a>
        <?php endif; ?>
        <?php if($fi==6): ?>
        <a href="index.php?filter=6"
                class="btn btn-secondary">PoliSci IR</a>
        <?php else: ?>
        <a href="index.php?filter=6" 
              class="btn btn-outline-secondary">PoliSci IR</a>
        <?php endif; ?>
        <?php if($fi==7): ?>
        <a href="index.php?filter=7"
                class="btn btn-secondary">English/Liberal Arts</a>
        <?php else: ?>
        <a href="index.php?filter=7" 
              class="btn btn-outline-secondary">English/Liberal Arts</a>
        <?php endif; ?>
        <?php if($fi==8): ?>
        <a href="index.php?filter=8"
                class="btn btn-secondary">BFA at Mainstream School</a>
        <?php else: ?>
        <a href="index.php?filter=8" 
              class="btn btn-outline-secondary">BFA at Mainstream School</a>
        <?php endif; ?>
        </div>
      <?php
        $mysqli = new mysqli('34.66.20.96', 'root', 'eddiecollege', 'userInfo') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM list WHERE user='$userid'") or die($mysqli->error);
      ?>
        <div class="box-searchBox">
        <input type="text" placeholder="Search Query..." id="searchBox">
        <div id="response"></div>
        </div>
        <div class="box-collegeList">
        <form id="select" method="POST">
        <table class="table">
        <thead>
          <tr>
            <th><button type="submit" class="btn btn-success" name="submit">Add All</button></th>
            <th>School</th>
            <th>State</th>
            <th>Rank</th>
            <?php if ($fi == 4): ?>
              <th>Business Rank</th>
            <?php else: ?>
              <th>Engineering Rank</th>
            <?php endif; ?>
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
            $resultCol = $mysqli->query("SELECT * FROM schoollist WHERE business=1 ORDER BY schoollist.brank ASC") or die($mysqli->error);
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
            <?php 
                      $x++; 

                      $class = ($x%2 == 0)? 'table-default': 'table-info';

                      echo "<tr class='$class'>";
                ?>
            <td><input type="checkbox" name='check[]' value = '<?php echo $row['id']; ?>'/></td>
            <td><?php echo $row['school']; ?></td>
            <td><?php echo $row['state']; ?></td>
            <td><?php UCconv($row['rank']); ?></td>
            <?php if ($fi == 4): ?>
            <td><?php rankConv($row['brank']); ?></td>
            <?php else: ?>
            <td><?php rankConv($row['erank']); ?></td>
            <?php endif; ?>
            <td>
              <a href="index.php?add=<?php echo $row['id']; ?>" 
                class="btn btn-success"><i class="fas fa-plus"></i></a>
            </td>
          </tr>
          <?php endwhile; ?>
          <?php
          while ($row = $resultLib->fetch_assoc()): ?>
            <?php 
                      $x++; 

                      $class = ($x%2 == 0)? 'table-default': 'table-info';

                      echo "<tr class='$class'>";
                ?>
            <td><input type="checkbox" name='check[]' value = '<?php echo $row['id']; ?>'/></td>
            <td><?php echo $row['school']; ?> (Liberal Arts)</td>
            <td><?php echo $row['state']; ?></td>
            <td><?php UCconv($row['rank']); ?></td>
            <td><?php rankConv($row['erank']); ?></td>
            <td>
              <a href="index.php?add=<?php echo $row['id']; ?>" 
                class="btn btn-success"><i class="fas fa-plus"></i></a>
            </td>
          </tr>
          <?php endwhile; ?>
        </table>
        </form>
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
        <input type="number" name="rank" class="form-control" 
         value="0" placeholder="Enter the rank">
        </div>

        <div class="form-group">
        <label>Engineering Rank</label>
        <input type="number" name="erank" class="form-control" 
         value="0" placeholder="Enter the rank">
        </div>

        <div class="form-group">
        <label>Selectivity</label>
        <select name="selecti" >
        <option value="">Empty</option>
            <option value="Reach">Reach</option>
            <option value="Reach/Target">Reach/Target</option>
            <option value="Target/Reach">Target/Reach</option>
            <option value="Target">Target</option>
            <option value="Target/Safety">Target/Safety</option>
            <option value="Safety/Target">Safety/Target</option>
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
    </body>

  <!-- jQuery -->
  <script
    src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"
  ></script>

  <!-- Scripts -->
  <script src="../js/util.js"></script>
  <script src="js/college_list.js"></script>
</html>
