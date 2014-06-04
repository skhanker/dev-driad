<html>
<head>
	<link rel="stylesheet"
	      href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.css" />
</head>
<body>
<div id="map" style="width: 960px; height: 600px"></div>

<script src="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>

<script>
	<?php
		$image_info = getimagesize("/var/www/html/dev-driad/www/tiles/map.jpg");
		echo "var w = {$image_info[0]};\n";
		echo "var h = {$image_info[1]};\n";
	 ?>
	document.getElementById("map").style.width = "100%";
	document.getElementById("map").style.height = "100%";

	var map = L.map('map',{
		crs: L.CRS.Simple,
		minZoom: 1,
		maxZoom: 4,
	}).setView([-90, -180], 4);

	var southWest = map.unproject([0, w], map.getMaxZoom());
	var northEast = map.unproject([h, 0], map.getMaxZoom());

	map.setMaxBounds(new L.LatLngBounds([90,180], [-90,-180]));

	L.tileLayer('tiles/{z}/{x}/{y}.png', {
		attribution: 'The University of British Columbia',
		tms: true,
		continuousWorld: false
	}).addTo(map);

</script>
</body>
</html>