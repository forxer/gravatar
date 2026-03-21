<?php

declare(strict_types=1);

use Gravatar\Gravatar;
use Gravatar\Image;
use Gravatar\Profile;

it('creates an Image instance via image()', function () {
    $image = Gravatar::image('test@example.com');

    expect($image)->toBeInstanceOf(Image::class);
    expect((string) $image)->toContain('avatar/');
});

it('creates an Image with all parameters', function () {
    $image = Gravatar::image(
        email: 'test@example.com',
        size: 200,
        defaultImage: 'identicon',
        rating: 'pg',
        extension: 'jpg',
        forceDefault: true,
    );

    $url = $image->url();
    expect($url)->toContain('s=200')
        ->and($url)->toContain('d=identicon')
        ->and($url)->toContain('r=pg')
        ->and($url)->toContain('.jpg')
        ->and($url)->toContain('f=y');
});

it('creates multiple Image instances via images()', function () {
    $emails = ['a@example.com', 'b@example.com'];
    $images = Gravatar::images($emails, size: 100);

    expect($images)->toHaveCount(2)
        ->and($images)->toHaveKeys($emails);

    foreach ($images as $email => $image) {
        expect($image)->toBeInstanceOf(Image::class)
            ->and($image->size)->toBe(100);
    }
});

it('creates a Profile instance via profile()', function () {
    $profile = Gravatar::profile('test@example.com');

    expect($profile)->toBeInstanceOf(Profile::class);
    expect((string) $profile)->toContain('api.gravatar.com/v3/profiles/');
});

it('creates multiple Profile instances via profiles()', function () {
    $emails = ['a@example.com', 'b@example.com'];
    $profiles = Gravatar::profiles($emails);

    expect($profiles)->toHaveCount(2)
        ->and($profiles)->toHaveKeys($emails);

    foreach ($profiles as $profile) {
        expect($profile)->toBeInstanceOf(Profile::class)
            ->and($profile->url())->toContain('api.gravatar.com/v3/profiles/');
    }
});
