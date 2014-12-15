<?php
  require_once 'review.php';

  $array = [];

  $array += ['name1' => 'val1'];
  $array += ['name2' => 'val2'];
  $array += ['name3' => 'val3'];

  $review = new review(
    1,
    'jacob',
    '1234567890',
    'j@j.dk',
    '12345678',
    'nu',
    '2014-10-10 00:00:00',
    'her',
    '2014-10-10 12:01:10',
    'something',
    'JSON',
    $array
  );

  var_dump($review);
  $name = $review->name;
?>
