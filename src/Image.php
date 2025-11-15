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

        if (\in_array($email, [null, '', '0'], true)) {
            throw new MissingEmailException('You should set an email address before trying to get a Gravatar URL');
        }

        $extension = $this->getExtension();

        return static::URL
            .'avatar/'
            .$this->hash($email)
            .(\in_array($extension, [null, '', '0'], true) ? '' : '.'.$extension)
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
            $copy->setEmail($email);
        }

        return $copy;
    }

    /**
     * Get query string parameters to URL
     */
    protected function queryString(): string
    {
        $params = [];

        $size = $this->getSize();

        if ($size !== null && $size !== 0) {
            $params['s'] = $size;
        }

        $defaultImage = $this->getDefaultImage();

        if (! \in_array($defaultImage, [null, '', '0'], true)) {
            $params['d'] = $defaultImage;
        }

        if ($defaultImage === 'initials') {
            $initials = $this->getInitials();
            $name = $this->getName();

            if ($initials !== null && $initials !== '') {
                $params['initials'] = $initials;
            } elseif ($name !== null && $name !== '') {
                $params['name'] = $name;
            }
        }

        $maxRating = $this->getMaxRating();

        if (! \in_array($maxRating, [null, '', '0'], true)) {
            $params['r'] = $maxRating;
        }

        if ($this->forcingDefault()) {
            $params['f'] = 'y';
        }

        return $params === [] ? '' : '?'.http_build_query($params);
    }
}
