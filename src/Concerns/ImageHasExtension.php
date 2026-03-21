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
    public ?string $extension = null {
        set(Extension|string|null $value) {
            if ($value === null) {
                $this->extension = null;

                return;
            }

            $stringValue = $value instanceof Extension ? $value->value : strtolower($value);
            $enum = Extension::tryFrom($stringValue);

            if ($enum === null) {
                throw new InvalidImageExtensionException(\sprintf(
                    'The extension "%s" is not a valid one, extension image for Gravatar can be: "%s"',
                    $stringValue,
                    implode('", "', Extension::values())
                ));
            }

            $this->extension = $enum->value;
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
        if (\func_num_args() === 0) {
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
        $this->extension = Extension::JPG;

        return $this;
    }

    /**
     * Set the avatar extension to JPEG.
     */
    public function extensionJpeg(): static
    {
        $this->extension = Extension::JPEG;

        return $this;
    }

    /**
     * Set the avatar extension to GIF.
     */
    public function extensionGif(): static
    {
        $this->extension = Extension::GIF;

        return $this;
    }

    /**
     * Set the avatar extension to PNG.
     */
    public function extensionPng(): static
    {
        $this->extension = Extension::PNG;

        return $this;
    }

    /**
     * Set the avatar extension to WEBP.
     */
    public function extensionWebp(): static
    {
        $this->extension = Extension::WEBP;

        return $this;
    }
}
