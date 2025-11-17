CHANGELOG
=========

6.0.0 (TBD)
-----------

### Breaking Changes

- **Minimum PHP version increased to 8.4**
- Removed `getEmail()`, `getSize()`, `getExtension()`, `getMaxRating()`, `getDefaultImage()`, `getFormat()`, `getInitials()`, `getName()`, and `getForceDefault()` methods - use public property access instead
- Removed short alias methods `s()`, `e()`, `r()`, `d()`, `f()` - use full method names or new fluent shorthand methods instead
- Properties are now publicly readable but can only be set through setter methods or internally

### Improvements

- **PHP 8.4 Property Hooks**: All properties now use property hooks with validation logic
- **Asymmetric Visibility**: Properties use `public private(set)` for better encapsulation
- **Validation in Property Setters**: Moved validation logic into property hooks for cleaner code
- **Typed Enums**: Added enum classes for type-safe values (`Rating`, `Extension`, `DefaultImage`, `ProfileFormat`)
  - Methods accept both enum instances and strings for backward compatibility
  - Example: `$image->setMaxRating(Rating::PG)` or `$image->setMaxRating('pg')`
- **Fluent Shorthand Methods**: Added convenient fluent methods for cleaner syntax
  - Rating: `ratingG()`, `ratingPg()`, `ratingR()`, `ratingX()`
  - Extension: `extensionJpg()`, `extensionJpeg()`, `extensionGif()`, `extensionPng()`, `extensionWebp()`
  - Default images: `defaultImageInitials()`, `defaultImageRobohash()`, etc.
  - Profile formats: `formatJson()`, `formatXml()`, `formatPhp()`, `formatVcf()`, `formatQr()`
  - Example: `$image->ratingPg()->extensionWebp()` instead of `$image->setMaxRating('pg')->setExtension('webp')`
- **Simplified Code**: Removed redundant getter methods - direct property access is now preferred
- **Documentation**: Reorganized documentation into dedicated files in the `docs/` directory for better navigation


5.3.0 (2025-11-15)
------------------

- Added `copy()` method to `Image` and `Profile` classes to duplicate instances with optional email change
- Added `withInitials()` and `withName()` convenience methods
- Renamed `ImageHasExtraParameters` trait to `ImageHasInitials` for better clarity
- Improved documentation


5.1.1 (2025-11-12)
------------------

- Changelog file forgotten
- Rector


5.1.0 (2025-11-06)
------------------

- Added "initials" and "color" default options
- Stricter typings for return values


5.0.2 (2024-05-28)
------------------

- Removed encoded `&amp;` from `http_build_query()`


5.0.1 (2024-03-18)
------------------

- Maintenance


5.0.0 (2024-05-26)
------------------

- Removed support for PHP prior to 8.2


4.0.3 (2023-03-22)
------------------

- Small maintenance and clarifications


4.0.2 (2023-03-20)
------------------

- Fixed things in doc


4.0.1 (2023-03-16)
------------------

- Remove useless doc


4.0.0 (2023-03-16)
------------------

- Removed `gravatar()` and `gravatar_profile()` helpers functions
- Added documentation to implement own helpers


3.0.1 (2023-03-16)
------------------

- Added UPGRADE.md
- Improved README.md file
- Uppercased "README" and "CHANGELOG" files


3.0.0 (2023-03-16)
------------------

- Removed support for PHP prior to 8.0
- Renamed `forxer\Gravatar\` namespace to `Gravatar\`
- Renamed `getUrl(string $email)` to `url()` ; email should be defined before
- Introduced `gravatar()` and `gravatar_profile()` helpers functions
- Split code into traits to facilitate reading and maintenance
- Used more type hinting for consistency
- Renamed most variables to facilitate reading


2.1.0 (2017-08-31)
------------------

- Added `Image::setForceDefault()` and `Image::getForceDefaultImage()`
- Added `Image::forceDefault()` helper method and its alias `Image::f()`


2.0.0 (2017-08-05)
------------------

- Now follows closely SemVer
- Removed `secure` optionnal parameter and always use 'protocol-agnostic' base URL instead
- `Gravatar::image()` now return Image instance instead of URL string
- Added `Image::__toString()` method
- `Gravatar::images()` now return array of Image instances instead of array of URL strings
- `Gravatar::profile()` now return Profile instance instead of URL string
- Added `Profile::__toString()` method
- `Gravatar::profiles()` now return array of Profile instances instead of array of URL strings
- Added `Gravatar::email()` methods (helper/getter/setter)
- Added `Image::size()` helper method and its alias `Image::s()`
- Added `Image::defaultImage()` helper method and its alias `Image::d()`
- Added `Image::rating()` helper method and its alias `Image::r()`
- Added `Image::extension()` helper method and its alias `Image::e()`
- Added `Profile::format()` helper method and its alias `Profile::f()`
- Added `Exception\InvalidDefaultImageException` class
- Added `Exception\InvalidImageExtensionException` class
- Added `Exception\InvalidImageSizeException` class
- Added `Exception\InvalidMaxRatingImageException` class
- Added `Exception\InvalidProfileFormatException` class
- Removed useless internal image params cache


1.3.2 (2017-07-27)
------------------

- Fixed readme anchor for TOC


1.3.1 (2016-02-26)
------------------

- Fixed double encode default image URL


1.3.0 (2015-06-30)
------------------

- Added force default image support
- Replaced tabs by spaces
- Improved docblocks


1.2.1 (2014-11-15)
------------------

- pdated misc informations
- Added changelog


1.2.0 (2014-08-22)
------------------

- Removed support for PHP prior to 5.4


1.1.2 (2014-02-19)
------------------

- Added more documentation
- Coding standard


1.1.1 (2014-02-19)
------------------

- Added more documentation


1.1.0 (2014-02-19)
------------------

- Global rewrite of the base code


1.0.0 (2014-02-19)
------------------

- First public release
