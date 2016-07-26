###README
An airlines trip planner API, which supports the following requests:  
  - Gets a list of all airports (Alphabetically)  
    GET /api/airports
      
    returns JSON [{"airportName", "airportCode"}]  
  
  - List all flights for a trip  
      GET /api/trips/{tripId}
  
      returns JSON [{"flightid": "2", "start": "paris", "dest": "london"}]  
  
  - Add a flight to a trip  
      POST /api/trips/3/flights HTTP/1.1  
      Content-Type:   application/x-www-form-urlencoded  
      start=London&dest=Paris  
        
      returns JSON [{"success": boolean}]  
  
  - Remove a flight from a trip  
      DELETE /api/trips/{tripId}/flights/{flightIdToRemove}  
      returns JSON [{"success" : boolean}]  
  
  - Gets trip name  
      GET /api/trips/{tripId}  
      returns JSON [{"name": "tripName", "id": int}]  
  
  - Rename a trip  
      PUT /api/trips/{tripId}  
      Content-Type:   application/x-www-form-urlencoded  
      name=NewName  
      
    returns JSON [{"success": boolean}]  
  
###Installation
  Make sure to have at least PHP v5.4.3
  Deploy trip_builder on an Apache2 server
    - Make sure to Allow .htaccess files through AllowOverride all in the apache.conf
  By default all requests will be routed to index.php

  Utilizes Composer to manage php packages (e.g. Slim)  
    php composer.phar  

###Testing
  Can utlize Postman or cURL to test requests to the API

###Notes  
API + DB Hosted on Heroku
API can be accessed through https://tripbuilder1.herokuapp.com/

Airport Names + Codes Database from:
http://www.codediesel.com/data/international-airport-codes-download/
