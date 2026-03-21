<?php

declare(strict_types=1);

use Gravatar\Exception\GravatarExceptionInterface;
use Gravatar\Exception\InvalidDefaultImageException;
use Gravatar\Exception\InvalidImageExtensionException;
use Gravatar\Exception\InvalidImageSizeException;
use Gravatar\Exception\InvalidMaxRatingImageException;
use Gravatar\Exception\MissingEmailException;

it('MissingEmailException extends LogicException', function () {
    expect(new MissingEmailException())->toBeInstanceOf(LogicException::class);
});

it('InvalidDefaultImageException extends DomainException', function () {
    expect(new InvalidDefaultImageException())->toBeInstanceOf(DomainException::class);
});

it('InvalidImageExtensionException extends DomainException', function () {
    expect(new InvalidImageExtensionException())->toBeInstanceOf(DomainException::class);
});

it('InvalidImageSizeException extends DomainException', function () {
    expect(new InvalidImageSizeException())->toBeInstanceOf(DomainException::class);
});

it('InvalidMaxRatingImageException extends DomainException', function () {
    expect(new InvalidMaxRatingImageException())->toBeInstanceOf(DomainException::class);
});

it('all exceptions implement GravatarExceptionInterface', function (string $class) {
    expect(new $class())->toBeInstanceOf(GravatarExceptionInterface::class);
})->with([
    MissingEmailException::class,
    InvalidDefaultImageException::class,
    InvalidImageExtensionException::class,
    InvalidImageSizeException::class,
    InvalidMaxRatingImageException::class,
]);
