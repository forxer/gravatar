<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

use Gravatar\Exception\InvalidImageExtensionException;
use Gravatar\Image;

trait ImageHasExtension
{
    /**
     * @var string The extension to append to the avatars URL.
     */
    protected ?string $extension = null;

    /**
     * Get or set the avatar extension to use.
     *
     * @param  string|null  $extension  The avatar extension to use.
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
     * @param  string|null  $extension  The avatar extension to use.
     * @return Image The current Gravatar Image instance.
     *
     * @throws InvalidImageExtensionException
     */
    public function setExtension(?string $extension = null): Image
    {
        if ($extension === null) {
            return $this;
        }

        $extension = strtolower($extension);

        if (! \in_array($extension, $this->validExtensions())) {
            $message = sprintf(
                'The extension "%s" is not a valid one, extension image for Gravatar can be: "%s"',
                $extension,
                implode('", "', $this->validExtensions())
            );

            throw new InvalidImageExtensionException($message);
        }

        $this->extension = $extension;

        return $this;
    }

    /**
     * List of accepted image extension string names.
     */
    private function validExtensions(): array
    {
        return ['jpg', 'jpeg', 'gif', 'png', 'webp'];
    }
}
