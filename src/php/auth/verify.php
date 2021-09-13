<?php
  header("Content-Type: application/json; charset=UTF-8");

  // ---- Start the session
  session_start();

  $accessToken = $_GET["token"];
  $tokenMap = $_SESSION["tokenMap"];

  $date = new DateTime();
  $currentTimestamp = $date->getTimestamp();

  $validToken = isset($tokenMap) && isset($tokenMap[$accessToken]);
  $validTimestamp = $currentTimestamp - $tokenMap[$accessToken]["created"] < 48*60; // 48 hours

  echo json_encode(array("success"=> $validToken && $validTimestamp));
