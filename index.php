<?php
  require_once ('db/DbHandler.php');
  require ('vendor/autoload.php');

  echo "Hello World";

  $db = new DbHandler();
  $results = $db->getAirports();
  echo "<pre>"$results"</pre>";

  // $app = new \Slim\App;

  // $app->get('/api/getAirports', function(Request $request, Response $response){
  //   $response = $app->response();
  //   $response["Content-Type"] = "application/json";
  //   $response->body($db->getAirports());
  // });

  // $app->get('/api/trip/edit/{tripId}', function (Request $request, Response $response) {
  //
  // });
  // $app->run();
?>
