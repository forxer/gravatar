<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

use Gravatar\Exception\InvalidDefaultImageException;

trait ImageHasDefault
{
    use ImageForceDefault, ImageHasInitials;

    private const VALID_DEFAULT_IMAGES = [
        'initials',
        'color',
        '404',
        'mp',
        'identicon',
        'monsterid',
        'wavatar',
        'retro',
        'robohash',
        'blank',
    ];

    /**
     * The default image to use ; either a string of the gravatar recognized default image "type" to use, or a URL
     */
    public private(set) ?string $defaultImage = null {
        set {
            if ($value !== null) {
                $value = strtolower($value);

                if (! \in_array($value, self::VALID_DEFAULT_IMAGES) && ! filter_var($value, FILTER_VALIDATE_URL)) {
                    throw new InvalidDefaultImageException(\sprintf(
                        'The default image "%s" is not a recognized gravatar "default" and is not a valid URL, default gravatar can be: %s',
                        $value,
                        implode(', ', self::VALID_DEFAULT_IMAGES)
                    ));
                }
            }
            $this->defaultImage = $value;
        }
    }

    /**
     * Get or set the default image to use for avatars.
     *
     * @param  string|null  $defaultImage  The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @param  bool  $forceDefault  Force the default image to be always load.
     * @return $this|string|null
     */
    public function defaultImage(?string $defaultImage = null, bool $forceDefault = false): static|string|null
    {
        if ($defaultImage === null) {
            return $this->defaultImage;
        }

        return $this->setDefaultImage($defaultImage, $forceDefault);
    }

    /**
     * Alias for the "defaultImage" method.
     *
     * @param  string|null  $defaultImage  The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @param  bool  $forceDefault  Force the default image to be always load.
     * @return $this|string|null
     */
    public function d(?string $defaultImage = null, bool $forceDefault = false): static|string|null
    {
        return $this->defaultImage($defaultImage, $forceDefault);
    }

    /**
     * Set the default image to use for avatars.
     *
     * @param  string|null  $defaultImage  The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @param  bool  $forceDefault  Force the default image to be always load.
     * @return $this The current Gravatar Image instance.
     *
     * @throws InvalidDefaultImageException
     */
    public function setDefaultImage(?string $defaultImage = null, bool $forceDefault = false): static
    {
        if ($forceDefault) {
            $this->enableForceDefault();
        }

        if ($defaultImage !== null) {
            $this->defaultImage = $defaultImage;
        }

        return $this;
    }
}
