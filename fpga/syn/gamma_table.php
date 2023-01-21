<?php
$gamma  = 2.2;
$input  = 2**5;
$output = 2**6;

for ($i=0; $i < $input; $i++)
{
	$value = (int)(pow((float)$i / (float)$input, (float)$gamma) * (float)$output + 0.5);
	echo dechex($value) . "\n";
}