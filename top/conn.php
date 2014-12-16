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
  /*echo "Connected successfully";
  /* Kode taget "fra http://php.net/manual/en/mysqli.set-charset.php" */
  /*if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
  } else {
    printf("Current character set: %s\n", $mysqli->character_set_name());
  }
  echo '<br />'*/
?>
