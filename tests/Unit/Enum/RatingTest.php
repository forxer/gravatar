<?php

declare(strict_types=1);

use Gravatar\Enum\Rating;

it('has all expected cases', function () {
    expect(Rating::cases())->toHaveCount(4);
});

it('returns all values as strings', function () {
    expect(Rating::values())->toBe(['g', 'pg', 'r', 'x']);
});

it('creates from valid string via tryFromString', function () {
    expect(Rating::tryFromString('pg'))->toBe(Rating::PG);
    expect(Rating::tryFromString('PG'))->toBe(Rating::PG);
});

it('returns null for invalid string via tryFromString', function () {
    expect(Rating::tryFromString('z'))->toBeNull();
});
