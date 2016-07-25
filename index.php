<?php
  require_once 'db/DbHandler.php';
  require 'vendor/autoload.php';

  echo "Hello World";

  $db = new DbHandler();
  $result = $db->getAirports();
  echo pg_num_rows($result);

  while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
    echo $line;
  }
  pg_free_result($result);
?>
