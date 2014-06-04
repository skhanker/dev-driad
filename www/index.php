<html>
<head>
	<link rel="stylesheet"
	      href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.css" />
</head>
<body>
<div id="map" style="width: 1440px; height: 960px"></div>

<script src="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>

<script>
	<?
		$image_info = getimagesize("/var/www/html/dev-driad/www/tiles/map.jpg");
		echo "var w = {$image_info[0]}";
		echo "var h = {$image_info[1]}";
	 ?>
	var map = L.map('map').setView([0, 0], 2);
	L.tileLayer('tiles/{z}/{x}/{y}.png', {
		minZoom: 1,
		maxZoom: 4,
		attribution: 'The University of British Columbia',
		tms: true
	}).addTo(map);
</script>
</body>
</html>