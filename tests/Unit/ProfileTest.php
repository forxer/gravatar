<?php

declare(strict_types=1);

use Gravatar\Exception\MissingEmailException;
use Gravatar\GravatarInterface;
use Gravatar\Profile;

it('implements GravatarInterface', function () {
    expect(new Profile('test@example.com'))->toBeInstanceOf(GravatarInterface::class);
});

it('builds a profile API URL with SHA-256 hash', function () {
    $profile = new Profile('test@example.com');
    $url = $profile->url();

    expect($url)->toStartWith('https://api.gravatar.com/v3/profiles/')
        ->and($url)->toContain(hash('sha256', 'test@example.com'));
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

it('creates a copy with same settings', function () {
    $profile = new Profile('test@example.com');

    $copy = $profile->copy('other@example.com');

    expect($copy)->not->toBe($profile)
        ->and($copy->url())->toContain(hash('sha256', 'other@example.com'));
});

it('creates a copy without changing email', function () {
    $profile = new Profile('test@example.com');
    $copy = $profile->copy();

    expect($copy)->not->toBe($profile)
        ->and($copy->url())->toBe($profile->url());
});

it('getData returns null on failure', function () {
    $profile = new Profile();

    $result = $profile->getData('nonexistent-email-that-does-not-exist@example-404.invalid');

    expect($result)->toBeNull();
});

it('getData returns profile data from Gravatar API', function () {
    $email = $_ENV['GRAVATAR_TEST_EMAIL'] ?? '';

    if ($email === '') {
        $this->markTestSkipped('GRAVATAR_TEST_EMAIL not set');
    }

    $profile = new Profile();
    $data = $profile->getData($email);

    expect($data)->toBeArray()
        ->and($data)->toHaveKey('hash')
        ->and($data)->toHaveKey('display_name');
});

it('uses SHA-256 hash', function () {
    $profile = new Profile('test@example.com');
    $url = $profile->url();

    expect($url)->toContain(hash('sha256', 'test@example.com'));
});
