<?php

declare(strict_types=1);

use Gravatar\Image;

it('defaults to false', function () {
    $image = new Image('test@example.com');

    expect($image->forceDefault)->toBeFalse()
        ->and($image->forcingDefault())->toBeFalse();
});

it('enables force default', function () {
    $image = new Image('test@example.com');
    $result = $image->enableForceDefault();

    expect($result)->toBe($image)
        ->and($image->forceDefault)->toBeTrue()
        ->and($image->forcingDefault())->toBeTrue();
});

it('disables force default', function () {
    $image = new Image('test@example.com');
    $image->enableForceDefault();
    $image->disableForceDefault();

    expect($image->forceDefault)->toBeFalse();
});

it('sets force default via method', function () {
    $image = new Image('test@example.com');

    $image->forceDefault(true);
    expect($image->forceDefault)->toBeTrue();

    $image->forceDefault(false);
    expect($image->forceDefault)->toBeFalse();
});

it('gets force default value when called without arguments', function () {
    $image = new Image('test@example.com');

    expect($image->forceDefault())->toBeFalse();

    $image->enableForceDefault();
    expect($image->forceDefault())->toBeTrue();
});
