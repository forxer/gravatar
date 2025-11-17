<?php

declare(strict_types=1);

namespace Gravatar;

use Gravatar\Concerns\HasEmail;
use Gravatar\Enum\DefaultImage;
use Gravatar\Enum\Extension;
use Gravatar\Enum\ProfileFormat;
use Gravatar\Enum\Rating;

class Gravatar
{
    use HasEmail;

    public const URL = '//www.gravatar.com/';

    /**
     * Return the Gravatar image based on the provided email address.
     *
     * @param  string|null  $email  The email to get the gravatar for.
     * @param  int|null  $size  The avatar size to use, must be less than 2048 and greater than 0.
     * @param  DefaultImage|string|null  $defaultImage  The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @param  Rating|string|null  $rating  The maximum rating to use for avatars
     * @param  Extension|string|null  $extension  The avatar extension to use
     * @param  bool  $forceDefault  Force the default image to be always load.
     */
    public static function image(?string $email = null, ?int $size = null, DefaultImage|string|null $defaultImage = null, Rating|string|null $rating = null, Extension|string|null $extension = null, bool $forceDefault = false): Image
    {
        return (new Image($email))
            ->size($size)
            ->defaultImage($defaultImage, $forceDefault)
            ->maxRating($rating)
            ->extension($extension);
    }

    /**
     * Return multiples Gravatar images based on the provided array of emails addresses.
     *
     * @param  array<string>  $emails  The emails list to get the Gravatar images for.
     * @param  int|null  $size  The avatar size to use, must be less than 2048 and greater than 0.
     * @param  DefaultImage|string|null  $defaultImage  The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @param  Rating|string|null  $rating  The maximum rating to use for avatars
     * @param  Extension|string|null  $extension  The avatar extension to use
     * @param  bool  $forceDefault  Force the default image to be always load.
     * @return array<string, Image>
     */
    public static function images(array $emails, ?int $size = null, DefaultImage|string|null $defaultImage = null, Rating|string|null $rating = null, Extension|string|null $extension = null, bool $forceDefault = false): array
    {
        $images = [];

        foreach ($emails as $email) {
            $images[$email] = (new Image($email))
                ->size($size)
                ->defaultImage($defaultImage, $forceDefault)
                ->maxRating($rating)
                ->extension($extension);
        }

        return $images;
    }

    /**
     * Return the Gravatar profile URL based on the provided email address.
     *
     * @param  string|null  $email  The email to get the Gravatar profile for.
     * @param  ProfileFormat|string|null  $format  The profile format to use.
     */
    public static function profile(?string $email = null, ProfileFormat|string|null $format = null): Profile
    {
        return (new Profile($email))
            ->format($format);
    }

    /**
     * Return multiples Gravatar profiles based on the provided array of emails addresses.
     *
     * @param  array<string>  $emails  The emails list to get the Gravatar profiles for.
     * @param  ProfileFormat|string|null  $format  The profile format to use.
     * @return array<string, Profile>
     */
    public static function profiles(array $emails, ProfileFormat|string|null $format = null): array
    {
        $profiles = [];

        foreach ($emails as $email) {
            $profiles[$email] = (new Profile($email))
                ->format($format);
        }

        return $profiles;
    }

    /**
     * Get the email hash to use (after cleaning the string).
     *
     * @param  string  $email  The email to get the hash for.
     * @return string The hashed form of the email.
     */
    protected static function hash(string $email): string
    {
        return md5(strtolower(trim($email)));
    }
}
