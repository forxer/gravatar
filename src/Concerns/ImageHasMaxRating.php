<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

use Gravatar\Enum\Rating;
use Gravatar\Exception\InvalidMaxRatingImageException;

trait ImageHasMaxRating
{
    /**
     * The maximum rating to allow for the avatars.
     */
    public private(set) ?string $maxRating = null {
        set {
            if ($value !== null) {
                $value = strtolower($value);

                if (! \in_array($value, Rating::values())) {
                    throw new InvalidMaxRatingImageException(\sprintf(
                        'Invalid rating "%s" specified, only allowed to be used are: "%s"',
                        $value,
                        implode('", "', Rating::values())
                    ));
                }
            }
            $this->maxRating = $value;
        }
    }

    /**
     * Get or set the maximum allowed rating for avatars.
     *
     * @param  Rating|string|null  $maxRating  The maximum rating to use for avatars.
     * @return $this|string|null
     */
    public function maxRating(Rating|string|null $maxRating = null): static|string|null
    {
        if ($maxRating === null) {
            return $this->maxRating;
        }

        return $this->setMaxRating($maxRating);
    }

    /**
     * Set the maximum allowed rating for avatars.
     *
     * @param  Rating|string|null  $maxRating  The maximum rating to use for avatars.
     * @return $this The current Gravatar Image instance.
     *
     * @throws InvalidMaxRatingImageException
     */
    public function setMaxRating(Rating|string|null $maxRating = null): static
    {
        if ($maxRating !== null) {
            $this->maxRating = $maxRating instanceof Rating ? $maxRating->value : $maxRating;
        }

        return $this;
    }

    /**
     * Set the maximum rating to G (General Audiences).
     */
    public function ratingG(): static
    {
        return $this->setMaxRating(Rating::G);
    }

    /**
     * Set the maximum rating to PG (Parental Guidance Suggested).
     */
    public function ratingPg(): static
    {
        return $this->setMaxRating(Rating::PG);
    }

    /**
     * Set the maximum rating to R (Restricted).
     */
    public function ratingR(): static
    {
        return $this->setMaxRating(Rating::R);
    }

    /**
     * Set the maximum rating to X (Adult Only).
     */
    public function ratingX(): static
    {
        return $this->setMaxRating(Rating::X);
    }
}
