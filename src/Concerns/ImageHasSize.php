<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

use Gravatar\Exception\InvalidImageSizeException;

trait ImageHasSize
{
    /**
     * The size to use for avatars.
     */
    public private(set) ?int $size = null {
        set {
            if ($value !== null && ($value <= 0 || $value > 2048)) {
                throw new InvalidImageSizeException('Avatar size must be within 0 pixels and 2048 pixels');
            }
            $this->size = $value;
        }
    }

    /**
     * Get or set the avatar size to use.
     *
     * @param  int|null  $size  The avatar size to use, must be less than 2048 and greater than 0.
     * @return $this|int|null
     */
    public function size(?int $size = null): static|int|null
    {
        if ($size === null) {
            return $this->size;
        }

        $this->size = $size;

        return $this;
    }
}
