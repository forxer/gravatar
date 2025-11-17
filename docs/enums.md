Using type-safe enums
=====================

Since version 6.0, you can use type-safe enum classes instead of strings for better IDE support and type safety. All methods accept both enums and strings for maximum flexibility.

Available enums
---------------

```php
use Gravatar\Enum\Rating;
use Gravatar\Enum\Extension;
use Gravatar\Enum\DefaultImage;
use Gravatar\Enum\ProfileFormat;
```

**Rating enum** - Maximum image rating:
- `Rating::G` - General audiences
- `Rating::PG` - Parental guidance
- `Rating::R` - Restricted
- `Rating::X` - Explicit

**Extension enum** - Image file extensions:
- `Extension::JPG`
- `Extension::JPEG`
- `Extension::GIF`
- `Extension::PNG`
- `Extension::WEBP`

**DefaultImage enum** - Default image types:
- `DefaultImage::INITIALS` - User initials
- `DefaultImage::COLOR` - Generated color
- `DefaultImage::NOT_FOUND` - 404 response
- `DefaultImage::MYSTERY_PERSON` - Mystery person silhouette
- `DefaultImage::IDENTICON` - Geometric pattern
- `DefaultImage::MONSTERID` - Generated monster
- `DefaultImage::WAVATAR` - Generated face
- `DefaultImage::RETRO` - 8-bit arcade style
- `DefaultImage::ROBOHASH` - Generated robot
- `DefaultImage::BLANK` - Transparent PNG

**ProfileFormat enum** - Profile data formats:
- `ProfileFormat::JSON`
- `ProfileFormat::XML`
- `ProfileFormat::PHP`
- `ProfileFormat::VCF`
- `ProfileFormat::QR`

Usage examples
--------------

```php
use Gravatar\Image;
use Gravatar\Enum\Rating;
use Gravatar\Enum\Extension;
use Gravatar\Enum\DefaultImage;

$image = new Image('email@example.com');

// Using enums with helper methods (recommended for type safety)
$image->maxRating(Rating::PG);
$image->extension(Extension::JPG);
$image->defaultImage(DefaultImage::ROBOHASH);

// Using enums with direct property assignment (also works!)
$image->maxRating = Rating::PG;
$image->extension = Extension::JPG;
$image->defaultImage = DefaultImage::ROBOHASH;

// Using strings with helper methods (still fully supported)
$image->maxRating('pg');
$image->extension('jpg');
$image->defaultImage('robohash');

// Using strings with direct property assignment (also works!)
$image->maxRating = 'pg';
$image->extension = 'jpg';
$image->defaultImage = 'robohash';

// You can mix all approaches
$image->maxRating(Rating::G)
    ->extension('png')
    ->defaultImage(DefaultImage::RETRO);
```

**Benefits of using enums:**
- IDE autocomplete and type hints
- Compile-time validation
- No typos in string values
- Self-documenting code

Fluent shorthand methods
------------------------

Since version 6.0, you can use convenient fluent methods as shortcuts for common configurations. These methods provide a cleaner, more expressive syntax while keeping full backward compatibility.

**Available for ratings:**

```php
$image->ratingG();    // equivalent to $image->maxRating(Rating::G) or $image->maxRating = Rating::G
$image->ratingPg();   // equivalent to $image->maxRating(Rating::PG)
$image->ratingR();    // equivalent to $image->maxRating(Rating::R)
$image->ratingX();    // equivalent to $image->maxRating(Rating::X)
```

**Available for extensions:**

```php
$image->extensionJpg();   // equivalent to $image->extension(Extension::JPG) or $image->extension = Extension::JPG
$image->extensionJpeg();  // equivalent to $image->extension(Extension::JPEG)
$image->extensionGif();   // equivalent to $image->extension(Extension::GIF)
$image->extensionPng();   // equivalent to $image->extension(Extension::PNG)
$image->extensionWebp();  // equivalent to $image->extension(Extension::WEBP)
```

**Available for default images:**

```php
$image->defaultImageInitials();    // equivalent to $image->defaultImage(DefaultImage::INITIALS)
$image->defaultImageColor();       // equivalent to $image->defaultImage(DefaultImage::COLOR)
$image->defaultImageNotFound();    // equivalent to $image->defaultImage(DefaultImage::NOT_FOUND)
$image->defaultImageMp();          // equivalent to $image->defaultImage(DefaultImage::MYSTERY_PERSON)
$image->defaultImageIdenticon();   // equivalent to $image->defaultImage(DefaultImage::IDENTICON)
$image->defaultImageMonsterid();   // equivalent to $image->defaultImage(DefaultImage::MONSTERID)
$image->defaultImageWavatar();     // equivalent to $image->defaultImage(DefaultImage::WAVATAR)
$image->defaultImageRetro();       // equivalent to $image->defaultImage(DefaultImage::RETRO)
$image->defaultImageRobohash();    // equivalent to $image->defaultImage(DefaultImage::ROBOHASH)
$image->defaultImageBlank();       // equivalent to $image->defaultImage(DefaultImage::BLANK)
```

**Available for profile formats:**

```php
$profile->formatJson();  // equivalent to $profile->format(ProfileFormat::JSON) or $profile->format = ProfileFormat::JSON
$profile->formatXml();   // equivalent to $profile->format(ProfileFormat::XML)
$profile->formatPhp();   // equivalent to $profile->format(ProfileFormat::PHP)
$profile->formatVcf();   // equivalent to $profile->format(ProfileFormat::VCF)
$profile->formatQr();    // equivalent to $profile->format(ProfileFormat::QR)
```

**Complete example with fluent methods:**

```php
use Gravatar\Image;
use Gravatar\Profile;

// Clean, expressive syntax
$image = (new Image('email@example.com'))
    ->size(120)
    ->ratingPg()
    ->extensionWebp()
    ->defaultImageRobohash();

$profile = (new Profile('email@example.com'))
    ->formatJson();

// Compare with the equivalent traditional syntax using helper methods:
$image = (new Image('email@example.com'))
    ->size(120)
    ->maxRating(Rating::PG)
    ->extension(Extension::WEBP)
    ->defaultImage(DefaultImage::ROBOHASH);

// Or with direct property assignment:
$image = new Image('email@example.com');
$image->size = 120;
$image->maxRating = Rating::PG;
$image->extension = Extension::WEBP;
$image->defaultImage = DefaultImage::ROBOHASH;
```

These fluent methods are purely syntactic sugar - they call the same underlying methods but with cleaner, more discoverable names. All three syntaxes (strings, enums, and fluent methods) are fully supported and can be mixed freely.
