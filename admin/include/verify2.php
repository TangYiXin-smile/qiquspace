<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-22 20:57:06
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-22 21:05:24
 */
header('content-type:image/png');
$str = "2345678abcdefhjkmnopqresuvwxyz";
$len = strlen($str);
$code = '';
for($i=0;$i<4;$i++){
	$code .= $str[rand(0,$len-1)];
}
$img = imagecreatetruecolor(100,40);
$rand = imagecolorallocate($img, 240,240, 240);
imagefill($img, 0, 0, $rand);
for($i=0;$i<4;$i++){
	imagettftext(
		$img,
	    rand(15,25), 
	    rand(-30,30), 
	    10+$i*20, 30, 
		imagecolorallocate($img,rand(0,100),rand(0,100),rand(0,100)),
        'ARBONNIE.ttf', 
        $code[$i]
    );
}
imagepng($img);
imagedestroy($img);