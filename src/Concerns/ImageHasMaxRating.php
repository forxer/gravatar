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
    public ?string $maxRating = null {
        set {
            if ($value !== null) {
                // Convert Rating enum to string if needed
                $stringValue = $value instanceof Rating ? $value->value : $value;
                $stringValue = strtolower($stringValue);

                if (! \in_array($stringValue, Rating::values())) {
                    throw new InvalidMaxRatingImageException(\sprintf(
                        'Invalid rating "%s" specified, only allowed to be used are: "%s"',
                        $stringValue,
                        implode('", "', Rating::values())
                    ));
                }

                $this->maxRating = $stringValue;
            } else {
                $this->maxRating = null;
            }
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

        $this->maxRating = $maxRating;

        return $this;
    }

    /**
     * Set the maximum rating to G (General Audiences).
     */
    public function ratingG(): static
    {
        return $this->maxRating(Rating::G);
    }

    /**
     * Set the maximum rating to PG (Parental Guidance Suggested).
     */
    public function ratingPg(): static
    {
        return $this->maxRating(Rating::PG);
    }

    /**
     * Set the maximum rating to R (Restricted).
     */
    public function ratingR(): static
    {
        return $this->maxRating(Rating::R);
    }

    /**
     * Set the maximum rating to X (Adult Only).
     */
    public function ratingX(): static
    {
        return $this->maxRating(Rating::X);
    }
}
