<?php
session_start();

// 设置验证码内容
$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$captcha_text = '';
for ($i = 0; $i < 6; $i++) {
    $captcha_text .= $characters[rand(0, strlen($characters) - 1)];
}

// 将验证码文本存储在会话中以便验证
$_SESSION['captcha'] = $captcha_text;

// 创建图像
$width = 120;
$height = 50;
$image = imagecreatetruecolor($width, $height);

// 设置颜色
$background_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
$line_color = imagecolorallocate($image, 64, 64, 64);
$pixel_color = imagecolorallocate($image, 0, 0, 255);

// 填充背景
imagefilledrectangle($image, 0, 0, $width, $height, $background_color);

// 添加一些干扰线
for ($i = 0; $i < 10; $i++) {
    imageline($image, 0, rand() % $height, $width, rand() % $height, $line_color);
}

// 添加一些干扰像素
for ($i = 0; $i < 1000; $i++) {
    imagesetpixel($image, rand() % $width, rand() % $height, $pixel_color);
}

// 添加验证码文本
$font_size = 20; // 增大字体大小
$bbox = imagettfbbox($font_size, 0, __DIR__ . '/Ubuntu-Regular.ttf', $captcha_text);
$x = ($width - ($bbox[2] - $bbox[0])) / 2;
$y = ($height - ($bbox[1] - $bbox[7])) / 2 + $font_size;
imagettftext($image, $font_size, 0, $x, $y, $text_color, __DIR__ . '/Ubuntu-Regular.ttf', $captcha_text);

// 设置内容类型
header('Content-Type: image/png');

// 输出图像
imagepng($image);
imagedestroy($image);
?>
