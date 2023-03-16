UPGRADE
=======

From 2.x to 3.x
---------------

This package now requires at least **PHP 8**, your project must correspond to this prerequisite.

Namespaces have been renamed from `forxer\Gravatar\` to `Gravatar\` :

- Find: `use forxer\Gravatar`
- Replace: `use Gravatar`

The `getUrl(string $email)` method has been renamed to `url()` and it no longer accepts arguments. You must define the email address to use before invoking it using the various methods available for this (see the README.md file).
