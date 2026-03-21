<?php

declare(strict_types=1);

namespace Gravatar;

use Gravatar\Concerns\ProfileHasFormat;
use Gravatar\Exception\MissingEmailException;

class Profile extends Gravatar implements GravatarInterface
{
    use ProfileHasFormat;

    /**
     * Build the profile URL based on the provided email address.
     */
    public function url(): string
    {
        if ($this->email === null || $this->email === '') {
            throw new MissingEmailException('You should set an email address before trying to get a Gravatar profile URL');
        }

        return static::URL
            .$this->hash($this->email)
            .($this->format === null ? '' : '.'.$this->format);
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
        $this->format = 'json';

        $profile = file_get_contents($this->url());

        if ($profile === false) {
            return null;
        }

        $data = json_decode($profile, true);

        if (! \is_array($data)) {
            return null;
        }

        if (! isset($data['entry'])) {
            return null;
        }

        return $data;
    }
}
