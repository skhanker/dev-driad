<html>
<head>
	<link rel="stylesheet"
	      href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.css" />
</head>
<body>
<div id="map" style="width: 960px; height: 600px"></div>

<script src="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>

<script>

	//document.getElementById("map").style.width = "100%";
	//document.getElementById("map").style.height = "100%";
	<?php
		$iinfo = getimagesize("/var/www/html/dev-driad/www/tiles/{$_REQUEST['image']}.jpg.png");

		echo "var image = 'tiles/{$_REQUEST['image']}/';";
		echo "var w = {$iinfo[0]};";
		echo "var h = {$iinfo[1]};";
    ?>
	var map = L.map('map',{
		crs: L.CRS.Simple,
		maxZoom: 4,
		minZoom: 0,
		continuousWorld: true
	});

	var southWest = map.unproject([0, h], map.getMaxZoom());
	var northEast = map.unproject([w, 0], map.getMaxZoom());
	var mapBounds = new L.LatLngBounds(southWest, northEast);

	map.fitBounds([[actualY(map.getMaxZoom(),mapBounds._southWest.lat),mapBounds._southWest.lng],[actualY(map.getMaxZoom(),mapBounds._northEast.lat),mapBounds._northEast.lng]]);

	map.setView([0,actualY(map.getMaxZoom(),0)], 4);

	//map.setMaxBounds(new L.LatLngBounds([90,180], [-90,-180]));

	L.tileLayer(image + 'tiles/{z}/{x}/{y}.png', {
		attribution: 'The University of British Columbia',
		tms: true,
		continuousWorld: true,
		noWrap: true
	}).addTo(map);

	var m = {
		t: 411,
		l: actualY(map.getMaxZoom(),893),
		b: 1325,
		r: actualY(map.getMaxZoom(),955)
	};

	var bounds = new L.LatLngBounds([map.unproject([m.t, m.l], map.getMaxZoom()), map.unproject([m.b, m.r], map.getMaxZoom())]);

	// create an orange rectangle
	L.rectangle([[actualY(map.getMaxZoom(),bounds._southWest.lat),bounds._southWest.lng],[actualY(map.getMaxZoom(),bounds._northEast.lat),bounds._northEast.lng]], {color: "#ff7800", weight: 1}).addTo(map);
	L.rectangle([[actualY(map.getMaxZoom(),mapBounds._southWest.lat),mapBounds._southWest.lng],[actualY(map.getMaxZoom(),mapBounds._northEast.lat),mapBounds._northEast.lng]], {color: "#ff7800", weight: 1}).addTo(map);

	function actualY (z, y) {
		return y - Math.pow(2, (z-2));
		//return Math.pow(2, (z - 2)) + y;
	}
</script>
</body>
</html>