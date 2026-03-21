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
     * Build the avatar URL based on the provided settings.
     *
     * @return string The URL to the gravatar.
     */
    public function url(): string
    {
        if ($this->email === null || $this->email === '') {
            throw new MissingEmailException('You should set an email address before trying to get a Gravatar URL');
        }

        return static::URL
            .'avatar/'
            .$this->hash($this->email)
            .($this->extension === null ? '' : '.'.$this->extension)
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

        if ($this->size !== null && $this->size !== 0) {
            $params['s'] = $this->size;
        }

        if ($this->defaultImage !== null) {
            $params['d'] = $this->defaultImage;
        }

        if ($this->defaultImage === 'initials') {
            if ($this->initials !== null && $this->initials !== '') {
                $params['initials'] = $this->initials;
            } elseif ($this->initialsName !== null && $this->initialsName !== '') {
                $params['name'] = $this->initialsName;
            }
        }

        if ($this->maxRating !== null) {
            $params['r'] = $this->maxRating;
        }

        if ($this->forceDefault) {
            $params['f'] = 'y';
        }

        return $params === [] ? '' : '?'.http_build_query($params);
    }
}
