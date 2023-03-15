<?php

use Gravatar\Image;
use Gravatar\Profile;

if (! function_exists('gravatar')) {
    /**
     * Return a new Gravatar Image instance.
     *
     * @param string|null $email
     * @return Image
     */
    function gravatar(?string $email = null): Image
    {
        return new Image($email);
    }
}

if (! function_exists('gravatar_profile')) {
    /**
     * Return a new Gravatar Profile instance.
     *
     * @param string|null $email
     * @return Profile
     */
    function gravatar_profile(?string $email = null): Profile
    {
        return new Profile($email);
    }
}
