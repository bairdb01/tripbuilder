<?php
  require_once ('db/DbHandler.php');
  require ('vendor/autoload.php');

  echo "Hello World";

  $db = new DbHandler();
  $result = $db->getTripName('ben', 3);
  echo "\n";
  echo pg_num_rows($result);
  echo "\n";
  while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
    foreach($line as $col_val){
      echo $col_val;
      echo "\n";
    }
  }
  pg_free_result($result);
?>
