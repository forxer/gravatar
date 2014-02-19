# Gravatar

Gravatar is a small library intended to provide easy integration of... Gravatar :)

It will help you generate the URL Gravatar for avatar and profiles.

## License

This library is licensed under the MIT license; you can find a full copy of the license itself in the file /LICENSE

## Installation

### Requirements

* PHP 5.3.0 or newer

### With Composer

The easiest way to install Gravatar is via [composer](http://getcomposer.org/).

```json
{
	"require": {
		"forxer/Gravatar": "*"
	}
}
```

## Usage examples

### Single avatar/profile

If you want to retrieve a single avatar/profile URL you can use the main Gravatar class like this:

```php
<?php
require 'vendor/autoload.php';

use forxer\Gravatar\Gravatar;

// Get a single avatar
echo Gravatar::avatar('email@example.com');
// output: http://www.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e

// Get a single profile
echo Gravatar::profile('email@example.com');
// output: http://www.gravatar.com/5658ffccee7f0ebfda2b226238b1eb6e

```

### Single avatar/profile with optionnals parameters

You can add some optionnals parameters :

* avatar size
* default avatar image
* max rating
* file-type extension
* use secure URL
* profile format

```php
<?php
require 'vendor/autoload.php';

use forxer\Gravatar\Gravatar;

// Get a single avatar with size and default image:
Gravatar::avatar('email@example.com', 120, 'mm')
// output: http://www.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e?s=120&d=mm

// Get a single avatar with all options:
Gravatar::avatar('email@example.com', 120, 'mm', 'g', 'jpg', true)
// output: https://secure.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e.jpg?s=120&d=mm&r=g

// Get a single profile in JSON
echo Gravatar::profile('email@example.com', 'json');
// output: http://www.gravatar.com/5658ffccee7f0ebfda2b226238b1eb6e.json

```

### Multiples avatars/profiles

If you want to retrieve multiples avatars/profiles URL you should process like this:

```php
<?php
require 'vendor/autoload.php';

use forxer\Gravatar\Avatar;
use forxer\Gravatar\Profile;

// Get a multiples avatars
$avatar = new Avatar();

foreach ($emails as $email) {
	echo $avatar->getUrl($email);
}

// Get a multiples profiles
$profile = new Profile();

foreach ($emails as $email) {
	echo $profile->getUrl($email);
}

```

### Multiples avatars/profiles with optionnals parameters

The advantage of this method is that you do not have to be redefined every time the optional parameters:

```php
<?php
require 'vendor/autoload.php';

use forxer\Gravatar\Avatar;
use forxer\Gravatar\Profile;

$emails = array('email1@example.com', 'email2@example.com', 'email3@example.com', 'email4@example.com');

// Get a multiples avatars with size and default image:
$avatar = new Avatar();
$avatar
	->setSize(120)
	->setDefaultImage('mm');

foreach ($emails as $email) {
	echo $avatar->getUrl($email);
}

// Get a multiples profiles in JSON
$profile = new Profile();
$profile->setFormat('json');

foreach ($emails as $email) {
	echo $profile->getUrl($email);
}

```

## Optionnales parameters

### Avatar size

By default, images are presented at 80px by 80px if no size parameter is supplied.
You may request a specific image size, which will be dynamically delivered from Gravatar.
You may request images anywhere from 1px up to 2048px, however note that many users have lower resolution images,
so requesting larger sizes may result in pixelation/low-quality images.

An avatar size should be an integer representing the size in pixels.

### Default avatar image


### Avatar max rating

Gravatar allows users to self-rate their images so that they can indicate if an image is appropriate for a certain audience.
By default, only 'G' rated images are displayed unless you indicate that you would like to see higher ratings.

### Avatar file-type extension

### Avatar Use secure URL

### Profile format
