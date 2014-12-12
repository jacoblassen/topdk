<?php
  $server = "127.0.0.1";
  $user = "root";
  $password = "root";
  $database = "toppro";
  $port = "3306";

  //Create connection
  $mysqli = new mysqli($server, $user, $password, $database, $port);

  //Check connection
  if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
  }
  echo "Connected successfully";
?>
