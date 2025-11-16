<?php

declare(strict_types=1);

namespace Gravatar;

use Gravatar\Concerns\ProfileHasFormat;
use Gravatar\Exception\MissingEmailException;
use Stringable;

class Profile extends Gravatar implements Stringable
{
    use ProfileHasFormat;

    /**
     * Construct Profile instance
     *
     * @param  string|null  $email  The email address to use for the Gravatar profile.
     */
    public function __construct(?string $email = null)
    {
        if ($email !== null) {
            $this->setEmail($email);
        }
    }

    /**
     * Build the profile URL based on the provided email address.
     */
    public function url(): string
    {
        if (\in_array($this->email, [null, '', '0'], true)) {
            throw new MissingEmailException('You should set an email address before trying to get a Gravatar profile URL');
        }

        return 'https:'.static::URL
            .$this->hash($this->email)
            .(\in_array($this->format, [null, '', '0'], true) ? '' : '.'.$this->format);
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
     * Create a copy of the current Profile instance with all its settings.
     * Optionally change the email address in the copy.
     *
     * @param  string|null  $email  Optional new email address for the copy.
     * @return static A new Profile instance with the same settings.
     */
    public function copy(?string $email = null): static
    {
        $copy = clone $this;

        if ($email !== null) {
            $copy->setEmail($email);
        }

        return $copy;
    }

    /**
     * Return profile data based on the provided email address.
     *
     * @param  string  $email  The email to get the gravatar profile for
     * @return array<string, mixed>|null
     */
    public function getData(string $email): ?array
    {
        $this->setEmail($email);
        $this->format('php');

        $profile = file_get_contents($this->url());

        $data = unserialize($profile);

        if (! \is_array($data)) {
            return null;
        }

        if (! isset($data['entry'])) {
            return null;
        }

        return $data;
    }
}
