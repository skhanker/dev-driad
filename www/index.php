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
	document.getElementById("map").style.width = w/4 + "px";
	document.getElementById("map").style.height = h/2 + "px";
	var map = L.map('map',{
		minZoom: 1,
		maxZoom: 4,
		crs: L.CRS.Simple
	}).setView([50, 100], 3);
	var southWest = map.unproject([0, w], map.getMaxZoom());
	var northEast = map.unproject([h, 0], map.getMaxZoom());
	map.setMaxBounds(new L.LatLngBounds(southWest, northEast));
	L.tileLayer('tiles/{z}/{x}/{y}.png', {
		attribution: 'The University of British Columbia',
		tms: true,
		continuousWorld: true
	}).addTo(map);

	var m = {
		x: 102,
		y: 404
	};
	var marker = L.marker(map.unproject([m.x, m.y], map.getMaxZoom())).addTo(map);

</script>
</body>
</html>