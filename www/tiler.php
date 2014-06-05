#!/usr/bin/php
<?php
	/**
	 * Created by Stefan Khan-Kernahan.
	 * User: hajime
	 * Date: 2014-06-04
	 * Time: 9:36 PM
	 */

	fwrite(STDOUT, '# of arguments: ' . $argc . "\r\n");
	foreach ($argv as $k => $v) {
		fwrite(STDOUT, $k . ': ' . $v . "\r\n");
	}

	$image_info = getimagesize($argv[1]);

	$tile_width = 256;
	$tile_height = 256;

	fwrite(STDOUT, 'Original W: ' . $image_info[0] . "\r\n");
	fwrite(STDOUT, 'Original H: ' . $image_info[1] . "\r\n");

	$image_w = ($image_info[0] % $tile_width) > 0 ? ((int)($image_info[0] / $tile_width) + 1) * $tile_width : $image_info[0];
	$image_h = ($image_info[1] % $tile_height) > 0 ? ((int)($image_info[1] / $tile_height) + 1) * $tile_height : $image_info[1];

	fwrite(STDOUT, 'Extended W: ' . $image_w . "\r\n");
	fwrite(STDOUT, 'Extended H: ' . $image_h . "\r\n");

	$larger = $image_w > $image_h ? $image_w : $image_h;

	fwrite(STDOUT, 'Larger Side: ' . $larger . "\r\n");

	$zoom = 0;
	$side = 256;
	while ($side < $larger){
		$zoom ++;
		$side *= 2;
	}

	fwrite(STDOUT, 'Max Suggested Zoom: ' . $zoom . " ({$side}px) \r\n");


	fwrite(STDOUT, 'Running ImageMagick as User: ' . exec("whoami") . "\r\n");
	fwrite(STDOUT, "Running Command: convert {$argv[1]} -background none -extent {$image_w}x{$image_h} PNG32:{$argv[1]}.png\r\n");

	exec("convert {$argv[1]} -background none -extent {$image_w}x{$image_h} PNG32:{$argv[1]}.png");

	$re = '/(\S*[\\|\/]{1})(\S*)?\.[jpg|png]?/';
	preg_match($re, $argv[1], $matches);

	fwrite(STDOUT, "Running Command: mkdir {$matches[1]}{$matches[2]}/tiles\r\n");
	fwrite(STDOUT, "Running Command: gdal2tiles.py -p raster -r lanczos -z 0-{$zoom} -w none {$argv[1]}.png {$matches[1]}{$matches[2]}/tiles\r\n");

	exec("mkdir {$matches[1]}{$matches[2]}/tiles");
	exec("gdal2tiles.py -p raster -r lanczos -z 0-{$zoom} -w none {$argv[1]}.png {$matches[1]}{$matches[2]}/tiles");


	/*

	$image_info = getimagesize("/Library/Server/Web/Data/Sites/Default/dev-driad/www/tiles/map.jpg");
	echo "var w = {$image_info[0]};\n";
	echo "var h = {$image_info[1]};\n";
# To get this number, look at the number of tiles
# generated, find the last tile number and add 1
# e.g. tiles_99.png => total_tiles = 100
	$total_tiles = 100;

	$tiles_per_column = $image_width/$tile_width;

	$row = 0;
	$column = 0;
	(n...total_tiles).each do |i|
$filename = "tiles_#{i}.png"; # current filename
  $target = "map_#{column}_#{row}.png"; # new filename

  $puts "copy #{filename} to #{target}";

  $`cp -f #{filename} #{target}`; # rename

  # work out next step
  $column = $column + 1;
  if $column >= $tiles_per_column;
  $column = 0;
    $row = $row + 1;
  end
end

	*/
?>