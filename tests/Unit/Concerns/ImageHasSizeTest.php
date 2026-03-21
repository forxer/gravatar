<?php

declare(strict_types=1);

use Gravatar\Exception\InvalidImageSizeException;
use Gravatar\Image;

it('sets and gets size via method', function () {
    $image = new Image('test@example.com');

    expect($image->size())->toBeNull();

    $result = $image->size(120);
    expect($result)->toBe($image)
        ->and($image->size())->toBe(120)
        ->and($image->size)->toBe(120);
});

it('accepts valid sizes', function (int $size) {
    $image = new Image('test@example.com');
    $image->size($size);

    expect($image->size)->toBe($size);
})->with([1, 100, 512, 1024, 2048]);

it('rejects size of 0', function () {
    $image = new Image('test@example.com');
    $image->size(0);
})->throws(InvalidImageSizeException::class);

it('rejects negative size', function () {
    $image = new Image('test@example.com');
    $image->size(-1);
})->throws(InvalidImageSizeException::class);

it('rejects size greater than 2048', function () {
    $image = new Image('test@example.com');
    $image->size(2049);
})->throws(InvalidImageSizeException::class);

it('accepts null size to reset', function () {
    $image = new Image('test@example.com');
    $image->size(100);
    $image->size(null);

    expect($image->size)->toBeNull();
});
