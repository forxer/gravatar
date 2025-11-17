[![Latest Stable Version](http://poser.pugx.org/forxer/gravatar/v)](https://packagist.org/packages/forxer/gravatar)
[![Total Downloads](http://poser.pugx.org/forxer/gravatar/downloads)](https://packagist.org/packages/forxer/gravatar)
[![License](http://poser.pugx.org/forxer/gravatar/license)](https://packagist.org/packages/forxer/gravatar)

Gravatar
========

Gravatar is a small library intended to provide easy integration of... [Gravatar](https://gravatar.com) :) It will help you generate the URL for Gravatar images and profiles in many ways.

To use it in a **Laravel project**, please look at: **[laravel-gravatar](https://github.com/forxer/laravel-gravatar)**

```php
use Gravatar\Gravatar;
use Gravatar\Enum\DefaultImage;
use Gravatar\Enum\Extension;

$avatar = Gravatar::image('email@example.com')
    ->size(120)
    ->defaultImage(DefaultImage::ROBOHASH)
    ->extension(Extension::JPG);
//...
echo $avatar;
```

Documentation
-------------

* **[Installation](docs/installation.md)** - Requirements and installation instructions
* **[Usage](docs/usage.md)** - How to use the library (helpers, base class, dedicated classes)
* **[Type-safe enums](docs/enums.md)** - Using enums and fluent shorthand methods
* **[Optional parameters](docs/parameters.md)** - All available parameters and configurations
* **[Upgrade guide](UPGRADE.md)** - Migration guides between major versions
* **[Changelog](CHANGELOG.md)** - Version history and changes

Quick Start
-----------

### Installation

```bash
composer require forxer/gravatar
```

**Requires PHP 8.4 or newer.** For older PHP versions, see [Installation](docs/installation.md).

### Basic Usage

```php
use Gravatar\Gravatar;

// Get a Gravatar image URL
echo Gravatar::image('email@example.com');
// output: //www.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e

// With parameters
$avatar = Gravatar::image('email@example.com')
    ->size(120)
    ->ratingPg()
    ->extensionWebp()
    ->defaultImageRobohash();
echo $avatar;

// Get a Gravatar profile URL
echo Gravatar::profile('email@example.com')->formatJson();
```

### Key Features

**Type-safe enums** for better IDE support:

```php
use Gravatar\Enum\Rating;
use Gravatar\Enum\Extension;
use Gravatar\Enum\DefaultImage;

$image->setMaxRating(Rating::PG)
    ->setExtension(Extension::WEBP)
    ->setDefaultImage(DefaultImage::ROBOHASH);
```

**Fluent shorthand methods** for cleaner syntax:

```php
$image->ratingPg()
    ->extensionWebp()
    ->defaultImageRobohash();
```

**Multiple usage patterns** - helpers, static methods, or direct instantiation:

```php
// Using helpers (define your own)
$avatar = gravatar('email@example.com')->size(120);

// Using static methods
$avatar = Gravatar::image('email@example.com')->size(120);

// Direct instantiation
$avatar = new Image('email@example.com');
$avatar->size(120);
```

For more details, see the [full documentation](docs/).

License
-------

This library is licensed under the MIT license; you can find a full copy of the license itself in the file /LICENSE
