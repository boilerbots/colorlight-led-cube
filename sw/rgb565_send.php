<?php

$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

$x = 225;
$y = 485;

while (true)
{
    $xt = $x;
    $yt = $y;

    `scrot -q 1 -o -a $xt,$yt,64,32 /tmp/test.png`;
    $im = imagecreatefrompng('/tmp/test.png');
    $im = imagerotate($im, 180, 0);
    send_image_to_port($sock, $im, 0x6600 + (1 << 5));
    imagedestroy($im);

    $yt += 32;

    `scrot -q 1 -o -a $xt,$yt,64,32 /tmp/test.png`;
    $im = imagecreatefrompng('/tmp/test.png');
    $im = imagerotate($im, 180, 0);
    send_image_to_port($sock, $im, 0x6600 + (1 << 4));
    imagedestroy($im);
}



function send_image_to_port($sock, $im, $port)
{
    $panel_width_bits = 6;
    $panel_height_bits = 5;

    $width = imagesx($im);
    $height = imagesy($im);

    for ($y = 0; $y < $height; $y++)
    {
        $msg = "";
        for ($x = 0; $x < $width; $x++)
        {
            $color = imagecolorat($im, $x, $y);
            $color_tran = imagecolorsforindex($im, $color);

            $red = $color_tran['red'];
            $green = $color_tran['green'];
            $blue = $color_tran['blue'];

            $r = ($red  * 1 >> 3) & 0x1f;
            $g = (($green  * 1 >> 2) & 0x3f) << 5;
            $b = (($blue  * 1 >> 3) & 0x1f) << 11;

            $addr = str_pad(decbin($y), $panel_height_bits, "0", STR_PAD_LEFT) . str_pad(decbin($x), $panel_width_bits, "0", STR_PAD_LEFT);
            $msg .= pack("nn", bindec($addr), ($r | $g | $b));
        }

        $len = strlen($msg);
        socket_sendto($sock, $msg, $len, 0, '192.168.178.50', $port);
    }
}


socket_close($sock);



