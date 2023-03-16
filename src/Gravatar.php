<?php

namespace Gravatar;

use Gravatar\Concerns\HasEmail;

class Gravatar
{
    use HasEmail;

    const URL = '//www.gravatar.com/';

    /**
     * Return the Gravatar image based on the provided email address.
     *
     * @param string|null $email The email to get the gravatar for.
     * @param int|null $size The avatar size to use, must be less than 2048 and greater than 0.
     * @param string|null $defaultImage The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @param string|null $rating The maximum rating to use for avatars
     * @param string|null $extension The avatar extension to use
     * @param bool $forceDefault Force the default image to be always load.
     * @return Image
     */
    public static function image(?string $email = null, ?int $size = null, ?string $defaultImage = null, ?string $rating = null, ?string $extension = null, bool $forceDefault = false): Image
    {
        $gravatarImage = (new Image($email))
            ->setSize($size)
            ->setDefaultImage($defaultImage, $forceDefault)
            ->setMaxRating($rating)
            ->setExtension($extension);

        return $gravatarImage;
    }

    /**
     * Return multiples Gravatar images based on the provided array of emails addresses.
     *
     * @param array $emails The emails list to get the Gravatar images for.
     * @param int|null $size The avatar size to use, must be less than 2048 and greater than 0.
     * @param string|null $defaultImage The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @param string|null $rating The maximum rating to use for avatars
     * @param string|null $extension The avatar extension to use
     * @param bool $forceDefault Force the default image to be always load.
     * @return array
     */
    public static function images(array $emails, ?int $size = null, ?string $defaultImage = null, ?string $rating = null, ?string $extension = null, bool $forceDefault = false): array
    {
        $images = [];

        foreach ($emails as $email) {
            $images[$email] = (new Image($email))
                ->setSize($size)
                ->setDefaultImage($defaultImage, $forceDefault)
                ->setMaxRating($rating)
                ->setExtension($extension);
        }

        return $images;
    }

    /**
     * Return the Gravatar profile URL based on the provided email address.
     *
     * @param string|null $email The email to get the Gravatar profile for.
     * @param string|null $sFormat The profile format to use.
     * @return Profile
     */
    public static function profile(?string $email = null, ?string $format = null): Profile
    {
        return (new Profile($email))
            ->setFormat($format);
    }

    /**
     * Return multiples Gravatar profiles based on the provided array of emails addresses.
     *
     * @param array $aEmail The emails list to get the Gravatar profiles for.
     * @param string|null $sFormat The profile format to use.
     * @return array
     */
    public static function profiles(array $emails, ?string $format = null): array
    {
        $profils = [];

        foreach ($emails as $email) {
            $profils[$email] = (new Profile($email))
                ->setFormat($format);
        }

        return $profils;
    }

    /**
     * Get the email hash to use (after cleaning the string).
     *
     * @param string $email The email to get the hash for.
     * @return string The hashed form of the email.
     */
    protected static function hash(string $email): string
    {
        return md5(strtolower(trim($email)));
    }
}
