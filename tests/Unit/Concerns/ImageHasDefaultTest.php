<?php

declare(strict_types=1);

use Gravatar\Enum\DefaultImage;
use Gravatar\Exception\InvalidDefaultImageException;
use Gravatar\Image;

it('sets and gets default image via method', function () {
    $image = new Image('test@example.com');

    expect($image->defaultImage())->toBeNull();

    $result = $image->defaultImage('identicon');
    expect($result)->toBe($image)
        ->and($image->defaultImage())->toBe('identicon');
});

it('accepts all valid default image types', function (string $type) {
    $image = new Image('test@example.com');
    $image->defaultImage($type);

    expect($image->defaultImage)->toBe($type);
})->with(['initials', 'color', '404', 'mp', 'identicon', 'monsterid', 'wavatar', 'retro', 'robohash', 'blank']);

it('accepts DefaultImage enum values', function (DefaultImage $default) {
    $image = new Image('test@example.com');
    $image->defaultImage($default);

    expect($image->defaultImage)->toBe($default->value);
})->with(DefaultImage::cases());

it('accepts a valid URL as default image', function () {
    $image = new Image('test@example.com');
    $image->defaultImage('https://example.com/avatar.png');

    expect($image->defaultImage)->toBe('https://example.com/avatar.png');
});

it('rejects invalid default image', function () {
    $image = new Image('test@example.com');
    $image->defaultImage('invalid_value');
})->throws(InvalidDefaultImageException::class);

it('sets force default via defaultImage method', function () {
    $image = new Image('test@example.com');
    $image->defaultImage('identicon', forceDefault: true);

    expect($image->forceDefault)->toBeTrue();
});

it('resets default image to null', function () {
    $image = new Image('test@example.com');
    $image->defaultImage('identicon');
    $image->defaultImage(null);

    expect($image->defaultImage)->toBeNull();
});

it('provides shorthand methods for each default type', function () {
    $image = new Image('test@example.com');

    expect($image->defaultImageInitials()->defaultImage)->toBe('initials');
    expect($image->defaultImageColor()->defaultImage)->toBe('color');
    expect($image->defaultImageNotFound()->defaultImage)->toBe('404');
    expect($image->defaultImageMp()->defaultImage)->toBe('mp');
    expect($image->defaultImageIdenticon()->defaultImage)->toBe('identicon');
    expect($image->defaultImageMonsterid()->defaultImage)->toBe('monsterid');
    expect($image->defaultImageWavatar()->defaultImage)->toBe('wavatar');
    expect($image->defaultImageRetro()->defaultImage)->toBe('retro');
    expect($image->defaultImageRobohash()->defaultImage)->toBe('robohash');
    expect($image->defaultImageBlank()->defaultImage)->toBe('blank');
});
