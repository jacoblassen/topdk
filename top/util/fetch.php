  <?php
    class FetchData {

      public static function Fetch(){
      require_once '../conn.php';
      require_once '../classes/review.php';

      $Array = [];
      $review;
      $itemList = [];
      $assocArray = [];
      $result;
      $fetchSelect = "
      SELECT id, fullName, cpr, email, tlf, contactTime, accidentDate, location, recieved, how, flowType FROM review WHERE livSent IS NULL";
      $fetchSelect01 = "
      SELECT id, valueName, itemValue, relation FROM reviewItem WHERE relation = ?";

        try{
        $stmt = $mysqli->prepare($fetchSelect);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $fullName, $cpr, $email, $tlf, $contactTime, $accidentDate, $location, $recieved, $how, $flowType);
        $stmt01 = $mysqli->prepare($fetchSelect01);
        $stmt01->bind_param('i', $_relation);
          while($stmt->fetch()){
            $_relation = $id;
            echo '</br>';
            $stmt01->execute();
            $stmt01->bind_result($itemId, $valueName, $valueItem, $relation);
            while($stmt01->fetch()){
              $assocArray += ['itemId'=> $itemId];
              $assocArray += ['valueName'=> $valueName];
              $assocArray += ['valueItem'=> $valueItem];
              $assocArray += ['relation'=> $relation];
              var_dump($assocArray);
            }
          }
        }

        catch(Exception $e){
          echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
      }
    }


      /*foreach ($reviewItems as $key => $value) {
      SELECT * FROM review WHERE livSent IS NULL
        $_relation = $id;
        $stmt->execute();      $fetch02 = "SELECT * FROM `review` INNER JOIN `reviewItem` ON reviewItem.relation=review.id WHERE `livSent` IS NULL ";*/
  ?>
