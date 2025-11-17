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
     *
     * @param  string|null  $email  The email address to use for the Gravatar.
     */
    public function __construct(?string $email = null)
    {
        if ($email !== null) {
            $this->email($email);
        }
    }

    /**
     * Build the avatar URL based on the provided settings.
     *
     * @return string The URL to the gravatar.
     */
    public function url(): string
    {
        if (\in_array($this->email, [null, '', '0'], true)) {
            throw new MissingEmailException('You should set an email address before trying to get a Gravatar URL');
        }

        return static::URL
            .'avatar/'
            .$this->hash($this->email)
            .(\in_array($this->extension, [null, '', '0'], true) ? '' : '.'.$this->extension)
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
     * Create a copy of the current Image instance with all its settings.
     * Optionally change the email address in the copy.
     *
     * @param  string|null  $email  Optional new email address for the copy.
     * @return static A new Image instance with the same settings.
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
     * Get query string parameters to URL
     */
    protected function queryString(): string
    {
        $params = [];

        if ($this->size !== null && $this->size !== 0) {
            $params['s'] = $this->size;
        }

        if (! \in_array($this->defaultImage, [null, '', '0'], true)) {
            $params['d'] = $this->defaultImage;
        }

        if ($this->defaultImage === 'initials') {
            if ($this->initials !== null && $this->initials !== '') {
                $params['initials'] = $this->initials;
            } elseif ($this->initialsName !== null && $this->initialsName !== '') {
                $params['name'] = $this->initialsName;
            }
        }

        if (! \in_array($this->maxRating, [null, '', '0'], true)) {
            $params['r'] = $this->maxRating;
        }

        if ($this->forceDefault) {
            $params['f'] = 'y';
        }

        return $params === [] ? '' : '?'.http_build_query($params);
    }
}
