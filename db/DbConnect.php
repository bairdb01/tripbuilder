<?php
class DbConnnect {
  private $conn;

  // Connect to the database
  function connect(){
    $conn_string = "host=ec2-174-129-37-103.compute-1.amazonaws.com port=5432 dbname=d5i884hb69gdln user=diwtzmpjgjqfxk password=m24j2xLEl52xu-sR5W9QMp4A68";
    $this->conn = pg_connect ( $conn_string )
      or die('Could not connect: ' . pg_last_error());
  }
}
?>
