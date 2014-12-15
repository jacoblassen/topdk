<?php
  class Review {

    var $id;
    var $name;
    var $cpr;
    var $email;
    var $tlf;
    var $contactTime;
    var $accidentDate;
    var $location;
    var $received;
    var $how;
    var $flowType;
    var $reviewItems;

    public function __construct(
      $id,
      $name,
      $cpr,
      $email,
      $tlf,
      $contactTime,
      $accidentDate,
      $location,
      $received,
      $how,
      $flowType,
      $reviewItems
    ){
      $this->id = $id;
      $this->name = $name;
      $this->cpr = $cpr;
      $this->email = $email;
      $this->tlf = $tlf;
      $this->contactTime = $contactTime;
      $this->accidentDate = $accidentDate;
      $this->location = $location;
      $this->received = $received;
      $this->how = $how;
      $this->flowType = $flowType;
      $this->reviewItems = $reviewItems;
    }
  }
?>
