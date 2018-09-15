<?php include "../functions/account-session.php";?>
<!DOCTYPE html>
<html>
<head>
  <title>Home &bull; HeirloomNation</title>
  <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 700px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
	<?php include "../includes/libraries-in.php";?>
</head>
<body>
<?php include "cos-navbar.php";?>
<h3>My Google Maps Demo</h3>
    <!--The div element for the map -->
    <div id="map"></div>
    <script>
// Initialize and add the map
function initMap() {
 

  var barotac = {lat: 10.89, lng: 122.69};
  
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 15, center: barotac});
  
  var marker = new google.maps.Marker({position: barotac, map: map});
  
  var iconBase = "../web-images/";
        var icons = {
          tomato: {
            icon: iconBase + 'tomato.png'
          },
          corn: {
            icon: iconBase + 'corn.jpg'
          },
          banana: {
            icon: iconBase + 'banana.png'
          },
          eggplant: {
            icon: iconBase + 'eggplant.jpg'
          },
          mango: {
            icon: iconBase + 'mango.jpg'
          },
          rice: {
            icon: iconBase + 'rice.jpg'
          }

        };

        var features = [
          {
            position: new google.maps.LatLng(10.82, 122.60),
            type: 'tomato'
          }, {
            position: new google.maps.LatLng(10.87, 122.59),
            type: 'corn'
          }, {
            position: new google.maps.LatLng(10.78, 122.46),
            type: 'mango'
          }, {
            position: new google.maps.LatLng(10.98, 122.52),
            type: 'banana'
          }, {
            position: new google.maps.LatLng(11.00, 122.67),
            type: 'eggplant'
          }
          // , {
          //   position: new google.maps.LatLng(-33.91872, 151.23089),
          //   type: 'rice'
          // }, {
          //   position: new google.maps.LatLng(-33.91784, 151.23094),
          //   type: 'corn'
          // }, {
          //   position: new google.maps.LatLng(-33.91682, 151.23149),
          //   type: 'tomato'
          // }, {
          //   position: new google.maps.LatLng(-33.91790, 151.23463),
          //   type: 'info'
          // }, {
          //   position: new google.maps.LatLng(-33.91666, 151.23468),
          //   type: 'info'
          // }, {
          //   position: new google.maps.LatLng(-33.916988, 151.233640),
          //   type: 'info'
          // }, {
          //   position: new google.maps.LatLng(-33.91662347903106, 151.22879464019775),
          //   type: 'parking'
          // }, {
          //   position: new google.maps.LatLng(-33.916365282092855, 151.22937399734496),
          //   type: 'parking'
          // }, {
          //   position: new google.maps.LatLng(-33.91665018901448, 151.2282474695587),
          //   type: 'parking'
          // }, {
          //   position: new google.maps.LatLng(-33.919543720969806, 151.23112279762267),
          //   type: 'parking'
          // }, {
          //   position: new google.maps.LatLng(-33.91608037421864, 151.23288232673644),
          //   type: 'parking'
          // }, {
          //   position: new google.maps.LatLng(-33.91851096391805, 151.2344058214569),
          //   type: 'parking'
          // }, {
          //   position: new google.maps.LatLng(-33.91818154739766, 151.2346203981781),
          //   type: 'parking'
          // }, {
          //   position: new google.maps.LatLng(-33.91727341958453, 151.23348314155578),
          //   type: 'library'
          // }
        ];

        // Create markers.
        features.forEach(function(feature) {
          var marker = new google.maps.Marker({
            position: feature.position,
            icon: icons[feature.type].icon,
            map: map
          });
        });
}

var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';

    </script>
    
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXzpxFIITnUZ_md76OilTBiB9aPQmWagU&callback=initMap">
    </script>

<?php include "cos-footer.php";?>
</body>
</html>