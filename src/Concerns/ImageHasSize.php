<?php

namespace Gravatar\Concerns;

use Gravatar\Exception\InvalidImageSizeException;
use Gravatar\Image;

trait ImageHasSize
{
    /**
     * @var int|null The size to use for avatars.
     */
    protected ?int $size = null;

    /**
     * Get or set the avatar size to use.
     *
     * @param int|null $size The avatar size to use, must be less than 2048 and greater than 0.
     * @return Image|int|null
     */
    public function size(?int $size = null): Image|int|null
    {
        if ($size === null) {
            return $this->getSize();
        }

        return $this->setSize($size);
    }

    /**
     * Alias for the "size" method.
     *
     * @param int|null $size The avatar size to use, must be less than 2048 and greater than 0.
     * @return Image|int|null
     */
    public function s(?int $size = null): Image|int|null
    {
        return $this->size($size);
    }

    /**
     * Get the currently set avatar size.
     *
     * @return int|null The current avatar size in use.
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * Set the avatar size to use.
     *
     * @param int|null $size The avatar size to use, must be less than 2048 and greater than 0.
     * @return Image The current Gravatar Image instance.
     * @throws InvalidImageSizeException
     */
    public function setSize(?int $size = null): Image
    {
        if ($size === null) {
            return $this;
        }

        if ($size <= 0 || $size > 2048) {
            throw new InvalidImageSizeException('Avatar size must be within 0 pixels and 2048 pixels');
        }

        $this->size = $size;

        return $this;
    }
}
