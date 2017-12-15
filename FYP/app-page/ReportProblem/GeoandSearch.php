<html>
      <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="theme.css">

        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200&subset=latin,latin-ext' rel='stylesheet' type='text/css'>


        <style type="text/css" media="screen">

        </style>
        <style>
          html, body, #map-canvas {
            margin: 0;
            padding: 0;
            height: 100%;
          }
          #target 
          {
            width: 10%; 
          }


        </style>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
 <script
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCB9kcH0PdYyVeYW-Ic3j7O8IbrGvHe5Jk&libraries=places&callback=initialize"
	async defer></script>
        <script>



          /*map*/
          // Enable the visual refresh
    google.maps.visualRefresh = true;
    var map;
   

                /*search*/

          function initialize() {

       map = new google.maps.Map(document.getElementById('map-canvas'), {
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
          /*end search*/
        </script>
        <script>
          /*geolocation*/
          var map;

    function geolocate() {
      var mapOptions = {
        zoom: 6,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
     
      // Try HTML5 geolocation
      if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var pos = new google.maps.LatLng(position.coords.latitude,
                                           position.coords.longitude);

          var infowindow = new google.maps.InfoWindow({
            map: map,
            position: pos,
            content: 'Current Location'
          });

          map.setCenter(pos);
        }, function() {
          handleNoGeolocation(true);
        });
      } else {
        // Browser doesn't support Geolocation
        handleNoGeolocation(false);
      }
    }

    function handleNoGeolocation(errorFlag) {
      if (errorFlag) {
        var content = 'Error: The Geolocation service failed.';
      } else {
        var content = 'Error: Your browser doesn\'t support geolocation.';
      }

      var options = {
        map: map,
        position: new google.maps.LatLng(60, 105),
        content: content
      };

      var infowindow = new google.maps.InfoWindow(options);
      map.setCenter(options.position);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
          /*/geolocation*/


        </script>

      </head>
      <body>
     <!--search dialog-->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script>
      $(function() {

        $( "#dialog-message" ).dialog({ autoOpen: false });
        $(' #dialog-message ').dialog({dialogClass:'search'});
        $( "#dialog-message" ).dialog({
        modal: true,
        });
    });
    </script>
    <style type="text/css" media="screen">
      .search { background:rgba(240, 255, 255, 0.4);}
      .ui-widget-header {font-family: source sans pro; background: white; border: none; border-radius: 0px}
      .pac-container {font-family: source sans pro !important; font-size: 20px !important; min-height: 20% !important}
    </style>

    <div style="font-family: source sans pro;" id="dialog-message" title="Download complete" class="draggable" >
        <p>
           <div id="panel" width="100%" height="100%">
             <input type="text" id="target" placeholder="Search Box" style="width: 100%; font-family: source sans pro; font-size: 20px; height: auto">
            </div>
    </div>
    <!--/search dialog--> 
   <table>
    <div id="map-canvas"></div>

    <table id="commandbar" width="100%" height="5%" cellspacing="0" valign="center" style="background-color:rgba(240, 255, 255, 0.4) ;position:fixed; bottom:0;">
        <tr height="2.5%">
          <td width="2.5%" height="2.5%" >
            <img src="browser_resources/close.png" class="button" onclick="window.close()" width="10em">
          </td>
          <td width="2.5%" height="2.5%" >
            <img src="browser_resources/new_window.png" class="button" onclick="window.open('maps.html','_blank', 'location=no, menubar=no, status=no, titlebar=no' )" width="100%">
          </td>
          <td width="1px"></td>
          <td width="1px" id="divider" bgcolor="#999999">
          </td>
          <td width="1px"></td>
          <td width="2.5%">
            <img src="maps_resources/Search.png" class="button" onclick="$( '#dialog-message' ).dialog( 'open' ); " width="100%">
          </td>
          <td width="2.5%">
            <img src="maps_resources/Search.png" class="button" onclick="geolocate()" width="100%">
          </td>
          <td width="95%"></td>
      </tr>
    </table>

  </body>
</html>