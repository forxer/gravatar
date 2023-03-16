<?php

namespace Gravatar;

use Gravatar\Concerns\ProfileHasFormat;
use Gravatar\Exception\MissingEmailException;

class Profile extends Gravatar
{
    use ProfileHasFormat;

    /**
     * Construct Image instance
     *
     * @param string|null $email
     * @return void
     */
    public function __construct(?string $email = null)
    {
        if ($email !== null) {
            $this->setEmail($email);
        }
    }

    /**
     * Build the profile URL based on the provided email address.
     *
     * @return string
     */
    public function url(): string
    {
        $email = $this->getEmail();

        if (empty($email)) {
            throw new MissingEmailException('You should set an email address before trying to get a Gravatar profile URL');
        }

        $format = $this->getFormat();

        return 'https:'.static::URL
            .$this->hash($email)
            .($format ? '.'.$format : '');
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
     * @param string $email The email to get the gravatar profile for
     * @return array|null
     */
    public function getData(string $email): ?array
    {
        $this->format('php');

        $profile = file_get_contents($this->url($email));

        $data = unserialize($profile);

        if (is_array($data) && isset($data['entry'])) {
            return $data;
        }

        return null;
    }
}
