<?php

namespace Gravatar\Concerns;

use Gravatar\Exception\InvalidDefaultImageException;
use Gravatar\Image;

trait ImageHasDefault
{
    use ImageForceDefault;

    /**
     * @var string The default image to use ; either a string of the gravatar recognized default image "type" to use, or a URL
     */
    protected ?string $defaultImage;

    /**
     * Get or set the default image to use for avatars.
     *
     * @param string|null $defaultImage The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @param bool $forceDefault Force the default image to be always load.
     * @return Image|null
     */
    public function defaultImage(?string $defaultImage = null, bool $forceDefault = false): ?Image
    {
        if ($defaultImage === null) {
            return $this->getDefaultImage();
        }

        return $this->setDefaultImage($defaultImage, $forceDefault);
    }

    /**
     * Alias for the "defaultImage" method.
     *
     * @param string|null $defaultImage The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @param bool $forceDefault Force the default image to be always load.
     * @return string|\Image
     */
    public function d(?string $defaultImage = null, bool $forceDefault = false): ?Image
    {
        return $this->defaultImage($defaultImage, $forceDefault);
    }

    /**
     * Get the current default image setting.
     *
     * @return string|null Default image.
     */
    public function getDefaultImage(): ?string
    {
        return $this->defaultImage;
    }

    /**
     * Set the default image to use for avatars.
     *
     * @param string $defaultImage The default image to use. Use a valid image URL, or a recognized gravatar "default".
     * @param bool $forceDefault Force the default image to be always load.
     * @throws InvalidDefaultImageException
     * @return Image The current Gravatar Image instance.
     */
    public function setDefaultImage(?string $defaultImage = null, bool $forceDefault = false): Image
    {
        if ($forceDefault === true) {
            $this->enableForceDefault();
        }

        if ($defaultImage === null) {
            return $this;
        }

        $defaultImage = strtolower($defaultImage);

        if (in_array($defaultImage, $this->validDefaultImages())) {
            $this->defaultImage = $defaultImage;

            return $this;
        }

        if (filter_var($defaultImage, FILTER_VALIDATE_URL)) {
            $this->defaultImage = $defaultImage;

            return $this;
        }

        $message = sprintf(
            'The default image "%s" is not a recognized gravatar "default" and is not a valid URL, default gravatar can be: %s',
            $defaultImage,
            implode(', ', $this->validDefaultImages())
        );

        throw new InvalidDefaultImageException($message);
    }

    /**
     * Return the list of accepted gravatar recognized default image "type".
     *
     * @return array
     */
    private function validDefaultImages(): array
    {
        return [
            '404',
            'mp',
            'identicon',
            'monsterid',
            'wavatar',
            'retro',
            'robohash',
            'blank',
        ];
    }
}
