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
      $query = "SELECT airport, code FROM iata_airport_codes
                ORDER BY airport";
      $result = pg_query($this->conn, $query);
      return $this->resultToJSON($result);
    }

    // Returns a trip's name based on a trip id; False on failure
    function getTrip($tripId) {
      $query = "SELECT name, id FROM trips
                WHERE trips.id = $tripId";
      $result = pg_query($this->conn, $query);
      return $this->resultToJSON($result);
    }

    // Returns flights which correspond with a trip id; False on failure
    function getFlights($tripId) {
      $query = "SELECT flightId, start, dest FROM flights
                WHERE tripId = $tripId
                ORDER BY flightId";
      $result = pg_query($this->conn, $query);
      return $this->resultToJSON($result);
    }

    // Adds a flight to a trip;
    // Returns flightId of the added flight; false on failure
    function addFlight($tripId, $start, $dest){
      $start = pg_escape_string($start);
      $dest = pg_escape_string($dest);
      $query = "INSERT INTO flights (tripId, start, dest)
                VALUES ($tripId, '$start', '$dest')
                RETURNING flightid";
      $result = pg_query($this->conn, $query);
      return $this->resultToJSON($result);
    }

    // Removes a flight from a trip;
    // Returns false on failure
    function removeFlight($tripId, $flightId) {
      $query = "DELETE FROM flights
                WHERE tripId = $tripId AND
                      flightId = $flightId";
      $result = pg_query($this->conn, $query);
      $result = $this->successJSON($result);
      return json_encode($result, JSON_PRETTY_PRINT);;
    }

    // Updates a trips name; Returns false on failure
    function setTripName($tripId, $name){
      $name = pg_escape_string($name);
      $query = "UPDATE trips SET name = '$name'
                WHERE id = $tripId";
      $result = pg_query($this->conn, $query);
      $result = $this->successJSON($result);
      return json_encode($result, JSON_PRETTY_PRINT);;
    }

    // Converts the database results to a standard array
    function resultToJSON($result) {
      $rows = array();
      while ($row = pg_fetch_assoc($result)){
          $rows[] = $row;
      }
      $this->freeResults($result);
      return json_encode($rows, JSON_PRETTY_PRINT);
    }

    function successJSON($result){
      $val = array();
      $val["success"] = ($result) ? true : false;
      return $val;
    }

    // Close the database connection
    function closeConnection(){
      pg_close($this->conn);
    }

    // Free results
    function freeResults($result){
      pg_free_result($result);
    }
  }
?>
