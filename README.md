# php-math-captcha
A simple math-based captcha, licensed under the permissive ISC license, and written entirely in with 0 dependencies.
## Installation
Just copy `src/mathcaptcha.php` somewhere on your server!
## Requirements
Preliminary testing seems to indicate that this package can run on PHP >= 5.4, however further testing is required. Anything >= 7.4 should work. <=5.3 does **not** work.
## Usage
### Introduction
**Include the Library**
```php
include 'wherever-you-put-mathcaptcha.php';
```
**Create a new Captcha**
```php
$captcha = new Captcha();
```
### Methods
#### Get Captcha Solution
```php
$captcha->getNumber();
```
#### Get Generated Image (PNG)
```php
$captcha->getImage();
```
#### Display Image in Browser
```php
$captcha->displayImage();
```
### Examples
#### Basic example:
```php
include 'wherever-you-put-mathcaptcha.php';
$captcha = new Captcha();
$captcha->displayImage();
```
More examples are coming soon.
More examples are available in the `examples` directory.
## Support
Need help? Please create a GitHub Issue.
## Notes
 - `mathcaptcha` will automatically download the [Sigmar font](https://fonts.google.com/specimen/Sigmar) from [my GitHub mirror](https://github.com/fakerybakery/libincludes/tree/main/fonts/sigmar).
 - GDImage is required. This is installed on most systems automatically.
 - This library generates PNG images.
## Issues/Feature Requests
Please create a GitHub issue or a Pull Request.
## Credits
The following software may be bundled in this software. These may be differently licensed.
- [Stack Overflow](https://stackoverflow.com/a/47362429)
  - [That's Geeky](https://www.thatsgeeky.com/2011/03/prime-factoring-with-php/)
## Todo
 - [ ] Add support for JPEG/GIF
 - [ ] Add more options for customization, e.g. fonts, size, rotation, color, etc
Have a feature request? Please make a GitHub Issue!
## License
This package is licensed under the ISC license.
