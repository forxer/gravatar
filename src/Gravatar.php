<?php

declare(strict_types=1);

namespace Gravatar;

use Gravatar\Concerns\HasEmail;
use Gravatar\Enum\DefaultImage;
use Gravatar\Enum\Extension;
use Gravatar\Enum\Rating;

class Gravatar
{
    use HasEmail;

    public const string URL = 'https://gravatar.com/';

    /**
     * Construct Gravatar instance
     *
     * @param  string|null  $email  The email address to use.
     */
    public function __construct(?string $email = null)
    {
        if ($email !== null) {
            $this->email($email);
        }
    }

    /**
     * Create a copy of the current instance with all its settings.
     * Optionally change the email address in the copy.
     *
     * @param  string|null  $email  Optional new email address for the copy.
     * @return static A new instance with the same settings.
     */
    public function copy(?string $email = null): static
    {
        $copy = clone $this;

        if ($email !== null) {
            $copy->email($email);
        }

        return $copy;
    }

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
        $image = new Image($email);
        $image->size = $size;
        $image->defaultImage = $defaultImage;
        $image->maxRating = $rating;
        $image->extension = $extension;

        if ($forceDefault) {
            $image->enableForceDefault();
        }

        return $image;
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
            $images[$email] = static::image($email, $size, $defaultImage, $rating, $extension, $forceDefault);
        }

        return $images;
    }

    /**
     * Return the Gravatar profile URL based on the provided email address.
     *
     * @param  string|null  $email  The email to get the Gravatar profile for.
     */
    public static function profile(?string $email = null): Profile
    {
        return new Profile($email);
    }

    /**
     * Return multiples Gravatar profiles based on the provided array of emails addresses.
     *
     * @param  array<string>  $emails  The emails list to get the Gravatar profiles for.
     * @return array<string, Profile>
     */
    public static function profiles(array $emails): array
    {
        $profiles = [];

        foreach ($emails as $email) {
            $profiles[$email] = static::profile($email);
        }

        return $profiles;
    }

    /**
     * Get the email hash to use (SHA-256).
     *
     * @param  string  $email  The email to get the hash for.
     * @return string The hashed form of the email.
     */
    protected static function hash(string $email): string
    {
        return hash('sha256', $email);
    }
}
