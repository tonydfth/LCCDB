<?php
  // ---- Let PHP know we're using JSON
  header("Content-Type: application/json; charset=UTF-8");

  // ---- Start the session
  session_start();

  // ---- POST body Data
  $username = $_POST["username"];
  $password = $_POST["password"];
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
  $sql = "INSERT INTO users (username, password) VALUES('" . $username . "', '" . $password . "')";
  $results = $mysqli->query($sql);

  // ---- Exit if query failed
  if (!$results) {
    if (substr($mysqli->error, 0, 17) === "Duplicate entry '") {
      echo json_encode(array("status"=>200, "success"=>false, "description"=>"Username already exists"));
      exit();
    }
    echo json_encode(array("Query Failed"=>$mysqli->error));
    exit();
  }

  // ---- Validate the insertion
  $response;
	if ($results->affected_rows === 0)
    $response = array("status"=>200, "success"=>false, "description"=>"Insert failed");
  else
      $response = array("status"=>200, "success"=>true);

  // ---- Send back the response
  echo json_encode($response);

  // ---- Close the database connection
  $mysqli->close();
