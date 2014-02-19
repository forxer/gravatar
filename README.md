# Gravatar

Gravatar is a small library intended to provide easy integration of... Gravatar :)

It will help you generate the URL for Gravatar images and profiles.

* [Installation](#install)
    * [Requirements](#requirements)
    * [With Composer](#withComposer)
* [Usage examples](#examples)
    * [Single Gravatar image/profile](#singleGravatar)
    * [Single Gravatar image/profile with optional parameters](#singleGravatarWithParameters)
    * [Multiples Gravatar images/profiles](#multiplesGravatars)
    * [Multiples Gravatar images/profiles with optional parameters](#multiplesGravatarsWithParameters)
* [Optional parameters](#optionalParameters)
    * [Gravatar image size](#paramImageSize)
    * [Default Gravatar image](#paramDefaultImage)
    * [Gravatar image max rating](#paramImageMaxRating)
    * [Gravatar image file-type extension](#paramImageExtension)
    * [Use secure URL for Gravatar image](#paramImageSecureUrl)
    * [Gravatar profile format](#paramProfileFormat)
* [License](#license)

<a name="install"/>
## Installation

<a name="install"/>
### Requirements

* PHP 5.3.0 or newer

<a name="withComposer"/>
### With Composer

The easiest way to install Gravatar is via [composer](http://getcomposer.org/).

```json
{
	"require": {
		"forxer/Gravatar": "*"
	}
}
```

<a name="examples"/>
## Usage examples

<a name="singleGravatar"/>
### Single Gravatar image/profile

If you want to retrieve a single Gravatar image/profile URL you can use the main Gravatar class like this:

```php
<?php
require 'vendor/autoload.php';

use forxer\Gravatar\Gravatar;

// Get a single Gravatar image
echo Gravatar::avatar('email@example.com');
// output: http://www.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e

// Get a single Gravatar profile
echo Gravatar::profile('email@example.com');
// output: http://www.gravatar.com/5658ffccee7f0ebfda2b226238b1eb6e
```

<a name="singleGravatarWithParameters"/>
### Single Gravatar image/profile with optional parameters

You can add some optional parameters :

* Gravatar image size
* Default Gravatar image
* Gravatar image max rating
* Gravatar image file-type extension
* Use secure URL for Gravatar image
* Profile format

```php
<?php
require 'vendor/autoload.php';

use forxer\Gravatar\Gravatar;

// Get a single Gravatar image with size and default image:
Gravatar::avatar('email@example.com', 120, 'mm')
// output: http://www.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e?s=120&d=mm

// Get a single Gravatar image with all options:
Gravatar::avatar('email@example.com', 120, 'mm', 'g', 'jpg', true)
// output: https://secure.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e.jpg?s=120&d=mm&r=g

// Get a single profile in JSON
echo Gravatar::profile('email@example.com', 'json');
// output: http://www.gravatar.com/5658ffccee7f0ebfda2b226238b1eb6e.json
```

<a name="multiplesGravatars"/>
### Multiples Gravatar images/profiles

In fact `Gravatar::avatar()` and `Gravatar::profile()` methods are just shorcuts for two other subclass thats manage Gravatar images and profiles.

So if you want to retrieve multiples Gravatar images/profiles URL you should instanciate this two classes:

```php
<?php
require 'vendor/autoload.php';

use forxer\Gravatar\Avatar;
use forxer\Gravatar\Profile;

$emails = array('email1@example.com', 'email2@example.com','email3@example.com', /* ... */ );

// Get multiples Gravatar images
$avatar = new Avatar();

foreach ($emails as $email) {
	echo $avatar->getUrl($email);
}

// Get multiples Gravatar profiles
$profile = new Profile();

foreach ($emails as $email) {
	echo $profile->getUrl($email);
}
```

<a name="multiplesGravatarsWithParameters"/>
### Multiples Gravatar images/profiles with optional parameters

The main advantage of this method is that you do not have to be redefined every time the optional parameters:

```php
<?php
require 'vendor/autoload.php';

use forxer\Gravatar\Avatar;
use forxer\Gravatar\Profile;

$emails = array('email1@example.com', 'email2@example.com','email3@example.com', /* ... */ );

// Get multiples Gravatar images with size and default image:
$avatar = new Avatar();
$avatar
	->setSize(120)
	->setDefaultImage('mm');

foreach ($emails as $email) {
	echo $avatar->getUrl($email);
}

// Get multiples Gravatar profiles in JSON
$profile = new Profile();
$profile->setFormat('json');

foreach ($emails as $email) {
	echo $profile->getUrl($email);
}
```

<a name="optionalParameters"/>
## Optional parameters

<a name="paramImageSize"/>
### Gravatar image size

By default, images are presented at 80px by 80px if no size parameter is supplied.
You may request a specific image size, which will be dynamically delivered from Gravatar.
You may request images anywhere from 1px up to 2048px, however note that many users have lower resolution images,
so requesting larger sizes may result in pixelation/low-quality images.

An avatar size should be an integer representing the size in pixels.

```php
// pass the size as second parameter of `Gravatar::avatar()`
Gravatar::avatar('email@example.com', 120);

// or use the `setSize()` method of \forxer\Gravatar\Avatar
$avatar = new Avatar();
$avatar
	->setSize(120);
```

<a name="paramDefaultImage"/>
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
// pass the default Gravatar image as third parameter of `Gravatar::avatar()`
Gravatar::avatar('email@example.com', null, 'mm');

// or use the `setDefaultImage()` method of \forxer\Gravatar\Avatar
$avatar = new Avatar();
$avatar
	->setDefaultImage('mm');
```

<a name="paramImageMaxRating"/>
### Gravatar image max rating

Gravatar allows users to self-rate their images so that they can indicate if an image is appropriate for a certain audience.
By default, only 'g' rated images are displayed unless you indicate that you would like to see higher ratings.

You may specify one of the following ratings to request images up to and including that rating:

* g: suitable for display on all websites with any audience type.
* pg: may contain rude gestures, provocatively dressed individuals, the lesser swear words, or mild violence.
* r: may contain such things as harsh profanity, intense violence, nudity, or hard drug use.
* x: may contain hardcore sexual imagery or extremely disturbing violence.

```php
// pass the Gravatar image max rating as fourth parameter of `Gravatar::avatar()`
Gravatar::avatar('email@example.com', null, null, 'g');

// or use the `setMaxRating()` method of \forxer\Gravatar\Avatar
$avatar = new Avatar();
$avatar
	->setMaxRating('g');
```

<a name="paramImageExtension"/>
### Gravatar image file-type extension

If you require a file-type extension (some places do) then you may also specify it.

```php
// pass the Gravatar image file-type extension as fifth parameter of `Gravatar::avatar()`
Gravatar::avatar('email@example.com', null, null, null, 'jpg');

// or use the `setExtension()` method of \forxer\Gravatar\Avatar
$avatar = new Avatar();
$avatar
	->setExtension('jpg');
```

<a name="paramImageSecureUrl"/>
### Use secure URL for Gravatar image

If your site is served over HTTPS, you'll likely want to serve gravatars over HTTPS as well to avoid "mixed content warnings".

```php
// to use secure URL for Gravatar image set the sixth parameter of `Gravatar::avatar()` to `true`
Gravatar::avatar('email@example.com', null, null, null, null, true);

// or use the `enableSecure()` method of \forxer\Gravatar\Avatar
$avatar = new Avatar();
$avatar
	->enableSecure();
```
To check to see if you are using "secure" mode, call the method `usingSecure()` of `Gravatar::avatar()`,
which will return a boolean value regarding whether or not secure mode is enabled.

```php
$avatar = new Avatar();
$avatar
	->enableSecure();

//...

$avatar->usingSecure(); // true

//...

$avatar->disableSecure();

//...

$avatar->usingSecure(); // false
```

<a name="paramProfileFormat"/>
### Gravatar profile format

Gravatar profile data may be requested in different data formats for simpler programmatic access.

```php
// pass the Gravatar profile format as second parameter of `Gravatar::profile()`
Gravatar::profile('email@example.com', 'json');

// or use the `setFormat()` method of \forxer\Gravatar\Profile
$profile = new Profile();
$profile
	->setFormat('json');
```

The following formats are supported:

* JSON ; use 'json' as parameter
* XML ; use 'xml' as parameter
* PHP ; use 'php' as parameter
* VCF/vCard ; use 'vcf' as parameter
* QR Code ; use 'qr' as parameter


<a name="license"/>
## License

This library is licensed under the MIT license; you can find a full copy of the license itself in the file /LICENSE