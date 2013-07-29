<!DOCTYPE html>
 <?php

    $lon = 15.24593;
    $lat = 104.853931;
    $zoom = 12;

?>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta charset="utf-8">
    <link href="/maps/documentation/javascript/examples/default.css" rel="stylesheet">
    <style type="text/css">
      html { height: 100%; width: 100%;}    
      body { height: 100%; width: 100%;} /*margin: 0; padding: 0 }*/      
      #map-canvas { height: 100%; width: 100%; margin: auto; }    
      
    </style> 
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdvwF7XYm-l-CeqTLrwHQCjDbIxThB1As&sensor=true&libraries=places">
    </script>
    
    <script type="text/javascript">
      function initialize() {
      var mapOptions = {
          center: new google.maps.LatLng(15.24593, 104.853931),
          zoom: <?php echo $zoom;?>,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
            
       var map = new google.maps.Map(document.getElementById('map-canvas'), {
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  
  var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(-33.8902, 151.1759),
      new google.maps.LatLng(-33.8474, 151.2631));
  map.fitBounds(defaultBounds);
  
  
            
  

  var input = /** @type {HTMLInputElement} */(document.getElementById('target'));
  var searchBox = new google.maps.places.SearchBox(input);
  var markers = [];

  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });

      markers.push(marker);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });

  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
    }
    
     google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    
    
    <script type="text/javascript">
      function getLong () {
        var glong = document.getElementById('long').value;
        
        var mapOptions = {
          center: new google.maps.LatLng(glong, 102.826484),
          zoom: <?php echo $zoom;?>,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
              //16.430816,102.826484
    </script>
    
   
  </head>
  <body>
    <input type="text" name="long" id="long" value="16.430816" ></input>
    <button id="aa" type="button" onclick="getLong();">Click Me!</button>
    <div id="panel">    
      <center><input id="target" type="text" placeholder="Search Box"></input></center>
    </div>
      <div id="map-canvas"/></div>
     
  </body>
  
  
</html>