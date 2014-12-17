<?php
  require_once 'conn.php';
  require_once 'jsv4-php/jsv4.php';

  $data = file_get_contents('http://192.168.10.10/fetchJSON.php');
  $schema = file_get_contents('schemas/JSON.json');

  $data = json_decode($data);
  $schema = json_decode($schema);

  $validate = Jsv4::isValid($data, $schema);

  var_dump($validate);
?>
