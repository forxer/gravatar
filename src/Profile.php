<?php

declare(strict_types=1);

namespace Gravatar;

use Gravatar\Exception\MissingEmailException;

class Profile extends Gravatar implements GravatarInterface
{
    /**
     * The Gravatar REST API v3 base URL.
     */
    public const string API_URL = 'https://api.gravatar.com/v3/profiles/';

    /**
     * Build the profile API URL based on the provided email address.
     */
    public function url(): string
    {
        if ($this->email === null || $this->email === '') {
            throw new MissingEmailException('You should set an email address before trying to get a Gravatar profile URL');
        }

        return static::API_URL.$this->hash($this->email);
    }

    /**
     * Return the profile URL when this object is printed.
     *
     * @return string The URL to the gravatar.
     */
    public function __toString(): string
    {
        return $this->url();
    }

    /**
     * Return profile data based on the provided email address.
     *
     * @param  string  $email  The email to get the gravatar profile for
     * @return array<mixed, mixed>|null
     */
    public function getData(string $email): ?array
    {
        $this->email($email);

        $context = stream_context_create([
            'http' => [
                'header' => 'User-Agent: forxer/gravatar PHP',
            ],
        ]);

        $profile = @file_get_contents($this->url(), false, $context);

        if ($profile === false) {
            return null;
        }

        $data = json_decode($profile, true);

        if (! \is_array($data)) {
            return null;
        }

        return $data;
    }

    /**
     * Get the email hash to use (SHA-256 for Gravatar API v3).
     *
     * @param  string  $email  The email to get the hash for.
     * @return string The hashed form of the email.
     */
    protected static function hash(string $email): string
    {
        return hash('sha256', $email);
    }
}
