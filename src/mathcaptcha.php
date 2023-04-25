<?php
/*
 * PHP Math Captcha
 * https://github.com/fakerybakery/php-math-captcha
 * Created by mrfakename (https://www.mrfake.name/).
 * Copyright 2023 mrfakename. All rights reserved.
 * v1.0.0
 * 
 * ISC License
 * 
 * Permission to use, copy, modify, and/or distribute this software for any purpose with or without fee is
 * hereby granted, provided that the above copyright notice and this permission notice appear in all copies.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH REGARD TO THIS SOFTWARE
 * INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE
 * FOR ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM LOSS
 * OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING
 * OUT OF OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
 * 
 */
class Captcha {
  private $num;
  private $image;
  function __construct($num = false) {
    if ($num && is_int($num) && ($num > 0)) {
      $this->num = intval($num);
    } else {
      $this->num = rand(500, 10000);
    }
    if (!is_file("./captcha_font.ttf")) {
      file_put_contents("./captcha_font.ttf", file_get_contents("https://raw.githubusercontent.com/fakerybakery/libincludes/main/fonts/sigmar/sigmar.ttf"));
    }
    $this->generateCaptcha();
  }
  public function getNumber() {
    return $this->num;
  }
  public function getImage() {
    return $this->image;
  }
  public function displayImage() {
    header("Content-type: image/png");
    imagepng($this->image);
    imagedestroy($this->image);
  }
  private function generate($str) {
    $width = strlen($str) * 25;
    $height = 40;
    $image = imagecreatetruecolor($width, $height);
    $background_color = imagecolorallocate($image, 255, 255, 255);
    imagefill($image, 0, 0, $background_color);
    for ($i = 0; $i < ($width * $height) / 3; $i++) {
        $x = rand(0, $width - 1);
        $y = rand(0, $height - 1);
        imagesetpixel($image, $x, $y, imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255)));
    }
    $x = 5;
    $y = ($height - 10);
    for ($i = 0; $i < strlen($str); $i++) {
        $char = $str[$i];
        $angle = rand(-20, 20);
        $font_size = rand(20, 30);
        $text_color = imagecolorallocate($image, rand(0, 100), rand(0, 100), rand(0, 100));
        imagettftext($image, $font_size, $angle, $x, $y, $text_color, "./captcha_font.ttf", $char);
        $x += 25;
    }
    $this->image = $image;
  }
  private function primeFactors($num) {
    $factors = [];
    for ($i = 2; $i <= $num; $i++) {
        while ($num % $i == 0) {
            $factors[] = $i;
            $num /= $i;
        }
    }
    return $factors;
  }
  public function generateCaptcha() {
    $factors = $this->primeFactors($this->num);
    foreach ($factors as $key => $value) {
      if (mt_rand(0,1)) {
        if (count($factors) < 2) {
          return $this->generateCaptcha();
        }
        $keys = array_rand($factors, 2);
        $to = $factors[$keys[0]]*$factors[$keys[1]];
        $factors[] = $to;
        unset($factors[$keys[0]]);
        unset($factors[$keys[1]]);
      }
    }
    foreach ($factors as $key => $value) {
      if (mt_rand(0,1)) {
        $delta = mt_rand(1,$factors[$key]-1);
        $factors[$key] = '(' . ($value-$delta) . '+' . $delta . ')';
      }
    }
    shuffle($factors);
    $this->generate(join('*', $factors));
  }
}
