<?php
   require 'run.php';
   run();

?>

<!DOCTYPE html>
        <html>
        <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <style type="text/css">
          html { height: 100% }
          body { height: 100%; margin: 0; padding: 0 }
          #map_canvas { height: 100% }

          #map-canvas
        {
        height: 400px;
        width: 500px;
        }
        </style>

   </script>
        <script type="text/javascript">
        function initialize() {

            var myLatLng = new google.maps.LatLng( 44.56718739999999, 26.0835113 ),
                myOptions = {
                    zoom: 5,
                    center: myLatLng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                    },
                map = new google.maps.Map( document.getElementById( 'map-canvas' ), myOptions ),
                marker = new google.maps.Marker( {icon: {
                    url: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
                    // This marker is 20 pixels wide by 32 pixels high.
                    size: new google.maps.Size(20, 32),
                    // The origin for this image is (0, 0).
                    origin: new google.maps.Point(0, 0),
                    // The anchor for this image is the base of the flagpole at (0, 32).
                    anchor: new google.maps.Point(0, 32)
                }, position: myLatLng, map: map} );

            marker.setMap( map );
            moveBus( map, marker );

        }



        function moveBus( map, marker ) {
            setTimeout(() => {
                marker.setPosition( new google.maps.LatLng( 44.56718739999999, 26.0835113 ) );
                map.panTo( new google.maps.LatLng( 44.56297439999999, 25.9388214 ) );
            }, 1)

        };



        </script>
        </head>

        <body onload="initialize()">
        <script type="text/javascript">
        //moveBus();
        </script>

        <script src="http://maps.googleapis.com/maps/api/js?key=AIzsHJCRvRVs4ID9uESwftPaB3s9KPjSmLDsKYI"></script>

        //<script src="http://maps.googleapis.com/maps/api/js?sensor=AIzaSyB-W_sLy7VzaQNdckkY4V5r980wDR9ldP4"></script>
        <div id="map-canvas" style="height: 500px; width: 500px;"></div>



        </body>
        </html>