UPGRADE
=======

From 5.x to 6.x
---------------

This package now requires at least **PHP 8.4**, your project must correspond to this prerequisite.

### Major Changes

**1. Getter Methods Removed**

All getter methods have been removed. Use direct property access instead:

```php
// Before (v5.x)
$email = $image->getEmail();
$size = $image->getSize();
$extension = $image->getExtension();
$maxRating = $image->getMaxRating();
$defaultImage = $image->getDefaultImage();
$initials = $image->getInitials();
$name = $image->getName();
$forceDefault = $image->getForceDefault();

$format = $profile->getFormat();

// After (v6.x)
$email = $image->email;
$size = $image->size;
$extension = $image->extension;
$maxRating = $image->maxRating;
$defaultImage = $image->defaultImage;
$initials = $image->initials;
$name = $image->name;
$forceDefault = $image->forceDefault;

$format = $profile->format;
```

**2. Properties Are Now Publicly Readable**

All properties now use PHP 8.4's asymmetric visibility (`public private(set)`), making them readable from outside the class:

```php
// You can now read properties directly
echo $image->email;      // Works!
echo $image->size;       // Works!

// But you cannot write to them directly (will throw an error)
$image->email = 'new@example.com';  // Error!

// Use setter methods to modify values
$image->setEmail('new@example.com');  // Works!
```

**3. Helper Methods Remain Unchanged**

The helper methods (`email()`, `size()`, `extension()`, etc.) continue to work as before and can still be used for both getting and setting values:

```php
// Get value
$size = $image->size();

// Set value
$image->size(200);
```

**4. Validation Now Happens in Property Hooks**

Validation is now performed directly when setting properties through setter methods, using PHP 8.4's property hooks. This provides the same validation behavior but with more modern PHP syntax internally.

### New Features in v6.x

**1. Type-Safe Enums**

You can now use enum classes instead of strings for better type safety and IDE support:

```php
use Gravatar\Enum\Rating;
use Gravatar\Enum\Extension;
use Gravatar\Enum\DefaultImage;
use Gravatar\Enum\ProfileFormat;

// Using enums (recommended)
$image->setMaxRating(Rating::PG);
$image->setExtension(Extension::WEBP);
$image->setDefaultImage(DefaultImage::ROBOHASH);
$profile->setFormat(ProfileFormat::JSON);

// Strings still work for backward compatibility
$image->setMaxRating('pg');
$image->setExtension('webp');
$image->setDefaultImage('robohash');
$profile->setFormat('json');
```

**2. Fluent Shorthand Methods**

New fluent methods provide cleaner, more expressive syntax:

```php
// Before (v5.x and still valid in v6.x)
$image->setMaxRating('pg')
      ->setExtension('webp')
      ->setDefaultImage('robohash');

// After (v6.x with enums)
$image->setMaxRating(Rating::PG)
      ->setExtension(Extension::WEBP)
      ->setDefaultImage(DefaultImage::ROBOHASH);

// NEW in v6.x (fluent shorthand)
$image->ratingPg()
      ->extensionWebp()
      ->defaultImageRobohash();
```

Available fluent methods:
- **Ratings**: `ratingG()`, `ratingPg()`, `ratingR()`, `ratingX()`
- **Extensions**: `extensionJpg()`, `extensionJpeg()`, `extensionGif()`, `extensionPng()`, `extensionWebp()`
- **Default Images**: `defaultImageInitials()`, `defaultImageColor()`, `defaultImageNotFound()`, `defaultImageMp()`, `defaultImageIdenticon()`, `defaultImageMonsterid()`, `defaultImageWavatar()`, `defaultImageRetro()`, `defaultImageRobohash()`, `defaultImageBlank()`
- **Profile Formats**: `formatJson()`, `formatXml()`, `formatPhp()`, `formatVcf()`, `formatQr()`

All three syntaxes (strings, enums, and fluent methods) work together and can be mixed freely.

### Migration Steps

1. Update your PHP version to 8.4 or higher
2. Replace all getter method calls with direct property access:
   - Find: `->getEmail()`
   - Replace: `->email`
   - Find: `->getSize()`
   - Replace: `->size`
   - (and so on for all getter methods)
3. Ensure you're only using setter methods (not direct assignment) to modify properties
4. Test your application thoroughly

From 4.x to 5.x
---------------

This package now requires at least **PHP 8.2**, your project must correspond to this prerequisite.


From 3.x to 4.x
---------------

In version 3 I introduced 2 helpers `gravatar()` and `gravatar_profile()` but it was a bad idea.

The `gravatar()` and `gravatar_profile()` helpers have been removed from the package because they could conflict with other global functions of the same name.

I prefer to indicate how to define your own helpers rather than embedding them "hard" in the package. See the [helpers section in the README.md](https://github.com/forxer/gravatar#use-helpers) file.


From 2.x to 3.x
---------------

This package now requires at least **PHP 8**, your project must correspond to this prerequisite.

Namespaces have been renamed from `forxer\Gravatar\` to `Gravatar\` :

- Find: `use forxer\Gravatar`
- Replace: `use Gravatar`

The `getUrl(string $email)` method has been renamed to `url()` and it no longer accepts arguments. You must define the email address to use before invoking it using the various methods available for this (see the README.md file).
