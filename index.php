<!DOCTYPE html>
<html>
<head>
<style>
#map {
    height: 800px;
    width: 90%;
}
</style>
<script><!-- will be fixed on next release -->
    <!-- Include this script if exports does not exists on window or -->
    <!-- the following error "ReferenceError: exports is not defined" -->
    <!-- before the cdn import -->
        var exports = {};
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.5.1/leaflet.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.5.1/leaflet.css">
<script src="https://unpkg.com/leaflet-drift-marker@1.0.3/lib/DriftMarker/Drift_Marker.js"></script>
</head>
<body>
<div id="map"></div>
</body>
<script>
	 	// We’ll add a tile layer to add to our map, in this case it’s a OSM tile layer.
	 	// Creating a tile layer usually involves setting the URL template for the tile images
	 	var osmUrl = 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
	 	    osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
	 	    osm = L.tileLayer(osmUrl, {
	 	        maxZoom: 18,
	 	        attribution: osmAttrib
	 	    });

	 	// initialize the map on the "map" div with a given center and zoom
	 	var map = L.map('map').setView([45.9432, 24.9668], 7).addLayer(osm);

		var marker = new Drift_Marker([46.566216, 26.894786], {
	 	        draggable: true,
	 	        title: "Resource location",
	 	        alt: "Resource Location",
	 	        riseOnHover: true
	 	    }).addTo(map)
	 	        .bindPopup("test").openPopup();

	 	// Script for adding marker on map click
	 	function onMapClick(e) {
         marker.slideTo(	e.latlng, {
                duration: 2000
              });
	 	}
	 	map.on('click', onMapClick);
    marker.slideTo(	[47.003861, 26.886866], {
      duration: 2000
    });
</script>
</html>