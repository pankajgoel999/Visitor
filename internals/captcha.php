<?php
session_start();

$string = '';

for ($i = 0; $i < 4; $i++) {
	$string .= chr(rand(97, 122));
}

$_SESSION['register_captcha'] = $string;
//$_SESSION['test'] = "ABC";

$dir = 'captchafonts/';

$image = imagecreatetruecolor(120, 35);

// random number 1 or 2
$num = rand(1,2);
if($num==1)
{
	$font = "Molot.otf"; // font style
}
else
{
	$font = "Molot.otf";// font style
}

// random number 1 or 2
$num2 = rand(1,2);
if($num2==1)
{
	$color = imagecolorallocate($image, 237, 137, 93);// color
}
else
{
	$color = imagecolorallocate($image, 237, 137, 93);// color
}

$white = imagecolorallocate($image, 255, 255, 255); // background color white
imagefilledrectangle($image,0,0,399,99,$white);

imagettftext ($image, 30, 0, 5, 30, $color, $dir.$font, $_SESSION['register_captcha']);
//echo 'giule:  '.$_SESSION['random_number'];
header("Content-type: image/png");
imagepng($image);

?>
