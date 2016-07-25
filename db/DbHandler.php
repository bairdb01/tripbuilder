<?php
  class DbHandler {
    private $conn;

    function __construct(){
      require_once dirname(__FILE__) . "./DbConnect.php";
      // Open connection to database
      $db = new DbConnect();
      $this->conn = $db->connect();
    }

    // Returns a trip's name based on a given user id and trip id
    function getTripName($owner, $tripId) {
      $query = "SELECT name FROM trips
                WHERE trips.id = $id and
                      trips.owner = $owner";
      $result = pg_query($query)
        or die('Query failed: ' . pg_last_error());
      return $result;
    }

    // Returns flights which correspond with a trip id
    function getFlights($tripId) {
      $query = "SELECT * FROM flights
                INNER JOIN trips on flights.tripId = $tripId";
      $result = pg_query($query)
        or die('Query failed: ' . pg_last_error());
      return $result;
    }

    // Returns True on successful add
    function addFlight($tripId, $start, $dest){
      $row = array(
        "tripId"=>$tripId,
        "start"=>$start,
        "dest"=>$dest
      );
      return pg_insert($db, "flights", $row);
    }

    // Returns True on successful removal
    function removeFlight($tripId, $flightId) {
      $row = array(
        "tripId"=>$tripId,
        "flightId"=>$flightId
      );
      return pg_delete($db, "flights", $row);
    }

    // Returns True on successful update of a tripname
    function updateTripName($tripId, $name){
      $newName = array("name"=>$name);
      $condition = array(
        "tripId"=>$tripId
      );
      return pg_update($db, "trips", $newName, $condition);
    }

    // Returns an array of all the airports alphabetically
    function getAirports(){
      $query = "SELECT airport FROM iata_airport_codes
                ORDER BY airport";
      $result = pg_query($query)
        or die('Query failed: ' . pg_last_error());
      return $result;
    }
  }
?>
