<?php

declare(strict_types=1);

use Gravatar\Enum\Rating;
use Gravatar\Exception\InvalidMaxRatingImageException;
use Gravatar\Image;

it('sets and gets max rating via method', function () {
    $image = new Image('test@example.com');

    expect($image->maxRating())->toBeNull();

    $result = $image->maxRating('pg');
    expect($result)->toBe($image)
        ->and($image->maxRating())->toBe('pg');
});

it('accepts all valid ratings', function (string $rating) {
    $image = new Image('test@example.com');
    $image->maxRating($rating);

    expect($image->maxRating)->toBe($rating);
})->with(['g', 'pg', 'r', 'x']);

it('accepts Rating enum values', function (Rating $rating) {
    $image = new Image('test@example.com');
    $image->maxRating($rating);

    expect($image->maxRating)->toBe($rating->value);
})->with(Rating::cases());

it('rejects invalid rating', function () {
    $image = new Image('test@example.com');
    $image->maxRating('z');
})->throws(InvalidMaxRatingImageException::class);

it('normalizes rating to lowercase', function () {
    $image = new Image('test@example.com');
    $image->maxRating('PG');

    expect($image->maxRating)->toBe('pg');
});

it('resets rating to null', function () {
    $image = new Image('test@example.com');
    $image->maxRating('pg');
    $image->maxRating(null);

    expect($image->maxRating)->toBeNull();
});

it('provides shorthand methods', function () {
    $image = new Image('test@example.com');

    expect($image->ratingG()->maxRating)->toBe('g');
    expect($image->ratingPg()->maxRating)->toBe('pg');
    expect($image->ratingR()->maxRating)->toBe('r');
    expect($image->ratingX()->maxRating)->toBe('x');
});
