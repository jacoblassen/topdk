<?php
  $server = "127.0.0.1";
  $user = "root";
  $password = "root";
  $database = "toppro";
  $port = "3306";

  //Create connection
  $conn = new mysqli($server, $user, $password, $database, $port);

  //Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";
?>
