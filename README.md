# Gravatar

Gravatar is a small library intended to provide easy integration of... Gravatar :)

It will help you generate the URL Gravatar for avatar and profiles.

## License

This library is licensed under the MIT license; you can find a full copy of the license itself in the file /LICENSE

## Installation

### Requirements

* PHP 5.3.0 or newer

### With Composer

The easiest way to install Gravatar is via [composer](http://getcomposer.org/).

```json
{
	"require": {
		"forxer/Gravatar": "*"
	}
}
```

## Usage

### General example

```php
<?php
require 'vendor/autoload.php';

use forxer\Gravatar\Gravatar;

// Get a single avatar
echo Gravatar::avatar('email@example.com'); //http://www.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e

// Get a single profile
echo Gravatar::profile('email@example.com'); //http://www.gravatar.com/5658ffccee7f0ebfda2b226238b1eb6e

```