<?php
  class DbHandler {
    private $conn;

    function __construct(){
      require_once (__DIR__ . "/DbConnect.php");
      // Open connection to database
      $db = new DbConnect();
      $this->conn = $db->connect();
    }

    // Returns an array of all the airports alphabetically; False on failure
    function getAirports(){
      $query = "SELECT airport FROM iata_airport_codes
                ORDER BY airport";
      $result = pg_query($query);
      return $result;
    }

    // Returns a trip's name based on a given user id and trip id; False on failure
    function getTripName($owner, $tripId) {
      $query = "SELECT name FROM trips
                WHERE trips.id = $tripId and
                      trips.owner = '$owner'";
      $result = pg_query($query);
      return $result;
    }

    // Returns flights which correspond with a trip id; False on failure
    function getFlights($tripId) {
      $query = "SELECT start, dest FROM flights
                WHERE tripId = $tripId
                ORDER BY flightId";
      $result = pg_query($query);
      return $result;
    }

    // Returns True on successful add
    function addFlight($tripId, $start, $dest){
      $row = array(
        "tripId"=>$tripId,
        "start"=>$start,
        "dest"=>$dest
      );

      return pg_insert($this->conn, "flights", $row);
    }

    // Returns True on successful removal
    function removeFlight($tripId, $flightId) {
      $row = array(
        "tripId"=>$tripId,
        "flightId"=>$flightId
      );
      return pg_delete($this->conn, "flights", $row);
    }

    // Returns True on successful update of a tripname
    function updateTripName($tripId, $name){
      $newName = array("name"=>$name);
      $condition = array(
        "tripId"=>$tripId
      );
      return pg_update($this->conn, "trips", $newName, $condition);
    }
  }
?>
