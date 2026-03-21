<?php

declare(strict_types=1);

use Gravatar\Enum\DefaultImage;

it('has all expected cases', function () {
    expect(DefaultImage::cases())->toHaveCount(10);
});

it('returns all values as strings', function () {
    $values = DefaultImage::values();

    expect($values)->toBe(['initials', 'color', '404', 'mp', 'identicon', 'monsterid', 'wavatar', 'retro', 'robohash', 'blank']);
});

it('creates from valid string via tryFromString', function () {
    expect(DefaultImage::tryFromString('identicon'))->toBe(DefaultImage::IDENTICON);
    expect(DefaultImage::tryFromString('IDENTICON'))->toBe(DefaultImage::IDENTICON);
});

it('returns null for invalid string via tryFromString', function () {
    expect(DefaultImage::tryFromString('invalid'))->toBeNull();
});
