<?php
  require_once './db/DbHandler.php';

  $db = new DbHandler();
  $result = $db->getFlightsByTrip(0);

  echo "<table>\n";
  while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
      echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t<tr>\n";
  }
  echo "</table>\n";
  pg_free_result($result);
  pg_close($db->conn);
?>
