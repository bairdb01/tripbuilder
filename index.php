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

  $app->post('api/trip/{tripId}/addFlight', function ($request, $response) use($app){
    $db = new DbHandler();
    $route = $request->getAttribute('route');
    $tripId = $route->getArgument('tripId');
    $locations[] = $parsedBody = $request->getParsedBody();

    echo $locations[0];

    $newHeader = $response->withHeader('Content-type', 'text/html');
    $body = $response->getBody();
    $result = $db->addFlight($tripId, $locations[0], $locations[1]);
    if ($result)
      $body->write("True");
    $body->write("False");
    return $response;
  });

  $app->get('/api/trip/{tripId}/tripName', function ($request, $response) use($app){
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


  $app->run();
?>
