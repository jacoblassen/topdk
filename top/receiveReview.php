<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
  <body>
    <?php
      require_once 'conn.php';

      $name = $_POST['name'];
      unset($_POST['name']);

      $cpr = $_POST['cpr'];
      unset($_POST['cpr']);

      $email = $_POST['email'];
      unset($_POST['email']);

      $tlf = $_POST['tlf'];
      unset($_POST['tlf']);

      $tlfTime = $_POST['tlfTime'];
      unset($_POST['tlfTime']);

      $accidentDate = $_POST['accidentDate'];
      unset($_POST['accidentDate']);

      $where = $_POST['where'];
      unset($_POST['where']);

      $how = $_POST['how'];
      unset($_POST['how']);

      $flowType = $_POST['flowType'];
      unset($_POST['flowType']);

      $reviewItems = [];
      foreach ($_POST as $key => $value) {
        $reviewItems += [$key => $value];
      }

      $query01 = "
      INSERT INTO review
      (fullName, cpr, email, tlf, contactTime, accidentDate, location, how, flowType, recieved)
      Values
      (?, ?, ?, ?, ?, ?, ?, ?, ?, (SELECT NOW()))";

      $query02 = "
      INSERT INTO reviewItem
      (valueName, itemValue, relation)
      Values
      (?, ?, ?)";

      try {
        $stmt = $mysqli->prepare($query01);
        $stmt->bind_param('sssssssss', $name, $cpr, $email, $tlf, $tlfTime, $accidentDate, $where, $how, $flowType);
        $stmt->execute();
        $id = $mysqli->insert_id;
        $stmt->close();
      }
      catch(Exception $e){
        echo 'Caught exception: ',  $e->getMessage(), "\n";
      }

      try {
        $stmt = $mysqli->prepare($query02);
        $stmt->bind_param('ssi', $_valueName, $_itemValue, $_relation);
        foreach ($reviewItems as $key => $value) {
          $_valueName = $key;
          $_itemValue = $value;
          $_relation = $id;
          $stmt->execute();
        }
      }
      catch(Exception $e){
        echo 'Caught exception: ',  $e->getMessage(), "\n";
      }
    ?>
  </body>
</html>
