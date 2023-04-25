<?php
include '../src/mathcaptcha.php';
$captcha = new Captcha();
imagepng($captcha->getImage(), 'captcha.png');
echo 'The solution is: ' . $captcha->getNumber();
