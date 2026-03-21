<?php

declare(strict_types=1);

use Gravatar\Enum\Extension;

it('has all expected cases', function () {
    expect(Extension::cases())->toHaveCount(5);
});

it('returns all values as strings', function () {
    expect(Extension::values())->toBe(['jpg', 'jpeg', 'gif', 'png', 'webp']);
});

it('creates from valid string via tryFromString', function () {
    expect(Extension::tryFromString('jpg'))->toBe(Extension::JPG);
    expect(Extension::tryFromString('JPG'))->toBe(Extension::JPG);
});

it('returns null for invalid string via tryFromString', function () {
    expect(Extension::tryFromString('bmp'))->toBeNull();
});
