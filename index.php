<?php
  require_once ('db/DbHandler.php');
  require ('vendor/autoload.php');

  echo "Hello World";

  $db = new DbHandler();
  $results = $db->getAirports();
  echo $results;

  $app = new \Slim\App;

  $app->get('/api/trip/edit/getAirports', function(Request $request, Response $response){
    $response = $app->response();
    $response["Content-Type"] = "application/json";
    $response->body($db->getAirports());
    return $response;
  });

  $app->get('/api/trip/edit/{tripId}', function (Request $request, Response $response) {
    $response = $app->response();
    $response["Content-Type"] = "application/json";
    $response->body($db->getTripName((int)$args['tripId']));
    return $response;
  });
  
  $app->run();
?>
