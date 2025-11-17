<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

use Gravatar\Enum\DefaultImage;
use Gravatar\Exception\InvalidDefaultImageException;

trait ImageHasDefault
{
    use ImageForceDefault, ImageHasInitials;

    /**
     * The default image to use ; either a string of the gravatar recognized default image "type" to use, or a URL
     */
    public ?string $defaultImage = null {
        set {
            if ($value !== null) {
                // Convert DefaultImage enum to string if needed
                $stringValue = $value instanceof DefaultImage ? $value->value : $value;
                $stringValue = strtolower($stringValue);

                if (! \in_array($stringValue, DefaultImage::values()) && ! filter_var($stringValue, FILTER_VALIDATE_URL)) {
                    throw new InvalidDefaultImageException(\sprintf(
                        'The default image "%s" is not a recognized gravatar "default" and is not a valid URL, default gravatar can be: %s',
                        $stringValue,
                        implode(', ', DefaultImage::values())
                    ));
                }
                $this->defaultImage = $stringValue;
            } else {
                $this->defaultImage = null;
            }
        }
    }

    /**
     * Get or set the default image to use for avatars.
     *
     * @param  DefaultImage|string|null  $defaultImage  The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @param  bool  $forceDefault  Force the default image to be always load.
     * @return $this|string|null
     */
    public function defaultImage(DefaultImage|string|null $defaultImage = null, bool $forceDefault = false): static|string|null
    {
        if ($defaultImage === null) {
            return $this->defaultImage;
        }

        if ($forceDefault) {
            $this->enableForceDefault();
        }

        $this->defaultImage = $defaultImage;

        return $this;
    }

    /**
     * Set the default image to initials.
     */
    public function defaultImageInitials(): static
    {
        return $this->defaultImage(DefaultImage::INITIALS);
    }

    /**
     * Set the default image to a solid color background.
     */
    public function defaultImageColor(): static
    {
        return $this->defaultImage(DefaultImage::COLOR);
    }

    /**
     * Set the default image to 404 (no image).
     */
    public function defaultImageNotFound(): static
    {
        return $this->defaultImage(DefaultImage::NOT_FOUND);
    }

    /**
     * Set the default image to mystery person.
     */
    public function defaultImageMp(): static
    {
        return $this->defaultImage(DefaultImage::MYSTERY_PERSON);
    }

    /**
     * Set the default image to identicon.
     */
    public function defaultImageIdenticon(): static
    {
        return $this->defaultImage(DefaultImage::IDENTICON);
    }

    /**
     * Set the default image to monsterid.
     */
    public function defaultImageMonsterid(): static
    {
        return $this->defaultImage(DefaultImage::MONSTERID);
    }

    /**
     * Set the default image to wavatar.
     */
    public function defaultImageWavatar(): static
    {
        return $this->defaultImage(DefaultImage::WAVATAR);
    }

    /**
     * Set the default image to retro.
     */
    public function defaultImageRetro(): static
    {
        return $this->defaultImage(DefaultImage::RETRO);
    }

    /**
     * Set the default image to robohash.
     */
    public function defaultImageRobohash(): static
    {
        return $this->defaultImage(DefaultImage::ROBOHASH);
    }

    /**
     * Set the default image to blank (transparent).
     */
    public function defaultImageBlank(): static
    {
        return $this->defaultImage(DefaultImage::BLANK);
    }
}
