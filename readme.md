[![Latest Stable Version](https://poser.pugx.org/forxer/gravatar/v/stable.svg)](https://packagist.org/packages/forxer/gravatar)
[![Total Downloads](https://poser.pugx.org/forxer/gravatar/downloads.svg)](https://packagist.org/packages/forxer/gravatar)
[![License](https://poser.pugx.org/forxer/gravatar/license.svg)](https://packagist.org/packages/forxer/gravatar)

# Gravatar

Gravatar is a small library intended to provide easy integration of... Gravatar :)

It will help you generate the URL for Gravatar images and profiles.

* [Installation](#installation)
    * [Requirements](#requirements)
    * [With Composer](#with-composer)
    * [Without Composer](#without-composer)
* [Usage](#usage)
    * [Single Gravatar image/profile](#single-gravatar-imageprofile)
    * [Single Gravatar image/profile with optional parameters](#single-gravatar-imageprofile-with-optional-parameters)
    * [Multiples Gravatar images/profiles](#multiples-gravatar-imagesprofiles)
    * [Multiples Gravatar images/profiles with optional parameters](#multiples-gravatar-imagesprofiles-with-optional-parameters)
    * [The dynamic way](#the-dynamic-way)
* [Optional parameters](#optional-parameters)
    * [Gravatar image size](#gravatar-image-size)
    * [Default Gravatar image](#default-gravatar-image)
    * [Gravatar image max rating](#gravatar-image-max-rating)
    * [Gravatar image file-type extension](#gravatar-image-file-type-extension)
    * [Force to always use the default image](#force-to-always-use-the-default-image)
    * [Gravatar profile format](#gravatar-profile-format)
* [License](#license)


## Installation

### Requirements

* PHP 5.4.0 or newer

### With Composer

The easiest way to install Gravatar is via [Composer](http://getcomposer.org/).

```json
{
    "require": {
        "forxer/Gravatar": "~2.0"
    }
}
```

### Without Composer

You should use composer, it's so convenient. However, if you really do not want, or can not, you can
[download the latest version](https://github.com/forxer/gravatar/releases/latest) and unpack the archive.

Then, you do what it takes to use it with your own autoloader. The examples below use the Composer autoloader.

## Usage

### Single Gravatar image/profile

If you want to retrieve a single Gravatar image/profile URL you can use the main Gravatar class like this:

```php
<?php
require 'vendor/autoload.php';

use forxer\Gravatar\Gravatar;

// Get a Gravatar image instance:
$image = Gravatar::image('email@example.com');
// return: \forxer\Gravatar\Image

// Get a single Gravatar image URL:
echo Gravatar::image('email@example.com');
// output: //www.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e

// Get a Gravatar profile instance:
$profile = Gravatar::profile('email@example.com');
// return: \forxer\Gravatar\Profile

// Get a  Gravatar profile URL:
echo Gravatar::profile('email@example.com');
// output: //www.gravatar.com/5658ffccee7f0ebfda2b226238b1eb6e
```

The `Gravatar::image()` and `Gravatar::profile()` methods return instances of `\forxer\Gravatar\Image` and `\forxer\Gravatar\Profile`. These classes implement __toString method, so when you treat them as a string they return the string to use as URL of the given email address.

### Single Gravatar image/profile with optional parameters

You can add some optional parameters:

* Gravatar image size
* Default Gravatar image
* Gravatar image max rating
* Gravatar image file-type extension
* Force to always use the default image
* Profile format

```php
<?php
require 'vendor/autoload.php';

use forxer\Gravatar\Gravatar;

// Get a single Gravatar image with size and default image:
echo Gravatar::image('email@example.com', 120, 'mm');
// output: //www.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e?s=120&d=mm

// Get a single Gravatar image with all options:
echo Gravatar::image('email@example.com', 120, 'mm', 'g', 'jpg', true);
// output: //gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e.jpg?s=120&d=mm&r=g&f=y

// Get a single profile in JSON:
echo Gravatar::profile('email@example.com', 'json');
// output: //www.gravatar.com/5658ffccee7f0ebfda2b226238b1eb6e.json
```

### Multiples Gravatar images/profiles

If you want to retrieve multiples Gravatar images/profiles URL you can also use the main Gravatar class with `Gravatar::images()` and `Gravatar::profiles()` methods.

Note the presence of the "s" character at the end of methods names.

```php
<?php
require 'vendor/autoload.php';

use forxer\Gravatar\Gravatar;

$emails = ['email1@example.com', 'email2@example.com','email3@example.com', /* ... */ ];

// Get multiples Gravatar images:
foreach (Gravatar::images($emails) as $image) {
    echo $image;
}

// Get multiples Gravatar profiles:
foreach (Gravatar::profiles($emails) as $profile) {
    echo $profile;
}
```

The `Gravatar::images()` and `Gravatar::profiles()` methods return an array of instances of `\forxer\Gravatar\Image` and `\forxer\Gravatar\Profile`.

### Multiples Gravatar images/profiles with optional parameters

As for `Gravatar::image()` and `Gravatar::profile()` methods you can pass some optional parameters to `Gravatar::images()` and `Gravatar::profiles()`.

```php
<?php
require 'vendor/autoload.php';

use forxer\Gravatar\Gravatar;

$emails = ['email1@example.com', 'email2@example.com','email3@example.com', /* ... */ ];

// Get multiples Gravatar images with size and default image:
foreach (Gravatar::images($emails, 120, 'mm') as $image) {
    echo $image;
}
// Get multiples Gravatar images with all options:
foreach (Gravatar::images($emails, 120, 'mm', 'g', 'jpg', true) as $image) {
    echo $image;
}

// Get multiples Gravatar profiles in JSON:
foreach (Gravatar::profiles($emails, 'json') as $profile) {
    echo $profile;
}
```

### The dynamic way

In fact, `Gravatar::image()`, `Gravatar::images()`, `Gravatar::profile()` and `Gravatar::profiles()` static methods are just shortcuts for convenient use.
Behind these static methods, there are two classes : `\forxer\Gravatar\Image` and `\forxer\Gravatar\Profile`.

In some case, for some reason, you would use the library in another way.

```php
<?php
require 'vendor/autoload.php';

use forxer\Gravatar\Image as GravatarImage;
use forxer\Gravatar\Profile as GravatarProfile;

$emails = ['email1@example.com', 'email2@example.com','email3@example.com', /* ... */ ];

// Get multiples Gravatar images with size and default image:
$gravatarImage = new GravatarImage();
$gravatarImage
    ->setSize(120)
    ->setDefaultImage('mm');

foreach ($emails as $email) {
    echo $gravatarImage->getUrl($email);
}

// Get multiples Gravatar profiles in JSON
$gravatarProfile = new GravatarProfile();
$gravatarProfile->setFormat('json');

foreach ($emails as $email) {
    echo $gravatarProfile->getUrl($email);
}
```

## Optional parameters

### Gravatar image size

By default, images are presented at 80px by 80px if no size parameter is supplied.
You may request a specific image size, which will be dynamically delivered from Gravatar.
You may request images anywhere from 1px up to 2048px, however note that many users have lower resolution images,
so requesting larger sizes may result in pixelation/low-quality images.

An avatar size should be an integer representing the size in pixels.

```php
// pass the size as second parameter of `Gravatar::image()` and `Gravatar::images()`
Gravatar::image($email_string, 120);
Gravatar::images($emails_array, 120);

// or use the `setSize()` method of a `\forxer\Gravatar\Image` instance
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->setSize(120);

// or the `size()` helper method of a `\forxer\Gravatar\Image` instance
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->size(120);

// or its alias `s()`
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->s(120);
```

If you want to retrieve the currently set avatar size, you can use one of following methods:

```php
// call the `getSize()` method of a `\forxer\Gravatar\Image` instance
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->getSize();

// or the `size()` helper method of a `\forxer\Gravatar\Image` instance without parameter
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->size();

// or its alias `s()`
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->s();
```

### Default Gravatar image

What happens when an email address has no matching Gravatar image or when the gravatar specified exceeds your maximum allowed content rating?

By default, this:

![Default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000)

If you'd prefer to use your own default image, then you can easily do so by supplying the URL to an image.
In addition to allowing you to use your own image, Gravatar has a number of built in options which you can also use as defaults.
Most of these work by taking the requested email hash and using it to generate a themed image that is unique to that email address.
To use these options, just pass one of the following keywords:

* 404: do not load any image if none is associated with the email hash, instead return an HTTP 404 (File Not Found) response
* mm: (mystery-man) a simple, cartoon-style silhouetted outline of a person (does not vary by email hash)
* identicon: a geometric pattern based on an email hash
* monsterid: a generated 'monster' with different colors, faces, etc
* wavatar: generated faces with differing features and backgrounds
* retro: awesome generated, 8-bit arcade-style pixelated faces
* blank: a transparent PNG image

![Mystery-man default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&f=y)
![Identicon default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=identicon&f=y)
![Wavatar default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=wavatar&f=y)
![Retro default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=retro&f=y)
![Blank default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=blank&f=y)

```php
// pass the default Gravatar image as third parameter of `Gravatar::image()` and `Gravatar::images()`
Gravatar::image($email_string, null, 'mm');
Gravatar::images($emails_array, null, 'mm');

// or use the `setDefaultImage()` method of a `\forxer\Gravatar\Image` instance
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->setDefaultImage('mm');

// or the `defaultImage()` helper method of a `\forxer\Gravatar\Image` instance
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->defaultImage('mm');

// or its alias `d()`
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->s('mm');
```

If you want to retrieve the currently set avatar default image, you can use one of following methods:

```php
// call the `getDefaultImage()` method of a `\forxer\Gravatar\Image` instance
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->getDefaultImage();

// or the `defaultImage()` helper method of a `\forxer\Gravatar\Image` instance without parameter
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->defaultImage();

// or its alias `d()`
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->d();
```

### Gravatar image max rating

Gravatar allows users to self-rate their images so that they can indicate if an image is appropriate for a certain audience.
By default, only 'g' rated images are displayed unless you indicate that you would like to see higher ratings.

You may specify one of the following ratings to request images up to and including that rating:

* g: suitable for display on all websites with any audience type.
* pg: may contain rude gestures, provocatively dressed individuals, the lesser swear words, or mild violence.
* r: may contain such things as harsh profanity, intense violence, nudity, or hard drug use.
* x: may contain hardcore sexual imagery or extremely disturbing violence.

```php
// pass the Gravatar image max rating as fourth parameter of `Gravatar::image()` and `Gravatar::images()`
Gravatar::image($email_string, null, null, 'g');
Gravatar::images($emails_array, null, null, 'g');

// or use the `setMaxRating()` method of a `\forxer\Gravatar\Image` instance
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->setMaxRating('g');

// or the `rating()` helper method of a `\forxer\Gravatar\Image` instance
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->rating('g');

// or its alias `r()`
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->r('g');
```

If you want to retrieve the currently set avatar max rating, you can use one of following methods:

```php
// call the `getMaxRating()` method of a `\forxer\Gravatar\Image` instance
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->getMaxRating();

// or the `rating()` helper method of a `\forxer\Gravatar\Image` instance without parameter
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->rating();

// or its alias `r()`
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->r();
```

### Gravatar image file-type extension

If you require a file-type extension (some places do) then you may also specify it.

```php
// pass the Gravatar image file-type extension as fifth parameter of `Gravatar::image()` and `Gravatar::images()`
Gravatar::image($email_string, null, null, null, 'jpg');
Gravatar::images($emails_array, null, null, null, 'jpg');

// or use the `setExtension()` method of a `\forxer\Gravatar\Image` instance
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->setExtension('jpg');

// or the `extension()` helper method of a `\forxer\Gravatar\Image` instance
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->extension('jpg');

// or its alias `e()`
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->e('jpg');
```

If you want to retrieve the currently set avatar file-type extension, you can use one of following methods:

```php
// call the `getExtension()` method of a `\forxer\Gravatar\Image` instance
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->getExtension();

// or the `extension()` helper method of a `\forxer\Gravatar\Image` instance without parameter
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->extension();

// or its alias `e()`
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->e();
```

### Force to always use the default image

If for some reason you wanted to force the default image to always be load, you can do it:

```php
// to force to always use the default image, set the sixth parameter of `Gravatar::image()` and `Gravatar::images()` to `true`
Gravatar::image($email_string, null, null, null, null, true);
Gravatar::images($emails_array, null, null, null, null, true);

// or use the `setForceDefault()` method of a `\forxer\Gravatar\Image` instance
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->setForceDefault(true);

// or the `forceDefault()` helper method of a `\forxer\Gravatar\Image` instance
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->forceDefault(true);

// or its alias `f()`
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->f(true);

// or use the `enableForceDefault()` method of a `\forxer\Gravatar\Image` instance
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->enableForceDefault();
```

To check to see if you are forcing default image, call the method `forcingDefault()` of `\forxer\Gravatar\Image`,
which will return a boolean value regarding whether or not forcing default is enabled.

```php
$gravatarImage = new \forxer\Gravatar\Image();
$gravatarImage
    ->enableForceDefault();

//...

$gravatarImage->forcingDefault(); // true

//...

$gravatarImage->disableForceDefault();

//...

$gravatarImage->forcingDefault(); // false
```

### Gravatar profile format

Gravatar profile data may be requested in different data formats for simpler programmatic access.

```php
// pass the Gravatar profile format as second parameter of `Gravatar::profile()` and `Gravatar::profiles()`
Gravatar::profile($email_string, 'json');

// or use the `setFormat()` method of `\forxer\Gravatar\Profile` instance
$gravatarProfile = new \forxer\Gravatar\Profile();
$gravatarProfile
    ->setFormat('json');

// or the `format()` helper method of a `\forxer\Gravatar\Profile` instance
$gravatarProfile = new \forxer\Gravatar\Profile();
$gravatarProfile
    ->format('json');

// or its alias `f()`
$gravatarProfile = new \forxer\Gravatar\Profile();
$gravatarProfile
    ->f('json');
```

The following formats are supported:

* JSON ; use 'json' as parameter
* XML ; use 'xml' as parameter
* PHP ; use 'php' as parameter
* VCF/vCard ; use 'vcf' as parameter
* QR Code ; use 'qr' as parameter

## License

This library is licensed under the MIT license; you can find a full copy of the license itself in the file /LICENSE
