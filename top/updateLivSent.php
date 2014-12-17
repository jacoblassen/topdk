<?php
  $queryUpdate = "
    UPDATE review
    SET livSent = (SELECT NOW())
    WHERE livSent IS NULL AND id = ?;"
?>
