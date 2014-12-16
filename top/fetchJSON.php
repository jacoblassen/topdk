<?php
  //require_once 'classes/review.php';
  require_once 'util/fetch.php';

  $data = FetchData::Fetch('XML');
  var_dump($data);
  echo '<br />';
  $JSON = json_encode($data);
  var_dump($JSON);
  $XML = new SimpleXMLElement('<root/>');
  echo '1';
  $track = $XML->addChild('track');
echo '1';
  print($XML->asXML());
?>
