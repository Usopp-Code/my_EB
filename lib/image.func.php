<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'string.func.php';

//创建画布,使用gd库创建验证码
function verifyImage($type=1,$length=4,$pixel=0,$line=0,$sess_name='verify'){
    session_start();
    $width = 80;
    $height = 28;
    $image = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);
    imagefilledrectangle($image, 1, 1, $width - 2, $height, $white);
//
    $chars = buildRandomString($type, $length);
    $_SESSION[$sess_name] = $chars;
    $fontfiles = array("SIMYOU.TTF");
    for ($i = 0; $i < $length; $i++) {
        $size = mt_rand(14, 18);
        $angle = mt_rand(-15, 15);
        $x = 5 + $i * $size;
        $y = mt_rand(20, 26);
        $fontfile = "../fonts/" . $fontfiles[mt_rand(0, count($fontfiles) - 1)];
        $text = substr($chars, $i, 1);
        $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
        imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
    }
    for ($i = 0; $i < $pixel; $i++) {
        imagesetpixel($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1), $black);
    }
    for ($i = 0; $i < $line; $i++) {
        $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
        imageline($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1), mt_rand(0, $width - 1), mt_rand(0, $height - 1), $color);
    }
    header("content-type:image/gif");
    imagegif($image);
    imagedestroy($image);
}
verifyImage(3,4,20,3);