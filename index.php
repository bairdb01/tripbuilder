<?php
  require_once ('db/DbHandler.php');
  require ('vendor/autoload.php');
  use Psr\Http\Message\ServerRequestInterface;
  use Psr\Http\Message\ResponseInterface;

  $app = new \Slim\App();

  $app->get('/api/getAirports', function($request, $response) use($app){
    $db = new DbHandler();
    $newHeader = $response->withHeader('Content-type', 'application/json');
    $body = $response->getBody();
    $body->write($db->getAirports());
    return $response;
  });

  $app->any('/api/trips/{tripId}', function ($request, $response) use($app){
    $db = new DbHandler();
    if ($request->getMethod() == 'GET') {
      // Retrieve the tripname
      $route = $request->getAttribute('route');
      $tripId = $route->getArgument('tripId');

      $newHeader = $response->withHeader('Content-type', 'application/json');
      $body = $response->getBody();
      $body->write($db->getTripName($tripId));

    } else if ($request->getMethod() == 'PUT') {
      // Update the tripname
      $route = $request->getAttribute('route');
      $tripId = $route->getArgument('tripId');
      $tripName = $request->getParsedBody()['tripName'];

      $newHeader = $response->withHeader('Content-type', 'application/json');
      $body = $response->getBody();
      $body->write($db->setTripName($tripId, $tripName));
    }

    return $response;
  });

  $app->delete('/api/trip/{tripId}/flights/{flightId}', function ($request, $response) use($app){
    // Delete a flight from a trip
    $db = new DbHandler();
    $route = $request->getAttribute('route');
    $tripId = $route->getArgument('tripId');
    $flightId = $route->getArgument('flightId');

    $newHeader = $response->withHeader('Content-type', 'application/json');
    $body = $response->getBody();
    $body->write($db->removeFlight($tripId, $flightId));

    return $response;
  });

  $app->map(['GET', 'POST'], '/api/trips/{tripId}/flights', function ($request, $response) use($app){
    $db = new DbHandler();
    if ($response->getMethod() == 'GET') {
      // Retrieve list of flights for a trip
      $route = $request->getAttribute('route');
      $tripId = $route->getArgument('tripId');

      $newHeader = $response->withHeader('Content-type', 'application/json');
      $body = $response->getBody();
      $body->write($db->getFlights($tripId));

    } else if ($response->getMethod() == 'POST'){
      // Add a flight to a trip
      $route = $request->getAttribute('route');
      $tripId = $route->getArgument('tripId');
      $start = $request->getParsedBody()['start'];
      $dest = $request->getParsedBody()['dest'];

      $newHeader = $response->withHeader('Content-type', 'application/json');
      $body = $response->getBody();
      $result = $db->addFlight($tripId, $start, $dest);
    }
    return $response;
  });

  $app->run();
?>
