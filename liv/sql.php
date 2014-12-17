<?php
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
?>
