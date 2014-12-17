<?php
  //$fetchXML = file_get_contents('http://192.168.10.10/fetchXML.php');
  //$xmlShow = simplexml_load_string($fetchXML);
  //echo $fetchXML;
  /*echo '</br>';
  echo '</br>';*/

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
?>
