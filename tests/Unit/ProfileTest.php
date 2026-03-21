<?php

declare(strict_types=1);

use Gravatar\Exception\MissingEmailException;
use Gravatar\GravatarInterface;
use Gravatar\Profile;

it('implements GravatarInterface', function () {
    expect(new Profile('test@example.com'))->toBeInstanceOf(GravatarInterface::class);
});

it('builds a basic profile URL', function () {
    $profile = new Profile('test@example.com');
    $url = $profile->url();

    expect($url)->toStartWith('https://www.gravatar.com/')
        ->and($url)->toContain(md5('test@example.com'));
});

it('is stringable', function () {
    $profile = new Profile('test@example.com');

    expect((string) $profile)->toBe($profile->url());
});

it('throws MissingEmailException when no email is set', function () {
    $profile = new Profile();
    $profile->url();
})->throws(MissingEmailException::class);

it('throws MissingEmailException for empty email', function () {
    $profile = new Profile('');
    $profile->url();
})->throws(MissingEmailException::class);

it('builds URL with format', function () {
    $profile = new Profile('test@example.com');
    $profile->format('json');

    expect($profile->url())->toEndWith('.json');
});

it('builds URL without format by default', function () {
    $profile = new Profile('test@example.com');
    $hash = md5('test@example.com');

    expect($profile->url())->toEndWith($hash);
});

it('creates a copy with same settings', function () {
    $profile = new Profile('test@example.com');
    $profile->formatJson();

    $copy = $profile->copy('other@example.com');

    expect($copy)->not->toBe($profile)
        ->and($copy->format)->toBe('json')
        ->and($copy->url())->toContain(md5('other@example.com'));
});

it('creates a copy without changing email', function () {
    $profile = new Profile('test@example.com');
    $copy = $profile->copy();

    expect($copy)->not->toBe($profile)
        ->and($copy->url())->toBe($profile->url());
});

it('getData uses json format and returns null on failure', function () {
    $profile = new Profile();

    set_error_handler(fn () => true);

    try {
        $result = $profile->getData('test@example.com');
    } finally {
        restore_error_handler();
    }

    expect($result)->toBeNull()
        ->and($profile->format)->toBe('json');
});

it('getData returns profile data from Gravatar API', function () {
    $email = $_ENV['GRAVATAR_TEST_EMAIL'] ?? '';

    if ($email === '') {
        $this->markTestSkipped('GRAVATAR_TEST_EMAIL not set');
    }

    $profile = new Profile();
    $data = $profile->getData($email);

    expect($data)->toBeArray()
        ->and($data)->toHaveKey('entry');
});

it('supports fluent format shorthand methods', function () {
    $profile = new Profile('test@example.com');

    expect($profile->formatJson()->url())->toEndWith('.json');
    expect($profile->formatXml()->url())->toEndWith('.xml');
    expect($profile->formatPhp()->url())->toEndWith('.php');
    expect($profile->formatVcf()->url())->toEndWith('.vcf');
    expect($profile->formatQr()->url())->toEndWith('.qr');
});
