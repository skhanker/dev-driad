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
		$image_info = getimagesize("/Library/Server/Web/Data/Sites/Default/dev-driad/www/tiles/map.jpg");
		echo "var w = {$image_info[0]};\n";
		echo "var h = {$image_info[1]};\n";
	 ?>
	document.getElementById("map").style.width = "100%";
	document.getElementById("map").style.height = "100%";

	var map = L.map('map',{
		//crs: L.CRS.Simple,
		minZoom: 1,
		maxZoom: 4
	}).setView([-0, -10], 4);

	var southWest = map.unproject([0, w], map.getMaxZoom());
	var northEast = map.unproject([h, 0], map.getMaxZoom());

	//map.setMaxBounds(new L.LatLngBounds([90,180], [-90,-180]));

	L.tileLayer('tiles/{z}/{x}/{y}.png', {
		attribution: 'The University of British Columbia',
		tms: true,
		continuousWorld: false,
		noWrap: true
	}).addTo(map);

	var marker = L.marker([51.5, -0.09]).addTo(map);

	var circle = L.circle([51.508, -0.11], 5000, {
		color: 'red',
		fillColor: '#f03',
		fillOpacity: 0.5
	}).addTo(map);

	var polygon = L.polygon([
		[51.509, -0.08],
		[61.503, -0.06],
		[41.51, -0.047]
	]).addTo(map);

	marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();

</script>
</body>
</html>