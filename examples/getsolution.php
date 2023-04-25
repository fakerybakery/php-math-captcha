<?php
include '../src/mathcaptcha.php';
session_start();
$captcha = new Captcha();
$captcha->displayImage();
$_SESSION['captcha'] = $captcha->getNumber();
