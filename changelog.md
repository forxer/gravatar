# CHANGELOG

This changelog does not reference all the changes, only the most relevant to be included in this document.

To get the diff for a specific change, go to https://github.com/forxer/gravatar/commit/XXX where XXX is the change hash
To get the diff between two versions, go to https://github.com/forxer/gravatar/compare/1.3...2.0

*BBC* : break backwards changes

- 2.1.0
    - add Image::setForceDefault() and Image::getForceDefaultImage()
    - add Image::forceDefault() helper method and its alias Image::f()

- **2.0.0**
    - now follows closely SemVer
    - *BBC* : remove 'secure' optionnal parameter and always use 'protocol-agnostic' base URL instead
    - *BBC* : Gravatar::image now return Image instance instead of URL string
    - *BBC* : Gravatar::images now return array of Image instances instead of array of URL strings
    - *BBC* : Gravatar::profile now return Profile instance instead of URL string
    - *BBC* : Gravatar::profiles now return array of Profile instances instead of array of URL strings
    - add Image::__toString() method
    - add Profile::__toString() method
    - add Gravatar::email() methods (helper/getter/setter)
    - add Image::size() helper method and its alias Image::s()
    - add Image::defaultImage() helper method and its alias Image::d()
    - add Image::rating() helper method and its alias Image::r()
    - add Image::extension() helper method and its alias Image::e()
    - add Profile::format() helper method and its alias Profile::f()
    - add Exception\InvalidDefaultImageException class
    - add Exception\InvalidImageExtensionException class
    - add Exception\InvalidImageSizeException class
    - add Exception\InvalidMaxRatingImageException class
    - add Exception\InvalidProfileFormatException class
    - remove useless internal image params cache
- 1.3.2
    - fix readme anchor for TOC
- 1.3.1
    - do not double encode default image URL
- **1.3.0**
    - add force default image support
    - replace tabs by spaces
    - improved docblocks
- 1.2.1
    - misc informations update
    - add changelog
- **1.2.0**
    - PHP 5.4
- 1.1.2
    - documentation
    - coding standard
- 1.1.1
    - documentation
- **1.1**
    - global rewrite code base
- **1.0**
    - first public release
