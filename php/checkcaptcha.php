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
$height = 40;
$image = imagecreatetruecolor($width, $height);

// 检查图像是否成功创建
if (!$image) {
    die('Failed to create image');
}

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
$font_size = 5; // 内置字体大小
$bbox = imagettfbbox($font_size, 0, null, $captcha_text);
$x = ($width - ($bbox[2] - $bbox[0])) / 2;
$y = ($height - ($bbox[1] - $bbox[7])) / 2 + $font_size;
imagestring($image, $font_size, $x, $y, $captcha_text, $text_color);

// 设置内容类型
header('Content-Type: image/png');

// 输出图像
if (!imagepng($image)) {
    die('Failed to output image');
}

// 销毁图像资源
imagedestroy($image);
// 输出图像到文件以进行调试
imagepng($image, 'captcha.png');
imagedestroy($image);

// 检查文件是否正确生成
if (file_exists('captcha.png')) {
    echo 'Captcha image generated successfully.';
} else {
    echo 'Failed to generate captcha image.';
}
?>
