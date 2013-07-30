<!DOCTYPE html>
<?php

    
// Create connection


 
?>


<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Polygon arrays</title>
    
     <style type="text/css">
      html { height: 100%; width: 100%;}    
      body { height: 100%; width: 100%;} /*margin: 0; padding: 0 }*/      
      #map-canvas { height: 100%; width: 100%; margin: auto; }    
      
    </style> 
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdvwF7XYm-l-CeqTLrwHQCjDbIxThB1As&sensor=true&libraries=places"></script>
   <script>
var map;
var myCenter=new google.maps.LatLng(51.508742,-0.120850);
var markers = [];
var geocoder;
var marker;
function initialize()
{
 google.maps.visualRefresh = true;    
 geocoder = new google.maps.Geocoder();
var mapProp = {
  center:myCenter,
  zoom:5,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

  map = new google.maps.Map(document.getElementById("map-canvas"),mapProp);

  google.maps.event.addListener(map, 'click', function(event) {
    placeMarker(event.latLng);
  });
}

function placeMarker(location) {    
  clearOverlays();
  markers = [];
  

  
   marker = new google.maps.Marker({
    position: location,
    animation: google.maps.Animation.DROP,
    map: map,
  });
  markers.push(marker);
    
    
    geocoder.geocode({'latLng': location}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[1]) {
        //map.setZoom(10);
        //marker = new google.maps.Marker({
        //    position: location,
        //    map: map
       // });
       
          } else {
        alert('No results found');
      }
    } else {
      alert('Geocoder failed due to: ' + status);
    }
    
     var infowindow = new google.maps.InfoWindow({
    content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng() + '<br>' + results[0].formatted_address
   //content: results[0].formatted_address
  });
  //infowindow.setContent(results[1].formatted_address);
  infowindow.open(map,marker);
  });
  
 
  
 }
 
 function setAllMap(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the overlays from the map, but keeps them in the array.
function clearOverlays() {
  setAllMap(null);
}

// Shows any overlays currently in the array.
function showOverlays() {
  setAllMap(map);
}

// Deletes all markers in the array by removing references to them.
function deleteOverlays() {
  clearOverlays();
  markers = [];
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>