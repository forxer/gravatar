CHANGELOG
=========

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
