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

// Using enums (recommended for type safety)
$image->setMaxRating(Rating::PG);
$image->setExtension(Extension::JPG);
$image->setDefaultImage(DefaultImage::ROBOHASH);

// Using strings (still fully supported)
$image->setMaxRating('pg');
$image->setExtension('jpg');
$image->setDefaultImage('robohash');

// You can mix both approaches
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
$image->ratingG();    // equivalent to ->setMaxRating(Rating::G)
$image->ratingPg();   // equivalent to ->setMaxRating(Rating::PG)
$image->ratingR();    // equivalent to ->setMaxRating(Rating::R)
$image->ratingX();    // equivalent to ->setMaxRating(Rating::X)
```

**Available for extensions:**

```php
$image->extensionJpg();   // equivalent to ->setExtension(Extension::JPG)
$image->extensionJpeg();  // equivalent to ->setExtension(Extension::JPEG)
$image->extensionGif();   // equivalent to ->setExtension(Extension::GIF)
$image->extensionPng();   // equivalent to ->setExtension(Extension::PNG)
$image->extensionWebp();  // equivalent to ->setExtension(Extension::WEBP)
```

**Available for default images:**

```php
$image->defaultImageInitials();    // equivalent to ->setDefaultImage(DefaultImage::INITIALS)
$image->defaultImageColor();       // equivalent to ->setDefaultImage(DefaultImage::COLOR)
$image->defaultImageNotFound();    // equivalent to ->setDefaultImage(DefaultImage::NOT_FOUND)
$image->defaultImageMp();          // equivalent to ->setDefaultImage(DefaultImage::MYSTERY_PERSON)
$image->defaultImageIdenticon();   // equivalent to ->setDefaultImage(DefaultImage::IDENTICON)
$image->defaultImageMonsterid();   // equivalent to ->setDefaultImage(DefaultImage::MONSTERID)
$image->defaultImageWavatar();     // equivalent to ->setDefaultImage(DefaultImage::WAVATAR)
$image->defaultImageRetro();       // equivalent to ->setDefaultImage(DefaultImage::RETRO)
$image->defaultImageRobohash();    // equivalent to ->setDefaultImage(DefaultImage::ROBOHASH)
$image->defaultImageBlank();       // equivalent to ->setDefaultImage(DefaultImage::BLANK)
```

**Available for profile formats:**

```php
$profile->formatJson();  // equivalent to ->setFormat(ProfileFormat::JSON)
$profile->formatXml();   // equivalent to ->setFormat(ProfileFormat::XML)
$profile->formatPhp();   // equivalent to ->setFormat(ProfileFormat::PHP)
$profile->formatVcf();   // equivalent to ->setFormat(ProfileFormat::VCF)
$profile->formatQr();    // equivalent to ->setFormat(ProfileFormat::QR)
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

// Compare with the equivalent traditional syntax:
$image = (new Image('email@example.com'))
    ->size(120)
    ->setMaxRating(Rating::PG)
    ->setExtension(Extension::WEBP)
    ->setDefaultImage(DefaultImage::ROBOHASH);
```

These fluent methods are purely syntactic sugar - they call the same underlying methods but with cleaner, more discoverable names. All three syntaxes (strings, enums, and fluent methods) are fully supported and can be mixed freely.
