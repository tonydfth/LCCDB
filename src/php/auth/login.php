<?php
  // ---- Let PHP know we're using JSON
  header("Content-Type: application/json; charset=UTF-8");

  // ---- Start the session
  session_start();

  // ---- GET Query Data
  $username = $_GET["username"];
  $password = $_GET["password"];
  if (!isset($username) || !isset($password)) {
    echo json_encode("Please provide username and password");
    exit();
  }

  // ---- Connect to the database
  $DB_SERVER = "34.66.20.96";
  $DB_USER = "root";
  $DB_PASS = "eddiecollege";
  $DB_NAME = "userInfo";
  $mysqli = new mysqli($DB_SERVER, $DB_USER, $DB_PASS, $DB_NAME);

  if ($mysqli->errno) {
    echo json_encode(array("Connection Error"=>$mysqli->error));
    exit();
  }

  // ---- Create and execute the query
  $sql = "SELECT * FROM users WHERE username = '" . $username . "'";
  $results = $mysqli->query($sql);

  // ---- Exit if query failed
  if (!$results) {
    echo json_encode(array("Query Failed"=>$mysqli->error));
    exit();
  }

  // ---- Parse the response information
  $response;
	if (mysqli_num_rows($results) === 0)
    $response = array("status"=>200, "success"=>false, "description"=>"User does not exist");
  else {
    $row = $results->fetch_assoc();
    $storedPassword = $row["password"];
    $auth = $row["auth"];

    if ($storedPassword !== $password)
      $response = array("status"=>200, "success"=>false, "description"=>"Incorrect password");
    // ---- Update the session's tokenMap
    else {
      $date = new DateTime();
      $created = $date->getTimestamp();
      $accessToken = uniqid();
      if (!isset($_SESSION["tokenMap"]))
        $_SESSION["tokenMap"] = array($accessToken=>array("username"=>$username, "created"=>$created));
      else {
        // ---- Unset any values that already exist
        foreach($_SESSION["tokenMap"] as $t => $user) {
          if ($user["username"] === $username) {
            unset($_SESSION["tokenMap"][$t]);
            break;
          }
        }
        $_SESSION["tokenMap"][$accessToken] = array("username"=>$username, "created"=>$created);
      }
      if($auth == 1){
        $response = array("status"=>200, "success"=>true, "auth"=>false, "token"=>$accessToken);
      } else{      
        $response = array("status"=>200, "success"=>true, "auth"=>true, "token"=>$accessToken);
      }
      $_SESSION['userid'] = $username;
      $_SESSION['staffid'] = $username;
    }
  }

  // ---- Send back the response
  echo json_encode($response);

  // ---- Close the database connection
  $mysqli->close();
