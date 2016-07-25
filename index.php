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

  $app->map(['GET', 'PUT'], '/api/trips/{tripId}', function ($request, $response) use($app){
    $db = new DbHandler();
    $route = $request->getAttribute('route');
    $tripId = $route->getArgument('tripId');

    // if ($request->getMethod() == 'GET') {
      // Retrieve the tripname
      $newHeader = $response->withHeader('Content-type', 'application/json');
      $body = $response->getBody();
      $body->write($db->getTripName($tripId));
    // }
      return $response
    });

    $app->put('/api/trips/{tripId}/newName', function ($request, $resonse) use($app){
    // } else if ($request->getMethod() == 'PUT') {
      $db = new DbHandler();
      $route = $request->getAttribute('route');
      $tripId = $route->getArgument('tripId');

      // Update the tripname
      $tripName = $request->getParsedBody()['tripName'];

      $newHeader = $response->withHeader('Content-type', 'application/json');
      $body = $response->getBody();
      $body->write($db->setTripName($tripId, $tripName));
    // }
    return $response;
  });

  $app->delete('/api/trips/{tripId}/flights/{flightId}', function ($request, $response) use($app){
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
    $route = $request->getAttribute('route');
    $tripId = $route->getArgument('tripId');

    if ($request->getMethod() == 'GET') {
      // Retrieve list of flights for a trip
      $newHeader = $response->withHeader('Content-type', 'application/json');
      $body = $response->getBody();
      $body->write($db->getFlights($tripId));

    } else if ($request->getMethod() == 'POST'){
      // Add a flight to a trip
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
