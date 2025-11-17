Optional parameters
===================

Gravatar image size
-------------------

By default, images are presented at 80px by 80px if no size parameter is supplied.
You may request a specific image size, which will be dynamically delivered from Gravatar.
You may request images anywhere from 1px up to 2048px, however note that many users have lower resolution images,
so requesting larger sizes may result in pixelation/low-quality images.

An avatar size should be an integer representing the size in pixels.

**1. Using helper method:**

```php
// Set size
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->size(120);

// Get size
$size = $gravatarImage->size();

// Via static methods
$gravatarImage = Gravatar::image($email, 120);
```

**2. Using direct property access:**

```php
// Set size
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->size = 120;

// Get size
$size = $gravatarImage->size;
```

Default Gravatar image
----------------------

What happens when an email address has no matching Gravatar image or when the gravatar specified exceeds your maximum allowed content rating?

By default, this:

![Default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000)

If you'd prefer to use your own default image, then you can easily do so by supplying the URL to an image.
In addition to allowing you to use your own image, Gravatar has a number of built in options which you can also use as defaults.
Most of these work by taking the requested email hash and using it to generate a themed image that is unique to that email address.
To use these options, just pass one of the following keywords:

* initials: uses the profile name as initials, with a generated background and foreground color
* color: a generated color
* 404: do not load any image if none is associated with the email hash, instead return an HTTP 404 (File Not Found) response
* mp: (mystery-person) a simple, cartoon-style silhouetted outline of a person (does not vary by email hash)
* identicon: a geometric pattern based on an email hash
* monsterid: a generated 'monster' with different colors, faces, etc
* wavatar: generated faces with differing features and backgrounds
* retro: awesome generated, 8-bit arcade-style pixelated faces
* robohash: a generated robot with different colors, faces, etc
* blank: a transparent PNG image

![Initials default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=initials&initials=JD&f=y)
![Mystery-person default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y)
![Identicon default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=identicon&f=y)
![Wavatar default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=wavatar&f=y)
![Retro default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=retro&f=y)
![Robohash default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=robohash&f=y)
![Blank default Gravatar image](http://www.gravatar.com/avatar/00000000000000000000000000000000?d=blank&f=y)

**1. Using helper method:**

```php
// Set default image
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->defaultImage('mp');

// Get default image
$defaultImage = $gravatarImage->defaultImage();

// Via static methods
$gravatarImage = Gravatar::image($email, null, 'mp');
// or with named parameters
$gravatarImage = Gravatar::image($email, defaultImage: 'mp');
```

**2. Using direct property access:**

```php
// Set default image
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->defaultImage = 'mp';

// Get default image
$defaultImage = $gravatarImage->defaultImage;
```

### Customize the initials default image

When using `initials` as the default image type, Gravatar will display initials from the user's profile along with a generated background and foreground color.

You can customize which initials are displayed by providing them explicitly or by providing a name from which the initials will be extracted.

**1. Using helper methods:**

```php
// Set default image and provide initials
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->defaultImage('initials')->initials('JD');

// Or set default image and provide name
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->defaultImage('initials')->initialsName('John Doe');

// Get values
$initials = $gravatarImage->initials();
$name = $gravatarImage->initialsName();
```

**2. Using convenience methods (recommended):**

```php
// Automatically sets default image to 'initials' and provides initials
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->withInitials('JD');

// Automatically sets default image to 'initials' and provides name
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->withInitialsName('John Doe');
```

**3. Using direct property access:**

```php
// Set values
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->defaultImage = 'initials';
$gravatarImage->initials = 'JD';
// or
$gravatarImage->initialsName = 'John Doe';

// Get values
$initials = $gravatarImage->initials;
$name = $gravatarImage->initialsName;
```

**Note:** The `initials` and `initialsName` properties only have an effect when the default image is set to `'initials'`. These parameters are ignored for other default image types. To avoid confusion, use the convenience methods `withInitials()` or `withInitialsName()` which automatically set the default image type.

**Important:** If you provide both initials and a name, the explicitly provided initials will take precedence over the name.

Gravatar image max rating
--------------------------

Gravatar allows users to self-rate their images so that they can indicate if an image is appropriate for a certain audience.
By default, only 'g' rated images are displayed unless you indicate that you would like to see higher ratings.

You may specify one of the following ratings to request images up to and including that rating:

* g: suitable for display on all websites with any audience type.
* pg: may contain rude gestures, provocatively dressed individuals, the lesser swear words, or mild violence.
* r: may contain such things as harsh profanity, intense violence, nudity, or hard drug use.
* x: may contain hardcore sexual imagery or extremely disturbing violence.

**1. Using helper method:**

```php
// Set max rating
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->maxRating('pg');

// Get max rating
$rating = $gravatarImage->maxRating();

// Via static methods
$gravatarImage = Gravatar::image($email, null, null, 'pg');
// or with named parameters
$gravatarImage = Gravatar::image($email, rating: 'pg');
```

**2. Using direct property access:**

```php
// Set max rating
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->maxRating = 'pg';

// Get max rating
$rating = $gravatarImage->maxRating;
```

Gravatar image file-type extension
-----------------------------------

If you require a file-type extension (some places do) then you may also specify it.

You can specify one of the following extensions for the generated URL:

* 'jpg'
* 'jpeg'
* 'gif'
* 'png'
* 'webp'

**1. Using helper method:**

```php
// Set extension
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->extension('jpg');

// Get extension
$extension = $gravatarImage->extension();

// Via static methods
$gravatarImage = Gravatar::image($email, null, null, null, 'jpg');
// or with named parameters
$gravatarImage = Gravatar::image($email, extension: 'jpg');
```

**2. Using direct property access:**

```php
// Set extension
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->extension = 'jpg';

// Get extension
$extension = $gravatarImage->extension;
```

Force to always use the default image
--------------------------------------

If for some reason you wanted to force the default image to always be load, you can do it:

**1. Using helper method:**

```php
// Set force default
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->forceDefault(true);

// Get force default
$isForced = $gravatarImage->forceDefault();

// Via static methods
$gravatarImage = Gravatar::image($email, null, null, null, null, true);
// or with named parameters
$gravatarImage = Gravatar::image($email, forceDefault: true);
```

**2. Using convenience methods:**

```php
// Enable force default
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->enableForceDefault();

// Check if forcing default
$isForcing = $gravatarImage->forcingDefault(); // true

// Disable force default
$gravatarImage->disableForceDefault();
$isForcing = $gravatarImage->forcingDefault(); // false
```

**3. Using direct property access:**

```php
// Set force default
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->forceDefault = true;

// Get force default
$isForced = $gravatarImage->forceDefault;
```

Gravatar profile format
-----------------------

Gravatar profile data may be requested in different data formats for simpler programmatic access.

**1. Using helper method:**

```php
// Set format
$gravatarProfile = new Gravatar\Profile($email);
$gravatarProfile->format('json');

// Get format
$format = $gravatarProfile->format();

// Via static methods
$gravatarProfile = Gravatar::profile($email, 'json');
```

**2. Using direct property access:**

```php
// Set format
$gravatarProfile = new Gravatar\Profile($email);
$gravatarProfile->format = 'json';

// Get format
$format = $gravatarProfile->format;
```

The following formats are supported:

* JSON ; use 'json' as argument
* XML ; use 'xml' as argument
* PHP ; use 'php' as argument
* VCF/vCard ; use 'vcf' as argument
* QR Code ; use 'qr' as argument
