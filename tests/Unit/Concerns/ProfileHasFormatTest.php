<?php

declare(strict_types=1);

use Gravatar\Enum\ProfileFormat;
use Gravatar\Exception\InvalidProfileFormatException;
use Gravatar\Profile;

it('sets and gets format via method', function () {
    $profile = new Profile('test@example.com');

    expect($profile->format())->toBeNull();

    $result = $profile->format('json');
    expect($result)->toBe($profile)
        ->and($profile->format())->toBe('json');
});

it('accepts all valid formats', function (string $format) {
    $profile = new Profile('test@example.com');
    $profile->format($format);

    expect($profile->format)->toBe($format);
})->with(['json', 'xml', 'php', 'vcf', 'qr']);

it('accepts ProfileFormat enum values', function (ProfileFormat $format) {
    $profile = new Profile('test@example.com');
    $profile->format($format);

    expect($profile->format)->toBe($format->value);
})->with(ProfileFormat::cases());

it('rejects invalid format', function () {
    $profile = new Profile('test@example.com');
    $profile->format('csv');
})->throws(InvalidProfileFormatException::class);

it('resets format to null', function () {
    $profile = new Profile('test@example.com');
    $profile->format('json');
    $profile->format(null);

    expect($profile->format)->toBeNull();
});

it('provides shorthand methods', function () {
    $profile = new Profile('test@example.com');

    expect($profile->formatJson()->format)->toBe('json');
    expect($profile->formatXml()->format)->toBe('xml');
    expect($profile->formatPhp()->format)->toBe('php');
    expect($profile->formatVcf()->format)->toBe('vcf');
    expect($profile->formatQr()->format)->toBe('qr');
});
