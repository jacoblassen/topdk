<?php
  require_once 'util/fetch.php';

  $data = FetchData::Fetch('JSON');
  $JSON = json_encode($data, JSON_PRETTY_PRINT);
  $JSON = utf8_decode($JSON);
  print($JSON);
?>
