# CHANGELOG

This changelog does not reference all the changes, only the most relevant to be included in this document.

To get the diff for a specific change, go to https://github.com/forxer/gravatar/commit/XXX where XXX is the change hash
To get the diff between two versions, go to https://github.com/forxer/gravatar/compare/1.1...1.2

*BBC* : break backwards changes

- **2.0.0**
    - now follows closely SemVer
    - *BBC* remove 'secure' optionnal parameter and always use 'protocol-agnostic' base URL instead
    - add Gravatar::email() methods (helper/getter/setter)
    - implement __toString() methods on Image and Profile classes
    - add Image::size() helper method and its alias Image::s()
    - add Image::defaultImage() helper method and its alias Image::d()
    - add Image::rating() helper method and its alias Image::r()
    - add Image::extension() helper method and its alias Image::e()
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