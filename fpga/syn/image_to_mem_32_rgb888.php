<?php
//$im = imagecreatefrompng('no_signal.png');
$im = imagecreatefrompng('color_bars_96x48.png');

//$im = imagecreatefromjpeg('Bliss.jpg');
$width = imagesx($im);
$height = imagesy($im);

$rgb_offset = 24;

$output_0 = "";
$output_1 = "";
echo "width=" . $width . "\n";
echo "height=" . $height . "\n";
for ($y = 0; $y < $height; $y++)
{
	for ($x = 0; $x < $width; $x++)
	{
		$color = imagecolorat($im, $x, $y);
		$color_tran = imagecolorsforindex($im, $color);

		$red = $color_tran['red'];
		$green = $color_tran['green'];
		$blue = $color_tran['blue'];

		$r = ($red);
		$g = (($green)) << 8;
		$b = (($blue)) << 16;

		if ($y >= $rgb_offset)
		{
			$output_1 .= sprintf("%06x\n", ($r | $g | $b));
		}
		else
		{
			$output_0 .= sprintf("%06x\n", ($r | $g | $b));
		}
   }
}

file_put_contents("no_signal.rgb0", $output_0);
file_put_contents("no_signal.rgb1", $output_1);
