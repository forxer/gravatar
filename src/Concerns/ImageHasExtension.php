<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

use Gravatar\Exception\InvalidImageExtensionException;

trait ImageHasExtension
{
    private const VALID_EXTENSIONS = ['jpg', 'jpeg', 'gif', 'png', 'webp'];

    /**
     * The extension to append to the avatars URL.
     */
    public private(set) ?string $extension = null {
        set {
            if ($value !== null) {
                $value = strtolower($value);

                if (! \in_array($value, self::VALID_EXTENSIONS)) {
                    throw new InvalidImageExtensionException(\sprintf(
                        'The extension "%s" is not a valid one, extension image for Gravatar can be: "%s"',
                        $value,
                        implode('", "', self::VALID_EXTENSIONS)
                    ));
                }
            }
            $this->extension = $value;
        }
    }

    /**
     * Get or set the avatar extension to use.
     *
     * @param  string|null  $extension  The avatar extension to use.
     * @return $this|string|null
     */
    public function extension(?string $extension = null): static|string|null
    {
        if ($extension === null) {
            return $this->extension;
        }

        return $this->setExtension($extension);
    }

    /**
     * Alias for the "extension" method.
     *
     * @return $this|string|null
     */
    public function e(?string $extension = null): static|string|null
    {
        return $this->extension($extension);
    }

    /**
     * Set the avatar extension to use.
     *
     * @param  string|null  $extension  The avatar extension to use.
     * @return $this The current Gravatar Image instance.
     *
     * @throws InvalidImageExtensionException
     */
    public function setExtension(?string $extension = null): static
    {
        if ($extension !== null) {
            $this->extension = $extension;
        }

        return $this;
    }
}
