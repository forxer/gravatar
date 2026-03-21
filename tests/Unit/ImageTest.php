<?php

declare(strict_types=1);

use Gravatar\Exception\MissingEmailException;
use Gravatar\Image;

it('builds a basic avatar URL', function () {
    $image = new Image('test@example.com');
    $url = $image->url();

    expect($url)->toStartWith('https://www.gravatar.com/avatar/')
        ->and($url)->toContain(md5('test@example.com'));
});

it('is stringable', function () {
    $image = new Image('test@example.com');

    expect((string) $image)->toBe($image->url());
});

it('throws MissingEmailException when no email is set', function () {
    $image = new Image();
    $image->url();
})->throws(MissingEmailException::class);

it('throws MissingEmailException for empty email', function () {
    $image = new Image('');
    $image->url();
})->throws(MissingEmailException::class);

it('builds URL with size parameter', function () {
    $image = new Image('test@example.com');
    $image->size(120);

    expect($image->url())->toContain('s=120');
});

it('builds URL with extension', function () {
    $image = new Image('test@example.com');
    $image->extension('jpg');

    expect($image->url())->toContain('.jpg');
});

it('builds URL with default image', function () {
    $image = new Image('test@example.com');
    $image->defaultImage('identicon');

    expect($image->url())->toContain('d=identicon');
});

it('builds URL with max rating', function () {
    $image = new Image('test@example.com');
    $image->maxRating('pg');

    expect($image->url())->toContain('r=pg');
});

it('builds URL with force default', function () {
    $image = new Image('test@example.com');
    $image->enableForceDefault();

    expect($image->url())->toContain('f=y');
});

it('builds URL with initials default', function () {
    $image = new Image('test@example.com');
    $image->withInitials('JD');

    $url = $image->url();
    expect($url)->toContain('d=initials')
        ->and($url)->toContain('initials=JD');
});

it('builds URL with initials name', function () {
    $image = new Image('test@example.com');
    $image->withInitialsName('John Doe');

    $url = $image->url();
    expect($url)->toContain('d=initials')
        ->and($url)->toContain('name=John');
});

it('builds URL without query string when no params set', function () {
    $image = new Image('test@example.com');

    expect($image->url())->not->toContain('?');
});

it('creates a copy with same settings', function () {
    $image = new Image('test@example.com');
    $image->size(200)->extensionWebp();

    $copy = $image->copy('other@example.com');

    expect($copy)->not->toBe($image)
        ->and($copy->size)->toBe(200)
        ->and($copy->extension)->toBe('webp')
        ->and($copy->url())->toContain(md5('other@example.com'));
});

it('creates a copy without changing email', function () {
    $image = new Image('test@example.com');
    $copy = $image->copy();

    expect($copy)->not->toBe($image)
        ->and($copy->url())->toBe($image->url());
});

it('supports fluent method chaining', function () {
    $image = new Image('test@example.com');
    $result = $image->size(100)->extensionJpg()->ratingPg()->defaultImageIdenticon();

    expect($result)->toBeInstanceOf(Image::class)
        ->and($result)->toBe($image);
});
