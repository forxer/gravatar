<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

use Gravatar\Enum\Extension;
use Gravatar\Exception\InvalidImageExtensionException;

trait ImageHasExtension
{
    /**
     * The extension to append to the avatars URL.
     */
    public private(set) ?string $extension = null {
        set {
            if ($value !== null) {
                $value = strtolower($value);

                if (! \in_array($value, Extension::values())) {
                    throw new InvalidImageExtensionException(\sprintf(
                        'The extension "%s" is not a valid one, extension image for Gravatar can be: "%s"',
                        $value,
                        implode('", "', Extension::values())
                    ));
                }
            }
            $this->extension = $value;
        }
    }

    /**
     * Get or set the avatar extension to use.
     *
     * @param  Extension|string|null  $extension  The avatar extension to use.
     * @return $this|string|null
     */
    public function extension(Extension|string|null $extension = null): static|string|null
    {
        if ($extension === null) {
            return $this->extension;
        }

        return $this->setExtension($extension);
    }

    /**
     * Set the avatar extension to use.
     *
     * @param  Extension|string|null  $extension  The avatar extension to use.
     * @return $this The current Gravatar Image instance.
     *
     * @throws InvalidImageExtensionException
     */
    public function setExtension(Extension|string|null $extension = null): static
    {
        if ($extension !== null) {
            $this->extension = $extension instanceof Extension ? $extension->value : $extension;
        }

        return $this;
    }

    /**
     * Set the avatar extension to JPG.
     */
    public function extensionJpg(): static
    {
        return $this->setExtension(Extension::JPG);
    }

    /**
     * Set the avatar extension to JPEG.
     */
    public function extensionJpeg(): static
    {
        return $this->setExtension(Extension::JPEG);
    }

    /**
     * Set the avatar extension to GIF.
     */
    public function extensionGif(): static
    {
        return $this->setExtension(Extension::GIF);
    }

    /**
     * Set the avatar extension to PNG.
     */
    public function extensionPng(): static
    {
        return $this->setExtension(Extension::PNG);
    }

    /**
     * Set the avatar extension to WEBP.
     */
    public function extensionWebp(): static
    {
        return $this->setExtension(Extension::WEBP);
    }
}
