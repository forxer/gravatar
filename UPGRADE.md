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

**2. Setter Methods Removed**

All setter methods have been removed. Use helper methods instead:

```php
// Before (v5.x)
$image->setEmail('email@example.com');
$image->setSize(120);
$image->setExtension('jpg');
$image->setMaxRating('pg');
$image->setDefaultImage('robohash');
$image->setForceDefault(true);
$image->setInitials('JD');
$image->setName('John Doe');

$profile->setFormat('json');

// After (v6.x) - use helper methods
$image->email('email@example.com');
$image->size(120);
$image->extension('jpg');
$image->maxRating('pg');
$image->defaultImage('robohash');
$image->forceDefault(true);
$image->initials('JD');
$image->name('John Doe');

$profile->format('json');

// Or use fluent shorthand methods
$image->extensionJpg()
      ->ratingPg()
      ->defaultImageRobohash();
```

**3. Properties Are Now Read-Only**

All properties use PHP 8.4's asymmetric visibility (`public private(set)`). They are publicly readable but can only be modified through helper methods:

```php
// Reading properties works
echo $image->email;      // Works!
echo $image->size;       // Works!

// Writing to them directly throws an error
$image->email = 'new@example.com';  // Error!

// Use helper methods to modify values
$image->email('new@example.com');  // Works!
```

**4. Short Alias Methods Removed**

The short alias methods (`s()`, `e()`, `r()`, `d()`, `f()`) have been removed for better code clarity:

```php
// Before (v5.x)
$image->s(120);       // size
$image->e('jpg');     // extension
$image->r('pg');      // rating
$image->d('mp');      // default image
$image->f(true);      // force default

// After (v6.x) - use full names
$image->size(120);
$image->extension('jpg');
$image->maxRating('pg');
$image->defaultImage('mp');
$image->forceDefault(true);

// Or use new fluent shorthand methods (recommended)
$image->extensionJpg()
      ->ratingPg()
      ->defaultImageMp();
```

**5. Helper Methods Are Now the Primary API**

The helper methods (`email()`, `size()`, `extension()`, etc.) are now the recommended way to both get and set values:

```php
// Get value (or use direct property access)
$size = $image->size();      // Helper method
$size = $image->size;        // Direct property access (also works)

// Set value (must use helper method)
$image->size(200);           // Helper method (required)
```

**6. Validation Now Happens in Property Hooks**

All conversion and validation logic now happens automatically in PHP 8.4 property hooks when you use helper methods. This provides the same validation behavior but with more modern PHP syntax internally.

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

1. **Update your PHP version to 8.4 or higher**

2. **Replace all getter method calls with direct property access:**
   - Find: `->getEmail()` → Replace: `->email`
   - Find: `->getSize()` → Replace: `->size`
   - Find: `->getExtension()` → Replace: `->extension`
   - Find: `->getMaxRating()` → Replace: `->maxRating`
   - Find: `->getDefaultImage()` → Replace: `->defaultImage`
   - Find: `->getFormat()` → Replace: `->format`
   - Find: `->getInitials()` → Replace: `->initials`
   - Find: `->getName()` → Replace: `->name`
   - Find: `->getForceDefault()` → Replace: `->forceDefault`

3. **Replace all setter method calls with helper methods:**
   - Find: `->setEmail(` → Replace: `->email(`
   - Find: `->setSize(` → Replace: `->size(`
   - Find: `->setExtension(` → Replace: `->extension(`
   - Find: `->setMaxRating(` → Replace: `->maxRating(`
   - Find: `->setDefaultImage(` → Replace: `->defaultImage(`
   - Find: `->setFormat(` → Replace: `->format(`
   - Find: `->setInitials(` → Replace: `->initials(`
   - Find: `->setName(` → Replace: `->name(`
   - Find: `->setForceDefault(` → Replace: `->forceDefault(`

4. **Replace all short alias methods:**
   - Find: `->s(` → Replace: `->size(`
   - Find: `->e(` → Replace: `->extension(` or `->extensionJpg()`, etc.
   - Find: `->r(` → Replace: `->maxRating(` or `->ratingPg()`, etc.
   - Find: `->d(` → Replace: `->defaultImage(` or `->defaultImageMp()`, etc.
   - Find: `->f(` (on Image) → Replace: `->forceDefault(`
   - Find: `->f(` (on Profile) → Replace: `->format(` or `->formatJson()`, etc.

5. **Test your application thoroughly**

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
