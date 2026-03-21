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
        set(Rating|string|null $value) {
            if ($value === null) {
                $this->maxRating = null;

                return;
            }

            $stringValue = $value instanceof Rating ? $value->value : strtolower($value);
            $enum = Rating::tryFrom($stringValue);

            if ($enum === null) {
                throw new InvalidMaxRatingImageException(\sprintf(
                    'Invalid rating "%s" specified, only allowed to be used are: "%s"',
                    $stringValue,
                    implode('", "', Rating::values())
                ));
            }

            $this->maxRating = $enum->value;
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
        if (\func_num_args() === 0) {
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
        $this->maxRating = Rating::G;

        return $this;
    }

    /**
     * Set the maximum rating to PG (Parental Guidance Suggested).
     */
    public function ratingPg(): static
    {
        $this->maxRating = Rating::PG;

        return $this;
    }

    /**
     * Set the maximum rating to R (Restricted).
     */
    public function ratingR(): static
    {
        $this->maxRating = Rating::R;

        return $this;
    }

    /**
     * Set the maximum rating to X (Adult Only).
     */
    public function ratingX(): static
    {
        $this->maxRating = Rating::X;

        return $this;
    }
}
