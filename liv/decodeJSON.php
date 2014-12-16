<?php
  require_once 'conn.php';
  require_once 'jsv4-php/jsv4.php';
  echo '1';
  $data = file_get_contents('schemas/testString.json');
  $schema = file_get_contents('schemas/JSON.json');
  $validate = Jsv4::isValid(json_decode(json_encode($data)), json_decode(json_encode($schema)));
  var_dump($validate);
  //echo $data;
?>
