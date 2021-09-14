.<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../global.css" />
    <link rel="stylesheet" href="styles.css" />
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <title>Student Info Page </title>
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
  </head>
    <body>
        <?php require_once 'process.php'; ?>
        <?php
        $mysqli = new mysqli('34.66.20.96', 'root', 'database password', 'userInfo') or die(mysqli_error($mysqli));
        $tasks = $mysqli->query("SELECT * FROM currenTask WHERE user='$user'") or die($mysqli->error);
        ?>
      <div class = "container">
          
        <div class="row">
          <div class="col-md-4 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                  <div class="mt-3">
                    <h1>John Smith</h1>
                    <button class="btn btn-primary">Timeline</button>
                    <button class="btn btn-primary">Colleges</button>
                    <button class="btn btn-primary">Academics</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card mb-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Full Name</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    John Smith
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    JohnSmith@gmail.com
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Grade</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    11th
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">School</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    California High School
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card mb-3" style="height: 25rem;">
              <div class="card-body">
                <table class="table">
                <thead>
                  <tr>
                    <th><h4>Current Tasks:</h4></th>
                    <th><a href="#" data-toggle="modal" data-target="#addTask" class="btn btn-success"><i class="fas fa-plus"></i></a></th>
                  </tr>
                </thead>
                  <?php while ($row = $tasks->fetch_assoc()): ?>
                  <tr>
                    <td><?php echo $row['task']; ?></td>
                    <td>
                      <a href="#" onClick="deleteCheck(<?php echo $row['id']; ?>)" 
                      class="btn btn-outline-danger"><i class="fas fa-times"></i></a>
                    </td>
                  </tr>
                  <?php endwhile; ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id = "tabs">
        <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'Summer')">Summer Plan</button>
        <button class="tablinks" onclick="openTab(event, 'Research')">Faculty Research</button>
        <button class="tablinks" onclick="openTab(event, 'Interest')">Interest and Angle</button>
        <button class="tablinks" onclick="openTab(event, 'Accomplishments')">Accomplishments</button>
        <button class="tablinks" onclick="openTab(event, 'Minutes')">Meeting Minutes</button>
        </div>

        <div id="Summer" class="tabcontent">
        <h3>Summer Plan</h3>
        <table class="table">
        <thead>
          <tr>
            <th>Type</th>
            <th>Description</th>
            <th>Progess</th>
            <th>Date</th>
          </tr>
        </thead>
          <tr>
            <td>College Class</td>
            <td>Summer classes at Cornell University</td>
            <td>Applied</td>
            <td>5/6/2021<td>
          </tr>
          <tr>
            <td>Sport</td>
            <td>Tiger Woods Golf Camp at Stanford</td>
            <td>Accepted</td>
            <td>5/6/2021<td>
          </tr>
          <tr>
            <td>Volunteering</td>
            <td>HFH summer charity program in China</td>
            <td>Applying</td>
            <td>5/6/2021<td>
          </tr>
          <tr>
            <td>Educational Prep Program</td>
            <td>Center for talented youth at John Hopkins University</td>
            <td>Applied</td>
            <td>5/6/2021<td>
          </tr>
        </table>
        </div>

        <div id="Research" class="tabcontent">
        <h3>Faculty Research</h3>
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Biology Research
                </button>
              </h5>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                John did this research with Prof. at University of this. Research went on from this date to this date. Specifically, John did this, this, and that during the research.                 John did this research with Prof. at University of this. Research went on from this date to this date. Specifically, John did this, this, and that during the research.                 John did this research with Prof. at University of this. Research went on from this date to this date. Specifically, John did this, this, and that during the research.                 John did this research with Prof. at University of this. Research went on from this date to this date. Specifically, John did this, this, and that during the research.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Faculty research #2
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                John did this research with Prof. at University of this. Research went on from this date to this date. Specifically, John did this, this, and that during the research.                 John did this research with Prof. at University of this. Research went on from this date to this date. Specifically, John did this, this, and that during the research.                 John did this research with Prof. at University of this. Research went on from this date to this date. Specifically, John did this, this, and that during the research.                 John did this research with Prof. at University of this. Research went on from this date to this date. Specifically, John did this, this, and that during the research.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Faculty research #3
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                John did this research with Prof. at University of this. Research went on from this date to this date. Specifically, John did this, this, and that during the research.                 John did this research with Prof. at University of this. Research went on from this date to this date. Specifically, John did this, this, and that during the research.                 John did this research with Prof. at University of this. Research went on from this date to this date. Specifically, John did this, this, and that during the research.                 John did this research with Prof. at University of this. Research went on from this date to this date. Specifically, John did this, this, and that during the research.
              </div>
            </div>
          </div>
        </div>
        </div>

        <div id="Interest" class="tabcontent">
        <h3>Interest and Angle</h3>
        <div class="card">
          <div class="card-body">
            <p class="card-text">Scrollable textbox with student's interests and angle</p>
            <p class="card-text">Can be organized into bullet points</p>
          </div>
        </div>
        </div>

        <div id="Accomplishments" class="tabcontent">
        <h3>Accomplishments</h3>
        <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Date</th>
          </tr>
        </thead>
          <tr>
            <td>2019 Hackathon 2nd place</td>
            <td>Recieved 2nd place in 2019 sf hackathon</td>
            <td>8/6/2019<td>
          </tr>
          <tr>
            <td>AAU Most valueable player award</td>
            <td>Most valueable player on varsity basketball</td>
            <td>5/6/2019<td>
          </tr>
          <tr>
            <td>Outstanding Intern</td>
            <td>Recieved an outstanding intern award from interning at microsoft</td>
            <td>5/6/2017<td>
          </tr>
          <tr>
            <td>Piano Level 8</td>
            <td>Recieved level 8 certificate for Piano. This is the highest level</td>
            <td>5/6/2020<td>
          </tr>
        </table>
        </div>

        <div id="Minutes" class="tabcontent">
        <h3>Meeting Minutes</h3>
        <div class="row">
          <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">7/5/2021</a>
              <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">6/5/2021</a>
              <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">5/5/2021</a>
              <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">4/5/2021</a>
            </div>
          </div>
          <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">Notes for meeting on 7/5/2021</div>
              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">Notes for meeting on 6/5/2021</div>
              <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">Notes for meeting on 5/5/2021</div>
              <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">Notes for meeting on 4/5/2021</div>
            </div>
          </div>
        </div>
        </div>
      </div>
      <div class="modal fade" id="addTask">
        <div class="modal-dialog model">
          <div class="modal-content">
            <div class="modal-header">
              <h1>Add Task</h1>
            </div>
            <div class="modal-body">
              <form action="process.php" method="POST">
                <div class="form-group">
                  <label>Task: </label>
                  <input type="text" name="task" id="task" autocomplete="off" class="form-control" 
                  placeholder="Input task" required/>
                </div>
                <div class="form-group">
                  <button id="submit" type="submit" class="btn btn-outline-success" name="addTask">Save</button>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <input class="btn btn-danger" data-dismiss="modal" value="Close">
            </div>
          </div>
        </div>
      </div>
    </body>
    </html>
  <script
    src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"
  ></script>
  <script language = "javascript">
            function deleteCheck(id){
              if(confirm("Are you sure you want to permanently delete all records of this student?")){
                window.location.href='process.php?delete=' +id+'';
              }
            }
    </script>
  <script>
    function openTab(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    </script>
  <script src="../js/util.js"></script>
  <script src="js/roster.js"></script>
