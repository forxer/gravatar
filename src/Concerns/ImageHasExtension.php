<?php

namespace Gravatar\Concerns;

use Gravatar\Exception\InvalidImageExtensionException;
use Gravatar\Image;

trait ImageHasExtension
{
    /**
     * @var string The extension to append to the avatars URL.
     */
    protected string $extension = null;

    /**
     * Get or set the avatar extension to use.
     *
     * @param string|null $extension The avatar extension to use.
     * @return Image|string|null
     */
    public function extension(?string $extension = null): Image|string|null
    {
        if ($extension === null) {
            return $this->getExtension();
        }

        return $this->setExtension($extension);
    }

    /**
     * Alias for the "extension" method.
     *
     * @param string|null $extension
     * @return Image|string|null
     */
    public function e(?string $extension = null): Image|string|null
    {
        return $this->extension($extension);
    }

    /**
     * Get the currently set avatar extension.
     *
     * @return string|null The current avatar extension in use
     */
    public function getExtension(): ?string
    {
        return $this->extension;
    }

    /**
     * Set the avatar extension to use.
     *
     * @param string $extension The avatar extension to use.
     * @return Image The current Gravatar Image instance.
     * @throws InvalidImageExtensionException
     */
    public function setExtension(string $extension): Image
    {
        $maxRating = strtolower($extension);

        if (! in_array($extension, $this->validExtensions())) {
            $message = sprintf(
                'The extension "%s" is not a valid one, extension image for Gravatar can be: %s',
                $extension,
                implode(', ', $this->validExtensions())
            );

            throw new InvalidImageExtensionException($message);
        }

        $this->extension = $extension;

        return $this;
    }

    /**
     * List of accepted image extension string names.
     *
     * @return array
     */
    private function validExtensions(): array
    {
        return ['jpg', 'jpeg', 'gif', 'png'];
    }
}
