Optional parameters
===================

Gravatar image size
-------------------

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
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->setSize(120);

// or the `size()` helper method of a `Gravatar\Image` instance
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->size(120);
```

If you want to retrieve the currently set avatar size, you can use one of following methods:

```php
// access the `size` property directly (recommended in v6+)
$gravatarImage = new Gravatar\Image();
$size = $gravatarImage->size;

// or call the `size()` helper method without argument
$gravatarImage = new Gravatar\Image();
$gravatarImage->size();
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

```php
// pass the default Gravatar image as third argument of `Gravatar::image()` and `Gravatar::images()`
$gravatarImage = Gravatar::image($email, null, 'mp');
$gravatarImages = Gravatar::images($emails, null, 'mp');

// or with named parameters
$gravatarImage = Gravatar::image($email, defaultImage: 'mp');
$gravatarImages = Gravatar::images($emails, defaultImage: 'mp');

// or use the `setDefaultImage()` method of a `Gravatar\Image` instance
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->setDefaultImage('mp');

// or the `defaultImage()` helper method of a `Gravatar\Image` instance
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->defaultImage('mp');
```

If you want to retrieve the currently set avatar default image, you can use one of following methods:

```php
// access the `defaultImage` property directly (recommended in v6+)
$gravatarImage = new Gravatar\Image();
$defaultImage = $gravatarImage->defaultImage;

// or call the `defaultImage()` helper method without argument
$gravatarImage = new Gravatar\Image();
$gravatarImage->defaultImage();
```

### Customize the initials default image

When using `initials` as the default image type, Gravatar will display initials from the user's profile along with a generated background and foreground color.

You can customize which initials are displayed by providing them explicitly or by providing a name from which the initials will be extracted.

**Using convenience methods (recommended):**

```php
// use the `withInitials()` method - automatically sets default image to 'initials'
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->withInitials('JD');

// or use the `withName()` method - automatically sets default image to 'initials'
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->withName('John Doe');
```

**Using explicit methods:**

```php
// manually set default image and then provide initials
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->defaultImage('initials')->initials('JD');

// manually set default image and then provide name
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->defaultImage('initials')->name('John Doe');
```

**Note:** The `initials()` and `name()` methods only have an effect when the default image is set to `'initials'`. These parameters are ignored for other default image types. To avoid confusion, use the convenience methods `withInitials()` or `withName()` which automatically set the default image type.

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

```php
// pass the Gravatar image max rating as fourth argument of `Gravatar::image()` and `Gravatar::images()`
$gravatarImage = Gravatar::image($email, null, null, 'g');
$gravatarImages = Gravatar::images($emails, null, null, 'g');

// or with named parameters
$gravatarImage = Gravatar::image($email, rating: 'g');
$gravatarImages = Gravatar::images($emails, rating: 'g');

// or use the `setMaxRating()` method of a `Gravatar\Image` instance
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->setMaxRating('g');

// or the `maxRating()` helper method of a `Gravatar\Image` instance
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->maxRating('g');
```

If you want to retrieve the currently set avatar max rating, you can use one of following methods:

```php
// access the `maxRating` property directly (recommended in v6+)
$gravatarImage = new Gravatar\Image();
$rating = $gravatarImage->maxRating;

// or call the `maxRating()` helper method without argument
$gravatarImage = new Gravatar\Image();
$gravatarImage->maxRating();
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

```php
// pass the Gravatar image file-type extension as fifth argument of `Gravatar::image()` and `Gravatar::images()`
Gravatar::image($email, null, null, null, 'jpg');
Gravatar::images($emails, null, null, null, 'jpg');

// or with named parameters
$gravatarImage = Gravatar::image($email, extension: 'jpg');
$gravatarImages = Gravatar::images($emails, extension: 'jpg');

// or use the `setExtension()` method of a `Gravatar\Image` instance
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->setExtension('jpg');

// or the `extension()` helper method of a `Gravatar\Image` instance
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->extension('jpg');
```

If you want to retrieve the currently set avatar file-type extension, you can use one of following methods:

```php
// access the `extension` property directly (recommended in v6+)
$gravatarImage = new Gravatar\Image();
$extension = $gravatarImage->extension;

// or call the `extension()` helper method without argument
$gravatarImage = new Gravatar\Image();
$gravatarImage->extension();
```

Force to always use the default image
--------------------------------------

If for some reason you wanted to force the default image to always be load, you can do it:

```php
// to force to always use the default image, set the sixth argument of `Gravatar::image()` and `Gravatar::images()` to `true`
Gravatar::image($email, null, null, null, null, true);
Gravatar::images($emails, null, null, null, null, true);

// or with named parameters
$gravatarImage = Gravatar::image($email, forceDefault: true);
$gravatarImages = Gravatar::images($emails, forceDefault: true);

// or use the `setForceDefault()` method of a `Gravatar\Image` instance
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->setForceDefault(true);

// or the `forceDefault()` helper method of a `Gravatar\Image` instance
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->forceDefault(true);

// or use the `enableForceDefault()` method of a `Gravatar\Image` instance
$gravatarImage = new Gravatar\Image($email);
$gravatarImage->enableForceDefault();
```

To check to see if you are forcing default image, call the method `forcingDefault()` of `Gravatar\Image`,
which will return a boolean value regarding whether or not forcing default is enabled.

```php
$gravatarImage = new Gravatar\Image();
$gravatarImage->enableForceDefault();
//...
$gravatarImage->forcingDefault(); // true
//...
$gravatarImage->disableForceDefault();
//...
$gravatarImage->forcingDefault(); // false
```

Gravatar profile format
-----------------------

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
```

The following formats are supported:

* JSON ; use 'json' as argument
* XML ; use 'xml' as argument
* PHP ; use 'php' as argument
* VCF/vCard ; use 'vcf' as argument
* QR Code ; use 'qr' as argument
