<?php
  echo "Hello world!";

  $conn_string = "host=ec2-174-129-37-103.compute-1.amazonaws.com port=5432 dbname=d5i884hb69gdln user=diwtzmpjgjqfxk password=m24j2xLEl52xu-sR5W9QMp4A68";
  $db =  pg_connect ( $conn_string )
    or die('Could not connect: ' . pg_last_error());

  // Performing an SQL query
  $query = "SELECT * FROM flights";
  $result = pg_query($query)
    or die('Query failed: ' . pg_last_error());

  echo "<table>\n";
  while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
      echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t<tr>\n";
  }
  echo "</table>\n";
?>
