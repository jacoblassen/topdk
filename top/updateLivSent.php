<?php
  require_once 'conn.php';

  $queryUpdate = "
    UPDATE review
    SET livSent = (SELECT NOW())
    WHERE livSent IS NULL AND id = ?";

    $stmt = $mysqli->prepare($queryUpdate);
    $stmt->bind_param('i', $_id);
    foreach ($_POST as $key => $value) {
      $_id = $value;
      $stmt->execute();
      echo $_id." has been updated <br /><br />";
    }
?>
