<?php
session_start();
$circleCount = $_SESSION['text'];
include 'HSV-to-RGB.php';

if ($circleCount == 1) {
	$width = 1;
	$height = 1;
}
else {
	$width = 800;
	$height = 600;
}

$boarder = $height / 15;
$margin = $width - $circleCount * $boarder;
$step = 360 / $circleCount;

$img = imagecreatetruecolor($width, $height);
$back = imagecolorallocatealpha($img, 255, 255, 255, 0);
imagefilledrectangle($img, 0, 0, $width, $height, $back); // Background

// Big Circle
$cX = $width / 2;
$cY = $height / 2;
$cR = $width - $margin;

// Рисуем маленькие круги
$radius = $cR / log($circleCount * 0.8);
$side = $cR / 2;

$angle = 0;
for ($i = 0; $i < $circleCount; $i++) {
	$x = $cX + cos(deg2rad($angle)) * $side;
	$y = $cY - sin(deg2rad($angle)) * $side;
	$rgb = fGetRGB($angle + 1, 100, 100); // HSV -> RGB
	$circle_color = imagecolorallocatealpha($img, $rgb[0], $rgb[1], $rgb[2], 70);
    imagefilledellipse($img, $x, $y, $radius, $radius, $circle_color);
    $angle += $step;
}

$info = 'Circles: '.$circleCount;
$text_color = imagecolorallocate($img, 0, 0, 0);
imagettftext($img, 10, 0, 5, 15, $text_color, "ptsans.ttf", $info);

header("Content-type:image/png");
imagepng($img);