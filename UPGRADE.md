UPGRADE
=======

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
