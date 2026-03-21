<?php

declare(strict_types=1);

use Gravatar\Enum\Extension;
use Gravatar\Exception\InvalidImageExtensionException;
use Gravatar\Image;

it('sets and gets extension via method', function () {
    $image = new Image('test@example.com');

    expect($image->extension())->toBeNull();

    $result = $image->extension('jpg');
    expect($result)->toBe($image)
        ->and($image->extension())->toBe('jpg');
});

it('accepts all valid extensions', function (string $ext) {
    $image = new Image('test@example.com');
    $image->extension($ext);

    expect($image->extension)->toBe($ext);
})->with(['jpg', 'jpeg', 'gif', 'png', 'webp']);

it('accepts Extension enum values', function (Extension $ext) {
    $image = new Image('test@example.com');
    $image->extension($ext);

    expect($image->extension)->toBe($ext->value);
})->with(Extension::cases());

it('rejects invalid extension', function () {
    $image = new Image('test@example.com');
    $image->extension('bmp');
})->throws(InvalidImageExtensionException::class);

it('normalizes extension to lowercase', function () {
    $image = new Image('test@example.com');
    $image->extension('JPG');

    expect($image->extension)->toBe('jpg');
});

it('resets extension to null', function () {
    $image = new Image('test@example.com');
    $image->extension('jpg');
    $image->extension(null);

    expect($image->extension)->toBeNull();
});

it('provides shorthand methods', function () {
    $image = new Image('test@example.com');

    expect($image->extensionJpg()->extension)->toBe('jpg');
    expect($image->extensionJpeg()->extension)->toBe('jpeg');
    expect($image->extensionGif()->extension)->toBe('gif');
    expect($image->extensionPng()->extension)->toBe('png');
    expect($image->extensionWebp()->extension)->toBe('webp');
});
