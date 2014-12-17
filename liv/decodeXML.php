<?php
  //$fetchXML = file_get_contents('http://192.168.10.10/fetchXML.php');
  //$xmlShow = simplexml_load_string($fetchXML);
  //echo $xmlShow;
  /*echo '</br>';
  echo '</br>';*/
  require_once 'conn.php';
  require_once 'sql.php';

  // Error msg for the validation
  function libxml_display_error($error)
  {
     $return = "<br/>\n";
     switch ($error->level) {
         case LIBXML_ERR_WARNING:
             $return .= "<b>Warning $error->code</b>: ";
             break;
         case LIBXML_ERR_ERROR:
             $return .= "<b>Error $error->code</b>: ";
             break;
         case LIBXML_ERR_FATAL:
             $return .= "<b>Fatal Error $error->code</b>: ";
             break;
     }
     $return .= trim($error->message);
     if ($error->file) {
         $return .=    " in <b>$error->file</b>";
     }
     $return .= " on line <b>$error->line</b>\n";

     return $return;
  }

  function libxml_display_errors() {
     $errors = libxml_get_errors();
     foreach ($errors as $error) {
         echo libxml_display_error($error);
     }
     libxml_clear_errors();
  }

  // Enable user error handling
  libxml_use_internal_errors(true);

  //Creates the object
  $xml = new DOMDocument();
  $xml->load('http://192.168.10.10/fetchXML.php');



  if (!$xml->schemaValidate('schema.xsd')) {
     echo '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
     libxml_display_errors();
  }
  else{
      $stmt = $mysqli->prepare($query01);
      $stmt01 = $mysqli->prepare($query02);

      $stmt->bind_param('sssssssss', $_name, $_cpr, $_email, $_tlf, $_contactTime, $_accidentDate, $_where, $_how, $_flowType);
      $stmt01->bind_param('ssi', $_valueName, $_itemValue, $_relation);

    $xmlSimple = file_get_contents('http://192.168.10.10/fetchXML.php');
    $xmlSimple = simplexml_load_string($xmlSimple);

    $postData = [];
    $count = 0;
    foreach($xmlSimple->review as $review){
      $_name = $review->name;
      $_cpr = $review->cpr;
      $_email = $review->email;
      $_tlf = $review->tlf;
      $_contactTime = $review->contactTime;
      $_accidentDate = $review->accidentDate;
      $_where = $review->where;
      $_how = $review->how;
      $_flowType = $review->flowType;
      $_id = $review->id;

      $postData += ['id'.$count => $_id.""];
      $count++;

      $stmt->execute();
      $_relation = $stmt->insert_id;
      $reviewItems = $review->reviewItems;
      foreach($reviewItems as $item){
            $_valueName = $item->itemName;
            $_itemValue = $item->itemValue;
            $stmt01->execute();
      }
    }
      $url = 'http://192.168.10.10/updateLivSent.php';

      // use key 'http' even if you send the request to https://...
      $options = array(
          'http' => array(
              'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
              'method'  => 'POST',
              'content' => http_build_query($postData),
          ),
      );
      $context  = stream_context_create($options);
      $result = file_get_contents($url, false, $context);

      var_dump($result);
  }
?>
