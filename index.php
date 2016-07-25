<?php
  require_once ('db/DbHandler.php');
  require ('vendor/autoload.php');

  echo "Hello World";

  $db = new DbHandler();
  addFlight(3, "rome", "brussels");
  $result = $db->getFlights(3);
  echo "</br>";
  echo pg_num_rows($result);
  echo "</br>";

  echo "<table>";
  while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
    echo "<tr>";
    foreach($line as $col_val){
      echo "<td>";
      echo $col_val;
      echo "</td></br>";
    }
    echo "</tr>";
  }
  echo "</table>";
  pg_free_result($result);
?>
