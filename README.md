###README
An airlines trip planner API, which supports the following requests:  
  - Gets a list of all airports (Alphabetically)  
    GET /api/airports

  - List all flights for a trip  
    GET /api/trips/{tripId}

  - Add a flight to a trip

  POST /api/trips/3/flights HTTP/1.1
  Content-Type:   application/x-www-form-urlencoded  

  start=London&dest=Paris

  - Remove a flight from a trip  
    DELETE /api/trips/{tripId}/flights/{flightIdToRemove}

  - Gets trip name  
      GET /api/trips/{tripId}

  - Rename a trip
    PUT /api/trips/{tripId}
    Content-Type:   application/x-www-form-urlencoded  

    name=NewName  

###Installation
  Make sure to have at least PHP v5.4.3
  Deploy trip_builder on an Apache2 server
    - Make sure to Allow .htaccess files through AllowOverride all in the apache.conf
  By default all requests will be routed to index.php

  Utilizes Composer to manage php packages
    php composer.phar  

###Testing
  Can utlize Postman or cURL to test requests to the API

###Notes  
API + DB Hosted on Heroku
API can be accessed through https://tripbuilder1.herokuapp.com/

Airport Names + Codes Database from:
http://www.codediesel.com/data/international-airport-codes-download/
