<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

use Gravatar\Exception\InvalidMaxRatingImageException;

trait ImageHasMaxRating
{
    private const VALID_MAX_RATINGS = ['g', 'pg', 'r', 'x'];

    /**
     * The maximum rating to allow for the avatars.
     */
    public private(set) ?string $maxRating = null {
        set {
            if ($value !== null) {
                $value = strtolower($value);

                if (! \in_array($value, self::VALID_MAX_RATINGS)) {
                    throw new InvalidMaxRatingImageException(\sprintf(
                        'Invalid rating "%s" specified, only allowed to be used are: "%s"',
                        $value,
                        implode('", "', self::VALID_MAX_RATINGS)
                    ));
                }
            }
            $this->maxRating = $value;
        }
    }

    /**
     * Get or set the maximum allowed rating for avatars.
     *
     * @return $this|string|null
     */
    public function maxRating(?string $maxRating = null): static|string|null
    {
        if ($maxRating === null) {
            return $this->maxRating;
        }

        return $this->setMaxRating($maxRating);
    }

    /**
     * Alias for the "rating" method.
     *
     * @return $this|string|null
     */
    public function r(?string $maxRating = null): static|string|null
    {
        return $this->maxRating($maxRating);
    }

    /**
     * Set the maximum allowed rating for avatars.
     *
     * @param  string|null  $maxRating  The maximum rating to use for avatars.
     * @return $this The current Gravatar Image instance.
     *
     * @throws InvalidMaxRatingImageException
     */
    public function setMaxRating(?string $maxRating = null): static
    {
        if ($maxRating !== null) {
            $this->maxRating = $maxRating;
        }

        return $this;
    }
}
