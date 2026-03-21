<?php

declare(strict_types=1);

use Gravatar\Image;

it('sets and gets initials via method', function () {
    $image = new Image('test@example.com');

    expect($image->initials())->toBeNull();

    $result = $image->initials('JD');
    expect($result)->toBe($image)
        ->and($image->initials())->toBe('JD')
        ->and($image->initials)->toBe('JD');
});

it('sets and gets initials name via method', function () {
    $image = new Image('test@example.com');

    expect($image->initialsName())->toBeNull();

    $result = $image->initialsName('John Doe');
    expect($result)->toBe($image)
        ->and($image->initialsName())->toBe('John Doe')
        ->and($image->initialsName)->toBe('John Doe');
});

it('sets default image to initials and initials value via withInitials', function () {
    $image = new Image('test@example.com');
    $result = $image->withInitials('JD');

    expect($result)->toBe($image)
        ->and($image->defaultImage)->toBe('initials')
        ->and($image->initials)->toBe('JD');
});

it('sets default image to initials and name via withInitialsName', function () {
    $image = new Image('test@example.com');
    $result = $image->withInitialsName('John Doe');

    expect($result)->toBe($image)
        ->and($image->defaultImage)->toBe('initials')
        ->and($image->initialsName)->toBe('John Doe');
});
