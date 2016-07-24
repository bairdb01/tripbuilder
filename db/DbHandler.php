<?php
  class DbHandler {
    private $conn;

    function __construct(){
      require_once dirname(__FILE__) . "./DbConnect.php";
      // Open connection to database
      $db = new DbConnect();
      $this->conn = $db->connect();
    }

    // Returns a trip based on a given id
    function getTrip(int $id) {
      // Performing a query
      $query = "SELECT * FROM trips
                WHERE trips.id = $id";
      $result = pg_query($query)
        or die('Query failed: ' . pg_last_error());
      return $result;
    }

    // Returns flights which correspond with a trip id
    function getFlightsByTrip(int $tripId) {
      // Performing a query
      $query = "SELECT * FROM flights
                INNER JOIN trips on flights.tripId = $tripId";
      $result = pg_query($query)
        or die('Query failed: ' . pg_last_error());
      return $result;
    }

  }
?>
