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
      return convertResultToArray($result);
    }

    // Returns a trip's name based on a trip id; False on failure
    function getTripName($tripId) {
      $query = "SELECT name FROM trips
                WHERE trips.id = $tripId and
                      trips.owner = '$owner'";
      $result = pg_query($this->conn, $query);
      return convertResultToArray($result);
    }

    // Returns flights which correspond with a trip id; False on failure
    function getFlights($tripId) {
      $query = "SELECT start, dest FROM flights
                WHERE tripId = $tripId
                ORDER BY flightId";
      $result = pg_query($this->conn, $query);
      return convertResultToArray($result);
    }

    // Adds a flight to a trip; Returns false on failure
    function addFlight($tripId, $start, $dest){
      $query = "INSERT INTO flights (tripId, start, dest)
                VALUES ($tripId, '$start', '$dest')";
      $result = pg_query($this->conn, $query);
      return convertResultToArray($result);
    }

    // Removes a flight from a trip; Returns false on failure
    function removeFlight($tripId, $flightId) {
      $query = "DELETE FROM flights
                WHERE tripId = $tripId AND
                      flightId = $flightId";
      $result = pg_query($this->conn, $query);
      return convertResultToArray($result);
    }

    // Updates a trips name; Returns false on failure
    function updateTripName($tripId, $name){
      $query = "UPDATE trips SET name = '$name'
                WHERE id = $tripId";
      $result = pg_query($this->conn, $query);
      return convertResultToArray($result);
    }

    // Close the database connection
    function closeConnection(){
      pg_close($this->conn);
    }

    // Converts the database results to a standard array
    function convertResultToJSON($result) {
      $rows = [];
      while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)){
          $rows = $row;
      }
      return json_encode($rows);
    }
  }
?>
