<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-22 20:44:21
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-22 20:56:17
 */
header('content-type:image/png');
$str = "2345678abcdefhjkmnopqrstuvwxyz";
$len = strlen($str);
$code='';
for($i=0;$i<4;$i++){
	$code .= $str[rand(0,$len-1)];

}
$img = imagecreatetruecolor(100, 40);
$red = imagecolorallocate($img,255,0,0);
$green = imagecolorallocate($img,0,255,0);
$blue = imagecolorallocate($img,0,0,255);
$bg = imagecolorallocate($img,240,240,240);

imagefill($img,0,0,$bg);
for($i=0;$i<4;$i++){
	imagettftext(
		$img,
		rand(15,25),
		rand(-30,30),
		10+$i*20,
		30,
		imagecolorallocate($img,rand(0,255),rand(0,100),rand(0,255)),
		'ARBONNIE.ttf',
		$code[$i]
	);
}
imagepng($img);
imagedestroy($img);
