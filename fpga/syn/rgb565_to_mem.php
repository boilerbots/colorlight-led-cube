<?php

$data = file_get_contents("Bliss.rgb565");

for ($i=0; $i < strlen($data); $i += 2)
{	
	echo str_pad(bin2hex($data[$i]), 2, '0', STR_PAD_LEFT);
	echo str_pad(bin2hex($data[$i + 1]), 2, '0', STR_PAD_LEFT);
	echo "\n";
}