<?php
  require_once 'util/fetch.php';

  $data = FetchData::Fetch('XML');
  $xml = new simpleXMLElement('<root/>');
  foreach($data as $object){
    $review = $xml->addChild('review');
    foreach($object as $reviewKey => $reviewValue){
      if(!(is_array($reviewValue))){
        $review->addChild($reviewKey, $reviewValue);
      }
      else{
        foreach($reviewValue as $assocArray){
          $item = $review->addChild('reviewItems');
          foreach($assocArray as $assocArrayKey => $assocArrayValue){
            $item->addChild($assocArrayKey, $assocArrayValue);
          }
        }
      }
    }
  }
  Header('Content-Type: text/xml; charset=utf-8');
  echo($xml->asXML());
?>
