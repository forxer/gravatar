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
