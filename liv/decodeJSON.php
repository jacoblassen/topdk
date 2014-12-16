<?php
  require_once 'conn.php';
  $data = file_get_contents('http://192.168.10.10/fetchJSON.php');
  $data = json_decode($data);
  
  var_dump($data);

?>
