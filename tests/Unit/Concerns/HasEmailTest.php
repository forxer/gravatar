<?php

declare(strict_types=1);

use Gravatar\Image;

it('sets and gets email via method', function () {
    $image = new Image();

    expect($image->email())->toBeNull();

    $result = $image->email('test@example.com');
    expect($result)->toBe($image)
        ->and($image->email())->toBe('test@example.com')
        ->and($image->email)->toBe('test@example.com');
});

it('sets email via constructor', function () {
    $image = new Image('test@example.com');

    expect($image->email)->toBe('test@example.com');
});

it('accepts null email', function () {
    $image = new Image('test@example.com');
    $image->email(null);

    expect($image->email)->toBeNull();
});

it('normalizes email to lowercase and trimmed', function () {
    $image = new Image();
    $image->email(' Test@Example.COM ');

    expect($image->email)->toBe('test@example.com');
});

it('normalizes email set via constructor', function () {
    $image = new Image(' Test@Example.COM ');

    expect($image->email)->toBe('test@example.com');
});

it('prevents direct property assignment', function () {
    $image = new Image('test@example.com');
    $image->email = 'other@example.com';
})->throws(Error::class);
