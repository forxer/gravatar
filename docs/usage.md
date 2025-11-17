Usage
=====

There are many ways to use this library:

- Use helpers functions
- Use the Gravatar base class with its `Gravatar::image()` and `Gravatar::profile()` methods
- Instantiate the dedicated classes `Gravatar\Image()` and `Gravatar\Profile()`

All of these ways return instances of `Gravatar\Image` and `Gravatar\Profile` that allow you to define specific settings/parameters as needed.

Whatever method you use, you could use the `url()` method to retrieve it. Or display the URL directly because they implement the `__toString()` method.

Use helpers
-----------

The easiest way to use this library is to use the helper functions.

Since version 4, in order to avoid conflicts with other packages, we no longer define the `gravatar()` and `gravatar_profile()` helpers. It's up to you to do this in your app with names that work for you and don't conflict with others. Here's how to do it; it's simple.

In a file dedicated to the helper functions, define the version 3 functions using the names that suit you.

```php
<?php

use Gravatar\Image;
use Gravatar\Profile;

if (! function_exists('gravatar')) {
    /**
     * Return a new Gravatar Image instance.
     *
     * @param string|null $email
     * @return Image
     */
    function gravatar(?string $email = null): Image
    {
        return new Image($email);
    }
}

if (! function_exists('gravatar_profile')) {
    /**
     * Return a new Gravatar Profile instance.
     *
     * @param string|null $email
     * @return Profile
     */
    function gravatar_profile(?string $email = null): Profile
    {
        return new Profile($email);
    }
}
```

If you do not have a helpers functions file, you can create one for example at the root of your project, which you name `helpers.php` and which you fill in the `composer.json` file so that it is autoloaded. For example :

```json
    "autoload" : {
        "psr-4" : {
            "YourProject\\" : "src"
        },
        "files" : [
            "src/helpers.php"
        ]
    },
```

This way you can use them like this:

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

// With optional parameters:
$avatar = gravatar('email@example.com')
    ->size(120)
    ->defaultImage('robohash')
    ->maxRating('pg')
    ->extension('jpg');
echo $avatar;

// Or set the email later:
$avatar = gravatar()
    ->email('email@example.com')
    ->size(200);
echo $avatar;

// With initials (convenience method):
$avatar = gravatar('email@example.com')
    ->withInitials('JD')
    ->size(120);
echo $avatar;

// Get a Gravatar profile instance:
$profile = gravatar_profile('email@example.com');
// return: Gravatar\Profile

// Get a Gravatar profile URL:
echo gravatar_profile('email@example.com');
// output: https//www.gravatar.com/5658ffccee7f0ebfda2b226238b1eb6e

// With format parameter:
$profileUrl = gravatar_profile('email@example.com')
    ->format('json')
    ->url();
```

Use the Gravatar base class
----------------------------

But it is also possible to use the static methods of the base Gravatar class.

### Single Gravatar image/profile

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
// return Gravatar\Profile

// Get a  Gravatar profile URL:
echo Gravatar::profile('email@example.com');
// output: https//www.gravatar.com/5658ffccee7f0ebfda2b226238b1eb6e
```

### Multiples Gravatar images/profiles

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

Instanciate the dedicated classes
----------------------------------

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

Mandatory parameter
-------------------

Obviously the email address is a mandatory parameter that can be entered in different ways.

```php
// the first argument of `Gravatar::image()` and `Gravatar::images()`
$gravatarImage = Gravatar::image($email);
$gravatarImages = Gravatar::images($emails);

// or pass it to the `Gravatar\Image` constructor
$gravatarImage = new Gravatar\Image($email);

// or use the `setEmail()` method of a `Gravatar\Image` instance
$gravatarImage = new Gravatar\Image();
$gravatarImage->setEmail($email);

// or the `email()` helper method of a `Gravatar\Image` instance
$gravatarImage = new Gravatar\Image();
$gravatarImage->email($email);
```

These previous examples are also valid for the profile.

```php
// the first argument of `Gravatar::profile()` and `Gravatar::profiles()`
$gravatarProfile = Gravatar::profile($email);
$gravatarProfiles = Gravatar::profiles($emails);

// or pass it to the `Gravatar\Profile` constructor
$gravatarProfile = new Gravatar\Profile($email);

// or use the `setEmail()` method of a `Gravatar\Profile` instance
$gravatarProfile = new Gravatar\Profile();
$gravatarProfile->setEmail($email);

// or the `email()` helper method of a `Gravatar\Profile` instance
$gravatarProfile = new Gravatar\Profile();
$gravatarProfile->email($email);
```

Copying instances
-----------------

You can create a copy of an existing `Gravatar\Image` or `Gravatar\Profile` instance with all its settings using the `copy()` method. This is useful when you want to reuse a base configuration with different email addresses or slight variations.

```php
// Create a base configuration
$baseAvatar = new Gravatar\Image();
$baseAvatar->size(120)
    ->defaultImage('robohash')
    ->maxRating('pg');

// Create copies with different emails
$avatar1 = $baseAvatar->copy('user1@example.com');
$avatar2 = $baseAvatar->copy('user2@example.com');

// Create a copy with the same email but modify other settings
$largeAvatar = $baseAvatar->copy()->size(200);
```

The same works for profiles:

```php
$baseProfile = new Gravatar\Profile();
$baseProfile->format('json');

$profile1 = $baseProfile->copy('user1@example.com');
$profile2 = $baseProfile->copy('user2@example.com');
```
