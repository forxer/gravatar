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
    public private(set) ?string $defaultImage = null {
        set {
            if ($value !== null) {
                $value = strtolower($value);

                if (! \in_array($value, DefaultImage::values()) && ! filter_var($value, FILTER_VALIDATE_URL)) {
                    throw new InvalidDefaultImageException(\sprintf(
                        'The default image "%s" is not a recognized gravatar "default" and is not a valid URL, default gravatar can be: %s',
                        $value,
                        implode(', ', DefaultImage::values())
                    ));
                }
            }
            $this->defaultImage = $value;
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

        return $this->setDefaultImage($defaultImage, $forceDefault);
    }

    /**
     * Alias for the "defaultImage" method.
     *
     * @param  DefaultImage|string|null  $defaultImage  The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @param  bool  $forceDefault  Force the default image to be always load.
     * @return $this|string|null
     */
    public function d(DefaultImage|string|null $defaultImage = null, bool $forceDefault = false): static|string|null
    {
        return $this->defaultImage($defaultImage, $forceDefault);
    }

    /**
     * Set the default image to use for avatars.
     *
     * @param  DefaultImage|string|null  $defaultImage  The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @param  bool  $forceDefault  Force the default image to be always load.
     * @return $this The current Gravatar Image instance.
     *
     * @throws InvalidDefaultImageException
     */
    public function setDefaultImage(DefaultImage|string|null $defaultImage = null, bool $forceDefault = false): static
    {
        if ($forceDefault) {
            $this->enableForceDefault();
        }

        if ($defaultImage !== null) {
            $this->defaultImage = $defaultImage instanceof DefaultImage ? $defaultImage->value : $defaultImage;
        }

        return $this;
    }

    /**
     * Set the default image to initials.
     */
    public function defaultImageInitials(): static
    {
        return $this->setDefaultImage(DefaultImage::INITIALS);
    }

    /**
     * Set the default image to a solid color background.
     */
    public function defaultImageColor(): static
    {
        return $this->setDefaultImage(DefaultImage::COLOR);
    }

    /**
     * Set the default image to 404 (no image).
     */
    public function defaultImageNotFound(): static
    {
        return $this->setDefaultImage(DefaultImage::NOT_FOUND);
    }

    /**
     * Set the default image to mystery person.
     */
    public function defaultImageMp(): static
    {
        return $this->setDefaultImage(DefaultImage::MYSTERY_PERSON);
    }

    /**
     * Set the default image to identicon.
     */
    public function defaultImageIdenticon(): static
    {
        return $this->setDefaultImage(DefaultImage::IDENTICON);
    }

    /**
     * Set the default image to monsterid.
     */
    public function defaultImageMonsterid(): static
    {
        return $this->setDefaultImage(DefaultImage::MONSTERID);
    }

    /**
     * Set the default image to wavatar.
     */
    public function defaultImageWavatar(): static
    {
        return $this->setDefaultImage(DefaultImage::WAVATAR);
    }

    /**
     * Set the default image to retro.
     */
    public function defaultImageRetro(): static
    {
        return $this->setDefaultImage(DefaultImage::RETRO);
    }

    /**
     * Set the default image to robohash.
     */
    public function defaultImageRobohash(): static
    {
        return $this->setDefaultImage(DefaultImage::ROBOHASH);
    }

    /**
     * Set the default image to blank (transparent).
     */
    public function defaultImageBlank(): static
    {
        return $this->setDefaultImage(DefaultImage::BLANK);
    }
}
