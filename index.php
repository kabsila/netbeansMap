<!DOCTYPE html>
 <?php

    $lon = 15.24593;
    $lat1 = 104.853931;
    $zoom = 12;
    
// Create connection
   $con=mysqli_connect("localhost","root","","testlatlong");

// Check connection
    if (mysqli_connect_errno($con))
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $result = mysqli_query($con,"SELECT * FROM forlatlong WHERE id='1'");
    
    
    while($row = mysqli_fetch_array($result))
      {
       $latt = $row['lat'];
       $longg = $row['long'];
       echo $row['lat'] . " " . $row['long'];
       echo "<br>";
      }

 
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
      //var mapOptions = {
      //    center: new google.maps.LatLng(15.24593, 104.853931),
       //   zoom: <?php echo $zoom;?>,
       //   mapTypeId: google.maps.MapTypeId.ROADMAP
       // };
        
       // var map = new google.maps.Map(document.getElementById("map-canvas"),
       //     mapOptions);
            
       var map = new google.maps.Map(document.getElementById('map-canvas'), {
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  
  var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(-33.8902, 151.1759),
      new google.maps.LatLng(-33.8474, 151.2631));
  map.fitBounds(defaultBounds);
  
  
            
  

  var input = /** @type {HTMLInputElement} */(document.getElementById('target'));
  var searchBox = new google.maps.places.SearchBox(input);  
  //var searchBox = new google.maps.places.SearchBox(latlong);
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
    <script>
function showUser(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    var str=xmlhttp.responseText;
    var n=str.indexOf(" ");
    var latt = str.substring(0,n);
    var longg = str.substring(n,str.Lengh);
    initialize2(latt,longg);
    }
  }
xmlhttp.open("GET","getdb.php?q="+str.value,true);
xmlhttp.send();
}
</script>
    
<script type="text/javascript">
      function initialize2(lat,long) {
        var mapOptions = {
          center: new google.maps.LatLng(lat,long),
          zoom: 13,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
      }
      google.maps.event.addDomListener(window, 'load', initialize2);
    </script>
</head>
<body>
        <form>
            <input type="text" name="txtId" id="txtId" value="">
            <input name="btnButton" id="btnButton" type="button" onclick="showUser(document.getElementById('txtId'))" value="Ajax">
        </form>
     <div id="txtHint"><b>Lat Long info will be listed here.</b></div>
    <input type="text" name="long" value=""></input>
    
    <div id="panel">    
      <center><input id="target" type="text" placeholder="Search Box" ></input></center>
    </div>
      <div id="map-canvas"/></div>
     
</body>
  
  
</html>