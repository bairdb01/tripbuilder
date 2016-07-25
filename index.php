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

  $app->get('/api/trip/{tripId}/trip', function ($request, $response) use($app){
    $db = new DbHandler();
    $route = $request->getAttribute('route');
    $tripId = $route->getArgument('tripId');

    $newHeader = $response->withHeader('Content-type', 'application/json');
    $body = $response->getBody();
    $body->write($db->getTripName($tripId));
    return $response;
  });

  $app->get('/api/trip/{tripId}/flight', function ($request, $response) use($app){
    $db = new DbHandler();
    $route = $request->getAttribute('route');
    $tripId = $route->getArgument('tripId');

    $newHeader = $response->withHeader('Content-type', 'application/json');
    $body = $response->getBody();
    $body->write($db->getFlights($tripId));
    return $response;
  });


  $app->post('api/trip/{tripId}/flight/', function ($request, $response) use($app){
    $db = new DbHandler();
    $route = $request->getAttribute('route');
    $tripId = $route->getArgument('tripId');t
    $start = $request->getParsedBody()['start'];
    $dest = $request->getParsedBody()['dest'];

    $newHeader = $response->withHeader('Content-type', 'text/html');
    $body = $response->getBody();
    $result = $db->addFlight($tripId, $start, $dest);
    if ($result)
      $body->write("True");
    $body->write("False");
    return $response;
  });

  $app->put('/api/trip/{tripId}/trip', function ($request, $response) use($app){
    $db = new DbHandler();
    $route = $request->getAttribute('route');
    $tripId = $route->getArgument('tripId');
    $tripName = $request->getParsedBody()['tripName'];

    $newHeader = $response->withHeader('Content-type', 'application/json');
    $body = $response->getBody();
    $body->write($db->setTripName($tripId, $tripName));
    return $response;
  });

  $app->delete('/api/trip/{tripId}/flight', function ($request, $response) use($app){
    $db = new DbHandler();
    $route = $request->getAttribute('route');
    $tripId = $route->getArgument('tripId');
    $flightId = $request->getParsedBody()['tripName'];

    $newHeader = $response->withHeader('Content-type', 'application/json');
    $body = $response->getBody();
    $body->write($db->removeFlight($tripId, $flightId));
    return $response;
  });



  $app->run();
?>
