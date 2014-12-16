<?php
  class FetchData {

    public static function Fetch($type){
    require_once '../conn.php';
    require_once '../classes/review.php';


    $array = [];
    $review;
    $itemList = [];
    $assocArray = [];
    $result;
    $fetchSelect = "
    SELECT
      id,
      fullName,
      cpr,
      email,
      tlf,
      contactTime,
      accidentDate,
      location,
      recieved,
      how,
      flowType
    FROM review
    WHERE livSent IS NULL AND flowType = ?";

    $fetchSelect01 = "
    SELECT
      id,
      valueName,
      itemValue,
      relation
    FROM reviewItem
    WHERE relation = ?";

      try{
      $stmt = $mysqli->prepare($fetchSelect);
      $stmt->bind_param('s', $type);
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result($id, $fullName, $cpr, $email, $tlf, $contactTime, $accidentDate, $location, $recieved, $how, $flowType);
      $stmt01 = $mysqli->prepare($fetchSelect01);
      $stmt01->bind_param('i', $_relation);
        while($stmt->fetch()){
          //Reset and construct new itemList
          $itemList = [];
          $_relation = $id;
          $stmt01->execute();
          $stmt01->bind_result($itemId, $itemName, $itemValue, $itemRelation);
          while($stmt01->fetch()){
            //reset and construct new assocArray
            $assocArray = [];
            $assocArray += ['itemId' => $itemId];
            $assocArray += ['itemName' => $itemName];
            $assocArray += ['itemValue' => $itemValue];
            $assocArray += ['itemRelation' => $itemRelation];
            //add reviewItem to itemList
            array_push($itemList, $assocArray);
          }
          //clear old review object and create new one
          $review = new Review(
            $id,
            $fullname,
            $cpr,
            $email,
            $tlf,
            $contactTime,
            $accidentDate,
            $location,
            $recieved,
            $how,
            $flowType,
            $itemList
          );
          array_push($array, $review);
        }
        var_dump($array);
      }

      catch(Exception $e){
        echo 'Caught exception: ',  $e->getMessage(), "\n";
      }
    }
  }
?>
