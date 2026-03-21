<?php

declare(strict_types=1);

use Gravatar\Enum\ProfileFormat;

it('has all expected cases', function () {
    expect(ProfileFormat::cases())->toHaveCount(5);
});

it('returns all values as strings', function () {
    expect(ProfileFormat::values())->toBe(['json', 'xml', 'php', 'vcf', 'qr']);
});

it('creates from valid string via tryFromString', function () {
    expect(ProfileFormat::tryFromString('json'))->toBe(ProfileFormat::JSON);
});

it('returns null for invalid string via tryFromString', function () {
    expect(ProfileFormat::tryFromString('csv'))->toBeNull();
});
