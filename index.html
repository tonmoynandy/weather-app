<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache">
    <title>Page Title</title>
    <script src="assets/js/jquery-1.10.2.min.js" ></script>
    <script src="assets/bootstrap/js/bootstrap.min.js" ></script>
    <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyA4pJi1IXBJxNACc1DstGMyY1AxgJPlOsU&sensor=true"></script> 
<script type="text/javascript"> 
//<![CDATA[

     // global "map" variable
      var map = null;
      var marker = null;
      var browserSupportFlag =  new Boolean();
      
var infowindow = new google.maps.InfoWindow(
  { 
    size: new google.maps.Size(150,50)
  });

// A function to create the marker and set up the event window function 
function createMarker(latlng, name, html) {
    var contentString = html;
   
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        zIndex: Math.round(latlng.lat()*-100000)<<5
        });
        //console.log(latlng.lat()+"<>"+latlng.lng());
        var link = "action.php?lat="+latlng.lat()+"&lon="+latlng.lng();
       $(".goHeader").attr('href',link);
    google.maps.event.trigger(marker, 'click');    
    return marker;
}

 

function initialize() {
    
    var mapdiv = document.getElementById("map_canvas");
    mapResize(mapdiv) ;
  // create the map
  var myOptions = {
    zoom: 12,
    center: new google.maps.LatLng(43.907787,-79.359741),
    mapTypeControl: true,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(mapdiv,
                                myOptions);
  
  if(navigator.geolocation) {
    browserSupportFlag = true;
    
    navigator.geolocation.getCurrentPosition(function(position) {
      initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
      map.setCenter(initialLocation);
      marker = createMarker(initialLocation, "name", "<b>Location</b><br>"+initialLocation);
    }, function() {
      handleNoGeolocation(browserSupportFlag);
    });
  }
  // Browser doesn't support Geolocation
  else {
    browserSupportFlag = false;
    handleNoGeolocation(browserSupportFlag);
  }

  
 
  google.maps.event.addListener(map, 'click', function(event) {
	//call function to create marker
         if (marker) {
            marker.setMap(null);
            marker = null;
         }
	 marker = createMarker(event.latLng, "name", "<b>Location</b><br>"+event.latLng);
  });

}

function mapResize(mapElement) {
     mapElement.style.width = window.innerWidth+'px';
     mapElement.style.height = window.innerHeight+'px';
}

$(function(){
    $(window).resize(function () {
        initialize();
    });
    initialize();
})

//]]>
</script> </head>

<body>
<div class="container">
    <header >
        <h2>Search Location</h2>
        <a href="index.php" class="goHeader">Go</a>
    </header>
    <div id="wrapper">
        <div id="page-wrapper">
            <div id="map_canvas" style=""></div>
        </div>
    </div>
</div>

</body>
</html>
