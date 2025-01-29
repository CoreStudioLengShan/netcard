<?php
header("Content-type: image/JPEG");
include 'function.php';
$im = imagecreatefromjpeg("netcard.jpeg");

$ip = $_SERVER["REMOTE_ADDR"];
$weekarray=array("日","一","二","三","四","五","六"); //先定义一个数组
$get=$_GET["s"];
$get=base64_decode(str_replace(" ","+",$get));

$url='https://www.yuanxiapi.cn/api/iplocation/?ip='.$ip; //获取IP地址 使用远昔api
$data = get_curl($url);
$data = json_decode($data, true);

//定义颜色
$red = ImageColorAllocate($im, 255,0,0);//红色，可参考颜色代码表里的R.G.B
$font = 'msyh.ttf';//加载字体
//输出
imagettftext($im, 16, 0, 455, 20, $red, $font,'柠栀网络科技'); //右上角版权
imagettftext($im, 16, 0, 10, 40, $red, $font,'官网：'.($_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:$_SERVER['HTTP_HOST']));
imagettftext($im, 16, 0, 10, 72, $red, $font, '今天是'.date('Y年n月j日').' 星期'.$weekarray[date("w")]);//当前时间添加到图片
imagettftext($im, 16, 0, 10, 104, $red, $font,'您的IP是:'.$ip.'   '.$weather);//ip
imagettftext($im, 16, 0, 10, 140, $red, $font,'您使用的是'.$os.'操作系统');
imagettftext($im, 16, 0, 10, 175, $red, $font,'您使用的是'.$bro.'浏览器');
imagettftext($im, 16, 0, 10, 200, $red, $font,'来自'.$data['location'].'的朋友');
imagettftext($im, 14, 0, 10, 200, $black, $font,$get); 

imagepng($im);
