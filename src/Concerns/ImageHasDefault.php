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
        set(DefaultImage|string|null $value) {
            if ($value === null) {
                $this->defaultImage = null;

                return;
            }

            $stringValue = $value instanceof DefaultImage ? $value->value : strtolower($value);

            if (DefaultImage::tryFrom($stringValue) === null && ! filter_var($stringValue, FILTER_VALIDATE_URL)) {
                throw new InvalidDefaultImageException(\sprintf(
                    'The default image "%s" is not a recognized gravatar "default" and is not a valid URL, default gravatar can be: %s',
                    $stringValue,
                    implode(', ', DefaultImage::values())
                ));
            }

            $this->defaultImage = $stringValue;
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
        if (\func_num_args() === 0) {
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
        $this->defaultImage = DefaultImage::INITIALS;

        return $this;
    }

    /**
     * Set the default image to a solid color background.
     */
    public function defaultImageColor(): static
    {
        $this->defaultImage = DefaultImage::COLOR;

        return $this;
    }

    /**
     * Set the default image to 404 (no image).
     */
    public function defaultImageNotFound(): static
    {
        $this->defaultImage = DefaultImage::NOT_FOUND;

        return $this;
    }

    /**
     * Set the default image to mystery person.
     */
    public function defaultImageMp(): static
    {
        $this->defaultImage = DefaultImage::MYSTERY_PERSON;

        return $this;
    }

    /**
     * Set the default image to identicon.
     */
    public function defaultImageIdenticon(): static
    {
        $this->defaultImage = DefaultImage::IDENTICON;

        return $this;
    }

    /**
     * Set the default image to monsterid.
     */
    public function defaultImageMonsterid(): static
    {
        $this->defaultImage = DefaultImage::MONSTERID;

        return $this;
    }

    /**
     * Set the default image to wavatar.
     */
    public function defaultImageWavatar(): static
    {
        $this->defaultImage = DefaultImage::WAVATAR;

        return $this;
    }

    /**
     * Set the default image to retro.
     */
    public function defaultImageRetro(): static
    {
        $this->defaultImage = DefaultImage::RETRO;

        return $this;
    }

    /**
     * Set the default image to robohash.
     */
    public function defaultImageRobohash(): static
    {
        $this->defaultImage = DefaultImage::ROBOHASH;

        return $this;
    }

    /**
     * Set the default image to blank (transparent).
     */
    public function defaultImageBlank(): static
    {
        $this->defaultImage = DefaultImage::BLANK;

        return $this;
    }
}
