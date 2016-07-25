<?php
  require_once ('db/DbHandler.php');
  require ('vendor/autoload.php');

  echo "Hello World";

  $db = new DbHandler();
  $result = $db->getFlights(3);
  echo </br>;
  echo pg_num_rows($result);
  echo </br>;
  while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
    foreach($line as $col_val){
      echo $col_val;
      echo </br>;
    }
  }
  pg_free_result($result);
?>
