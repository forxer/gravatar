[![Latest Stable Version](https://poser.pugx.org/forxer/gravatar/v/stable.svg)](https://packagist.org/packages/forxer/gravatar)
[![Total Downloads](https://poser.pugx.org/forxer/gravatar/downloads.svg)](https://packagist.org/packages/forxer/gravatar)
[![License](https://poser.pugx.org/forxer/gravatar/license.svg)](https://packagist.org/packages/forxer/gravatar)

Gravatar
========

Gravatar is a small library intended to provide easy integration of... [Gravatar](https://gravatar.com) :)

It will help you generate the URL for Gravatar images and profiles in many ways.

**To use it in a Laravel project,** please look at: [laravel-gravatar](https://github.com/forxer/laravel-gravatar)

If you want to use it with a version earlier than PHP 8, please use [version 2](https://github.com/forxer/gravatar/tree/2.1).

```php
$avatar = gravatar('email@example.com')
    ->size(120)
    ->defaultImage('robohash')
    ->extension('jpg');
//...
echo $avatar
```

* [Installation](#installation)
    * [Requirements](#requirements)
    * [With Composer](#with-composer)
    * [Without Composer](#without-composer)
* [Usage](#usage)
    * [Use helpers](#use-helpers)
    * [Use the Gravatar base class](#use-the-gravatar-base-class)
        * [Single Gravatar image/profile](#single-gravatar-imageprofile)
        * [Single Gravatar image/profile with optional parameters](#single-gravatar-imageprofile-with-optional-parameters)
        * [Multiples Gravatar images/profiles](#multiples-gravatar-imagesprofiles)
        * [Multiples Gravatar images/profiles with optional parameters](#multiples-gravatar-imagesprofiles-with-optional-parameters)
    * [Instanciate the dedicated classes](#instanciate-the-dedicated-classes)
* [Mandatory parameter](#mandatory-parameter)
* [Optional parameters](#optional-parameters)
    * [Gravatar image size](#gravatar-image-size)
    * [Default Gravatar image](#default-gravatar-image)
    * [Gravatar image max rating](#gravatar-image-max-rating)
    * [Gravatar image file-type extension](#gravatar-image-file-type-extension)
    * [Force to always use the default image](#force-to-always-use-the-default-image)
    * [Gravatar profile format](#gravatar-profile-format)
* [License](#license)

Installation
------------

### Requirements

* PHP 8.0.0 or newer

### With Composer

The easiest way to install Gravatar is via [Composer](http://getcomposer.org/). Run the following command in the root of your project:

```
composer require forxer/Gravatar
```

Or manually directly in your `composer.json` file:

```js
{
    "require": {
        //...
        "forxer/Gravatar": "^3.0.0"
        //...
    }
}
```

### Without Composer

You should use composer, it's so convenient. However, if you really do not want, or can not, you can
[download the latest version](https://github.com/forxer/gravatar/releases/latest) and unpack the archive.

Then, you do what it takes to use it with your own autoloader. The examples below use the Composer autoloader.

[Back to top](#gravatar)

Usage
-----

There are plenty of ways to use this library:

- Use helpers fonctions `gravatar()` and `gravatar_profile()`
- Use the Gravatar base class with its `Gravatar::image()` and `Gravatar::profile()` methods
- Instantiate the dedicated classes `Gravatar\Image()` and `Gravatar\Profile()`

All of these ways return instances that allow you to define specific settings/parameters as needed.

Whatever method you use, you could use the `url()` method to retrieve it. Or display the URL directly because they implement the "magic" method `__toString()`.

### Use helpers

The easiest way to use this library is to use the helper functions.

```php
<?php
require 'vendor/autoload.php';

// Get a Gravatar image instance:
$image = gravatar('email@example.com');
// return: Gravatar\Image

// Get a Gravatar image URL:
$imageUrl = gravatar('email@example.com')->url();
// return: //www.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e

// Show a Gravatar image URL:
echo gravatar('email@example.com');
// output: //www.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e

// Get a Gravatar profile instance:
$profile = gravatar_profile('email@example.com');
// return: Gravatar\Profile

// Get a Gravatar profile URL:
echo gravatar_profile('email@example.com');
// output: https//www.gravatar.com/5658ffccee7f0ebfda2b226238b1eb6e
```

[Back to top](#gravatar)

### Use the Gravatar base class

But it is also possible to use the static methods of the base Gravatar class.

#### Single Gravatar image/profile

If you want to retrieve a single Gravatar image/profile URL you can use the main Gravatar class like this:

```php
<?php
require 'vendor/autoload.php';

use Gravatar\Gravatar;

// Get a Gravatar image instance:
$image = Gravatar::image('email@example.com');
// return: Gravatar\Image

// Get a single Gravatar image URL:
$imageUrl = Gravatar::image('email@example.com')->url();
// return: //www.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e

// Show a single Gravatar image URL:
echo Gravatar::image('email@example.com');
// output: //www.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e

// Get a Gravatar profile instance:
$profile = Gravatar::profile('email@example.com');
// return: Gravatar\Profile

// Get a  Gravatar profile URL:
echo Gravatar::profile('email@example.com');
// output: https//www.gravatar.com/5658ffccee7f0ebfda2b226238b1eb6e
```

The `Gravatar::image()` and `Gravatar::profile()` methods return instances of `Gravatar\Image` and `Gravatar\Profile`. These classes implement `__toString` method, so when you treat them as a string they return the string to use as URL of the given email address.

[Back to top](#gravatar)

#### Single Gravatar image/profile with optional parameters

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

use Gravatar\Gravatar;

// Show a single Gravatar image with size and default image:
echo Gravatar::image('email@example.com', 120, 'mp');
// output: //www.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e?s=120&d=mm

// Show a single Gravatar image with all options:
echo Gravatar::image('email@example.com', 120, 'mp', 'g', 'jpg', true);
// output: //gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e.jpg?s=120&d=mm&r=g&f=y

// Show a single Gravatar image with all options using named arguments:
echo Gravatar::image(
    email: 'email@example.com',
    size: 120,
    defaultImage: 'mp',
    rating: 'g',
    extension: 'jpg',
    forceDefault: true
);
// output: //gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e.jpg?s=120&d=mm&r=g&f=y

// Show a single profile in JSON:
echo Gravatar::profile('email@example.com', 'json');
// output: //www.gravatar.com/5658ffccee7f0ebfda2b226238b1eb6e.json
```

[Back to top](#gravatar)

#### Multiples Gravatar images/profiles

If you want to retrieve multiples Gravatar images/profiles URL you can also use the main Gravatar class with `Gravatar::images()` and `Gravatar::profiles()` methods.

Note the presence of the "s" character at the end of methods names.

```php
<?php
require 'vendor/autoload.php';

use Gravatar\Gravatar;

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

The `Gravatar::images()` and `Gravatar::profiles()` methods return an array of instances of `Gravatar\Image` and `Gravatar\Profile`.

[Back to top](#gravatar)

#### Multiples Gravatar images/profiles with optional parameters

As for `Gravatar::image()` and `Gravatar::profile()` methods you can pass some optional parameters to `Gravatar::images()` and `Gravatar::profiles()`.

```php
<?php
require 'vendor/autoload.php';

use Gravatar\Gravatar;

$emails = ['email1@example.com', 'email2@example.com','email3@example.com', /* ... */ ];

// Get multiples Gravatar images with size and default image:
foreach (Gravatar::images($emails, 120, 'mp') as $image) {
    echo $image;
}

// Get multiples Gravatar images with all options:
foreach (Gravatar::images($emails, 120, 'mp', 'g', 'jpg', true) as $image) {
    echo $image;
}

// Get multiples Gravatar profiles in JSON:
foreach (Gravatar::profiles($emails, 'json') as $profile) {
    echo $profile;
}
```

[Back to top](#gravatar)

### Instanciate the dedicated classes

In fact, either `gravatar()` and `gravatar_profile()` helpers functions or `Gravatar::image()`, `Gravatar::images()`, `Gravatar::profile()` and `Gravatar::profiles()` static methods are just shortcuts for convenient use.

Behind these helpers functions and static methods, there are two classes : `Gravatar\Image` and `Gravatar\Profile`.

In some case, for some reason, you would use the library in another way. For exemple with a dependency injection container.

```php
<?php
require 'vendor/autoload.php';

use Gravatar\Image as GravatarImage;
use Gravatar\Profile as GravatarProfile;

// emails list
$emails = ['email1@example.com', 'email2@example.com','email3@example.com', /* ... */ ];

// Get multiples Gravatar images with size and default image:
$gravatarImage = new GravatarImage();
$gravatarImage
    ->setSize(120)
    ->setDefaultImage('mp');

foreach ($emails as $email) {
    echo $gravatarImage->email($email)->url();
}

// Get multiples Gravatar profiles in JSON
$gravatarProfile = new GravatarProfile();
$gravatarProfile->setFormat('json');

foreach ($emails as $email) {
    echo $gravatarProfile->email($email)->url();
}
```

[Back to top](#gravatar)

Mandatory parameter
-------------------

Obviously the email address is a mandatory parameter that can be entered in different ways.

```php
// pass it as argument of the helper
$gravatarImage = gravatar($email);

// the first argument of `Gravatar::image()` and `Gravatar::images()`
$gravatarImage = Gravatar::image($email);
$gravatarImages = Gravatar::images($emails);

// or pass it to the `Gravatar\Image` constructor
$gravatarImage = new Gravatar\Image($email);

// or use the `setEmail()` method of a `Gravatar\Image` instance
$gravatarImage = gravatar();
$gravatarImage->setEmail($email);

$gravatarImage = new Gravatar\Image();
$gravatarImage->setEmail($email);

// or the `email()` helper method of a `Gravatar\Image` instance
$gravatarImage = gravatar();
$gravatarImage->email($email);

$gravatarImage = new Gravatar\Image();
$gravatarImage->email($email);
```

These previous examples are also valid for the profile.

```php
// pass it as argument of the helper
$gravatarProfile = gravatar_profile($email);

// the first argument of `Gravatar::profile()` and `Gravatar::profiles()`
$gravatarProfile = Gravatar::profile($email);
$gravatarProfiles = Gravatar::profiles($emails);

// or pass it to the `Gravatar\Profile` constructor
$gravatarProfile = new Gravatar\Profile($email);

// or use the `setEmail()` method of a `Gravatar\Profile` instance
$gravatarProfile = gravatar_profile();
$gravatarProfile->setEmail($email);

$gravatarProfile = new Gravatar\Profile();
$gravatarProfile->setEmail($email);

// or the `email()` helper method of a `Gravatar\Profile` instance
$gravatarProfile = gravatar_profile();
$gravatarProfile->email($email);

$gravatarProfile = new Gravatar\Profile();
$gravatarProfile->email($email);
```

[Back to top](#gravatar)

Optional parameters
-------------------

### Gravatar image size

By default, images are presented at 80px by 80px if no size parameter is supplied.
You may request a specific image size, which will be dynamically delivered from Gravatar.
You may request images anywhere from 1px up to 2048px, however note that many users have lower resolution images,
so requesting larger sizes may result in pixelation/low-quality images.

An avatar size should be an integer representing the size in pixels.

```php
// pass the size as second argument of `Gravatar::image()` and `Gravatar::images()`
$gravatarImage = Gravatar::image($email, 120);
$gravatarImages = Gravatar::images($emails, 120);

// or use the `setSize()` method of a `Gravatar\Image` instance
$gravatarImage = gravatar($email);
$gravatarImage->setSize(120);

$gravatarImage = new Gravatar\Image($email);
$gravatarImage->setSize(120);

// or the `size()` helper method of a `Gravatar\Image` instance
$gravatarImage = gravatar($email);
$gravatarImage->size(120);

$gravatarImage = new Gravatar\Image($email);
$gravatarImage->size(120);

// or its alias `s()`
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->s(120);
```

If you want to retrieve the currently set avatar size, you can use one of following methods:

```php
// call the `getSize()` method of a `Gravatar\Image` instance without argument
$gravatarImage = gravatar();
$gravatarImage->getSize();

$gravatarImage = new Gravatar\Image();
$gravatarImage->getSize();

// or the `size()` helper method of a `Gravatar\Image` instance without argument
$gravatarImage = gravatar();
$gravatarImage->size();

$gravatarImage = new Gravatar\Image();
$gravatarImage->size();

// or its alias `s()`
$gravatarImage = gravatar();
$gravatarImage->s();

$gravatarImage = new Gravatar\Image();
$gravatarImage->s();
```

[Back to top](#gravatar)

### Default Gravatar image

What happens when an email address has no matching Gravatar image or when the gravatar specified exceeds your maximum allowed content rating?

By default, this:

![Default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000)

If you'd prefer to use your own default image, then you can easily do so by supplying the URL to an image.
In addition to allowing you to use your own image, Gravatar has a number of built in options which you can also use as defaults.
Most of these work by taking the requested email hash and using it to generate a themed image that is unique to that email address.
To use these options, just pass one of the following keywords:

* 404: do not load any image if none is associated with the email hash, instead return an HTTP 404 (File Not Found) response
* mp: (mystery-person) a simple, cartoon-style silhouetted outline of a person (does not vary by email hash)
* identicon: a geometric pattern based on an email hash
* monsterid: a generated 'monster' with different colors, faces, etc
* wavatar: generated faces with differing features and backgrounds
* retro: awesome generated, 8-bit arcade-style pixelated faces
* robohash: a generated robot with different colors, faces, etc
* blank: a transparent PNG image

![Mystery-man default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y)
![Identicon default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=identicon&f=y)
![Wavatar default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=wavatar&f=y)
![Retro default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=retro&f=y)
![Robohash default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=robohash&f=y)
![Blank default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=blank&f=y)

```php
// pass the default Gravatar image as third argument of `Gravatar::image()` and `Gravatar::images()`
$gravatarImage = Gravatar::image($email, null, 'mp');
$gravatarImages = Gravatar::images($emails, null, 'mp');

// or with named parameters
$gravatarImage = Gravatar::image($email, defaultImage: 'mp');
$gravatarImages = Gravatar::images($emails, defaultImage: 'mp');

// or use the `setDefaultImage()` method of a `Gravatar\Image` instance
$gravatarImage = gravatar($email);
$gravatarImage->setDefaultImage('mp');

$gravatarImage = new Gravatar\Image($email);
$gravatarImage->setDefaultImage('mp');

// or the `defaultImage()` helper method of a `Gravatar\Image` instance
$gravatarImage = gravatar($email);
$gravatarImage->defaultImage('mp');

$gravatarImage = new Gravatar\Image($email);
$gravatarImage->defaultImage('mp');

// or its alias `d()`
$gravatarImage = new Gravatar\Image($email);
$gravatarImage = gravatar($email);
$gravatarImage->d('mp');

$gravatarImage->d('mp');
```

If you want to retrieve the currently set avatar default image, you can use one of following methods:

```php
// call the `getDefaultImage()` method of a `Gravatar\Image` instance without argument
$gravatarImage = gravatar();
$gravatarImage->getDefaultImage();

$gravatarImage = new Gravatar\Image();
$gravatarImage->getDefaultImage();

// or the `defaultImage()` helper method of a `Gravatar\Image` instance without argument
$gravatarImage = gravatar();
$gravatarImage->defaultImage();

$gravatarImage = new Gravatar\Image();
$gravatarImage->defaultImage();

// or its alias `d()`
$gravatarImage = gravatar();
$gravatarImage->d();

$gravatarImage = new Gravatar\Image();
$gravatarImage->d();
```

[Back to top](#gravatar)

### Gravatar image max rating

Gravatar allows users to self-rate their images so that they can indicate if an image is appropriate for a certain audience.
By default, only 'g' rated images are displayed unless you indicate that you would like to see higher ratings.

You may specify one of the following ratings to request images up to and including that rating:

* g: suitable for display on all websites with any audience type.
* pg: may contain rude gestures, provocatively dressed individuals, the lesser swear words, or mild violence.
* r: may contain such things as harsh profanity, intense violence, nudity, or hard drug use.
* x: may contain hardcore sexual imagery or extremely disturbing violence.

```php
// pass the Gravatar image max rating as fourth argument of `Gravatar::image()` and `Gravatar::images()`
$gravatarImage = Gravatar::image($email, null, null, 'g');
$gravatarImages = Gravatar::images($emails, null, null, 'g');

// or with named parameters
$gravatarImage = Gravatar::image($email, rating: 'g');
$gravatarImages = Gravatar::images($emails, rating: 'g');

// or use the `setMaxRating()` method of a `Gravatar\Image` instance
$gravatarImage = gravatar($email);
$gravatarImage->setMaxRating('g');

$gravatarImage = new Gravatar\Image($email);
$gravatarImage->setMaxRating('g');

// or the `maxrating()` helper method of a `Gravatar\Image` instance
$gravatarImage = gravatar($email);
$gravatarImage->maxrating('g');

$gravatarImage = new Gravatar\Image($email);
$gravatarImage->maxrating('g');

// or its alias `r()`
$gravatarImage = gravatar($email);
$gravatarImage->r('g');

$gravatarImage = new Gravatar\Image($email);
$gravatarImage->r('g');
```

If you want to retrieve the currently set avatar max rating, you can use one of following methods:

```php
// call the `getMaxRating()` method of a `Gravatar\Image` instance without argument
$gravatarImage = gravatar();
$gravatarImage->getMaxRating();

$gravatarImage = new Gravatar\Image();
$gravatarImage->getMaxRating();

// or the `maxrating()` helper method of a `Gravatar\Image` instance without argument
$gravatarImage = gravatar();
$gravatarImage->maxrating();

$gravatarImage = new Gravatar\Image();
$gravatarImage->maxrating();

// or its alias `r()`
$gravatarImage = gravatar();
$gravatarImage->r();

$gravatarImage = new Gravatar\Image();
$gravatarImage->r();
```

[Back to top](#gravatar)

### Gravatar image file-type extension

If you require a file-type extension (some places do) then you may also specify it.

```php
// pass the Gravatar image file-type extension as fifth argument of `Gravatar::image()` and `Gravatar::images()`
Gravatar::image($email, null, null, null, 'jpg');
Gravatar::images($emails, null, null, null, 'jpg');

// or with named parameters
$gravatarImage = Gravatar::image($email, extension: 'jpg');
$gravatarImages = Gravatar::images($emails, extension: 'jpg');

// or use the `setExtension()` method of a `Gravatar\Image` instance
$gravatarImage = gravatar($email);
$gravatarImage->setExtension('jpg');

$gravatarImage = new Gravatar\Image($email);
$gravatarImage->setExtension('jpg');

// or the `extension()` helper method of a `Gravatar\Image` instance
$gravatarImage = gravatar($email);
$gravatarImage->extension('jpg');

$gravatarImage = new Gravatar\Image($email);
$gravatarImage->extension('jpg');

// or its alias `e()`
$gravatarImage = gravatar($email);
$gravatarImage->e('jpg');

$gravatarImage = new Gravatar\Image($email);
$gravatarImage->e('jpg');
```

If you want to retrieve the currently set avatar file-type extension, you can use one of following methods:

```php
// call the `getExtension()` method of a `Gravatar\Image` instance without argument
$gravatarImage = gravatar();
$gravatarImage->getExtension();

$gravatarImage = new Gravatar\Image();
$gravatarImage->getExtension();

// or the `extension()` helper method of a `Gravatar\Image` instance without argument
$gravatarImage = gravatar();
$gravatarImage->getExtension();

$gravatarImage = new Gravatar\Image();
$gravatarImage->extension();

// or its alias `e()`
$gravatarImage = gravatar();
$gravatarImage->getExtension();

$gravatarImage = new Gravatar\Image();
$gravatarImage->e();
```

[Back to top](#gravatar)

### Force to always use the default image

If for some reason you wanted to force the default image to always be load, you can do it:

```php
// to force to always use the default image, set the sixth argument of `Gravatar::image()` and `Gravatar::images()` to `true`
Gravatar::image($email, null, null, null, null, true);
Gravatar::images($emails, null, null, null, null, true);

// or with named parameters
$gravatarImage = Gravatar::image($email, forceDefault: true);
$gravatarImages = Gravatar::images($emails, forceDefault: true);

// or use the `setForceDefault()` method of a `Gravatar\Image` instance
$gravatarImage = gravatar($email);
$gravatarImage->setForceDefault(true);

$gravatarImage = new Gravatar\Image($email);
$gravatarImage->setForceDefault(true);

// or the `forceDefault()` helper method of a `Gravatar\Image` instance
$gravatarImage = gravatar($email);
$gravatarImage->forceDefault(true);

$gravatarImage = new Gravatar\Image($email);
$gravatarImage->forceDefault(true);

// or its alias `f()`
$gravatarImage = gravatar($email);
$gravatarImage->f(true);

$gravatarImage = new Gravatar\Image($email);
$gravatarImage->f(true);

// or use the `enableForceDefault()` method of a `Gravatar\Image` instance
$gravatarImage = gravatar($email);
$gravatarImage->setForceDefault(true);

$gravatarImage = new Gravatar\Image($email);
$gravatarImage->enableForceDefault();
```

To check to see if you are forcing default image, call the method `forcingDefault()` of `Gravatar\Image`,
which will return a boolean value regarding whether or not forcing default is enabled.

```php
$gravatarImage = gravatar();
$gravatarImage->enableForceDefault();
//...
$gravatarImage->forcingDefault(); // true
//...
$gravatarImage->disableForceDefault();
//...
$gravatarImage->forcingDefault(); // false
```

[Back to top](#gravatar)

### Gravatar profile format

Gravatar profile data may be requested in different data formats for simpler programmatic access.

```php
// pass the Gravatar profile format as second argument of `Gravatar::profile()` and `Gravatar::profiles()`
Gravatar::profile($email, 'json');

// or use the `setFormat()` method of `Gravatar\Profile` instance
$gravatarProfile = new Gravatar\Profile($email);
$gravatarProfile->setFormat('json');

// or the `format()` helper method of a `Gravatar\Profile` instance
$gravatarProfile = new Gravatar\Profile($email);
$gravatarProfile->format('json');

// or its alias `f()`
$gravatarProfile = new Gravatar\Profile($email);
$gravatarProfile->f('json');
```

The following formats are supported:

* JSON ; use 'json' as argument
* XML ; use 'xml' as argument
* PHP ; use 'php' as argument
* VCF/vCard ; use 'vcf' as argument
* QR Code ; use 'qr' as argument

[Back to top](#gravatar)

License
-------

This library is licensed under the MIT license; you can find a full copy of the license itself in the file /LICENSE
