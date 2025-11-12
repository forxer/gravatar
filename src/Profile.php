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
     * Construct Image instance
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
        $email = $this->getEmail();

        if (\in_array($email, [null, '', '0'], true)) {
            throw new MissingEmailException('You should set an email address before trying to get a Gravatar profile URL');
        }

        $format = $this->getFormat();

        return 'https:'.static::URL
            .$this->hash($email)
            .(\in_array($format, [null, '', '0'], true) ? '' : '.'.$format);
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
     */
    public function getData(string $email): ?array
    {
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
