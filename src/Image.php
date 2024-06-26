<?php

declare(strict_types=1);

namespace Gravatar;

use Gravatar\Concerns\ImageHasDefault;
use Gravatar\Concerns\ImageHasExtension;
use Gravatar\Concerns\ImageHasMaxRating;
use Gravatar\Concerns\ImageHasSize;
use Gravatar\Exception\MissingEmailException;
use Stringable;

class Image extends Gravatar implements Stringable
{
    use ImageHasDefault;
    use ImageHasExtension;
    use ImageHasMaxRating;
    use ImageHasSize;

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
     * Build the avatar URL based on the provided settings.
     *
     * @return string The URL to the gravatar.
     */
    public function url(): string
    {
        $email = $this->getEmail();

        if ($email === null || $email === '' || $email === '0') {
            throw new MissingEmailException('You should set an email address before trying to get a Gravatar URL');
        }

        $extension = $this->getExtension();

        return static::URL
            .'avatar/'
            .$this->hash($email)
            .($extension ? '.'.$extension : '')
            .$this->queryString();
    }

    /**
     * Return the avatar URL when this object is printed.
     *
     * @return string The URL to the gravatar.
     */
    public function __toString(): string
    {
        return $this->url();
    }

    /**
     * Get query string parameters to URL
     */
    protected function queryString(): string
    {
        $params = [];

        if ($size = $this->getSize()) {
            $params['s'] = $size;
        }

        if ($defaultImage = $this->getDefaultImage()) {
            $params['d'] = $defaultImage;
        }

        if ($maxRating = $this->getMaxRating()) {
            $params['r'] = $maxRating;
        }

        if ($this->forcingDefault()) {
            $params['f'] = 'y';
        }

        return $params === [] ? '' : '?'.http_build_query($params, '', '&amp;');
    }
}
