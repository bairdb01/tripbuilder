<?php
  require_once ('db/DbHandler.php');
  require ('vendor/autoload.php');
  use Psr\Http\Message\ServerRequestInterface;
  use Psr\Http\Message\ResponseInterface;

  $app = new \Slim\App();

  $app->get('/api/trip/edit/getAirports', function($request, $response) use($app){
    $db = new DbHandler();
    $newHeader = $response->withHeader('Content-type', 'application/json');
    $body = $response->getBody();
    body->write($db->getAirports());
    return $response;
  });

  // $app->get('/api/trip/edit/{tripId}', function (Request $request, Response $response) {
  //   $response = $app->response(200);
  //   $response["Content-Type"] = "application/json";
  //   $response->body($db->getTripName((int)$args['tripId']));
  //   return $response;
  // });

  $app->run();
?>
