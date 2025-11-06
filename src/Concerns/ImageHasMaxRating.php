<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

use Gravatar\Exception\InvalidMaxRatingImageException;

trait ImageHasMaxRating
{
    /**
     * @var string|null The maximum rating to allow for the avatars.
     */
    protected ?string $maxRating = null;

    /**
     * Get or set the maximum allowed rating for avatars.
     *
     * @return $this|string|null
     */
    public function maxRating(?string $maxRating = null): static|string|null
    {
        if ($maxRating === null) {
            return $this->getMaxRating();
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
     * Get the current maximum allowed rating for avatars.
     *
     * @return string|null The string representing the current maximum allowed rating.
     */
    public function getMaxRating(): ?string
    {
        return $this->maxRating;
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
        if ($maxRating === null) {
            return $this;
        }

        $maxRating = strtolower($maxRating);

        if (! \in_array($maxRating, $this->validMaxRating())) {
            $message = \sprintf(
                'Invalid rating "%s" specified, only allowed to be used are: "%s"',
                $maxRating,
                implode('", "', $this->validMaxRating())
            );

            throw new InvalidMaxRatingImageException($message);
        }

        $this->maxRating = $maxRating;

        return $this;
    }

    /**
     * List of accepted max rating string names.
     */
    private function validMaxRating(): array
    {
        return ['g', 'pg', 'r', 'x'];
    }
}
