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
}
