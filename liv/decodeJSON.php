<?php
  require_once 'conn.php';
  require_once 'jsv4-php/jsv4.php';
  require_once 'sql.php';

  //Get JSON data and schema
  $data = file_get_contents('http://192.168.10.10/fetchJSON.php');
  $schema = file_get_contents('schemas/JSON.json');

  //Decode JSON data and schema to get a PHP object
  //Jsv4 validate function expects both data and schema to be passed as PHP objects
  $data = json_decode($data);
  $schema = json_decode($schema);

  //Returns bool Value and accepts (Object) $data, (Object) $schema as parameters
  $validate = Jsv4::isValid($data, $schema);

  if($validate){
    //prepare statments, statements in "sql.php"
    $stmt01 = $mysqli->prepare($query01);
    $stmt02 = $mysqli->prepare($query02);

    //bind var to statement, value of variables will be set in review loop and item loop
    $stmt01->bind_param('sssssssss', $_name, $_cpr, $_email, $_tlf, $_tlfTime, $_accidentDate, $_where, $_how, $_flowType);
    $stmt02->bind_param('ssi', $_valueName, $_itemValue, $_relation);

    //loop though each recieved review
    $postData = [];
    $count = 0;
    foreach($data as $review) {
      //set SQL parameters
      $_name = $review->name;
      $_cpr = $review->cpr;
      $_email = $review->email;
      $_tlf = $review->tlf;
      $_tlfTime = $review->contactTime;
      $_accidentDate = $review->accidentDate;
      $_where = $review->where;
      $_how = $review->how;
      $_flowType = $review->flowType;

      //Generates post data to send to http://192.168.10.10/updateLivSent.php
      $postData += ['id'.$count => $review->id];
      $count++;

      //Execute
      $stmt01->execute();

      //set relation between reviewItem and review
      $_relation = $stmt01->insert_id;

      //stores array of items in variable
      $reviewItems = $review->reviewItems;

      //loop though each item associated with the review and sets name and value
      foreach($reviewItems as $item) {
        $_valueName = $item->itemName;
        $_itemValue = $item->itemValue;
        $stmt02->execute();
      }
    }

    // Code taken "from http://stackoverflow.com/questions/5647461/how-do-i-send-a-post-request-with-php"
    // Create http POST request that will be send to Toppro server's, updateLivSent.php
    $url = 'http://192.168.10.10/updateLivSent.php';
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($postData),
        ),
    );
    $context  = stream_context_create($options);

    //Send POST request
    $result = file_get_contents($url, false, $context);

    var_dump($result);
  }
  else{
    echo 'NOT VALID!';
  }
?>
