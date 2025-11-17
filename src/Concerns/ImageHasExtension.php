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
                // Convert Extension enum to string if needed
                $stringValue = $value instanceof Extension ? $value->value : $value;
                $stringValue = strtolower($stringValue);

                if (! \in_array($stringValue, Extension::values())) {
                    throw new InvalidImageExtensionException(\sprintf(
                        'The extension "%s" is not a valid one, extension image for Gravatar can be: "%s"',
                        $stringValue,
                        implode('", "', Extension::values())
                    ));
                }
                $this->extension = $stringValue;
            } else {
                $this->extension = null;
            }
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

        $this->extension = $extension;

        return $this;
    }

    /**
     * Set the avatar extension to JPG.
     */
    public function extensionJpg(): static
    {
        return $this->extension(Extension::JPG);
    }

    /**
     * Set the avatar extension to JPEG.
     */
    public function extensionJpeg(): static
    {
        return $this->extension(Extension::JPEG);
    }

    /**
     * Set the avatar extension to GIF.
     */
    public function extensionGif(): static
    {
        return $this->extension(Extension::GIF);
    }

    /**
     * Set the avatar extension to PNG.
     */
    public function extensionPng(): static
    {
        return $this->extension(Extension::PNG);
    }

    /**
     * Set the avatar extension to WEBP.
     */
    public function extensionWebp(): static
    {
        return $this->extension(Extension::WEBP);
    }
}
