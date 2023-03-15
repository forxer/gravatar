<?php

namespace Gravatar\Concerns;

use Gravatar\Exception\InvalidMaxRatingImageException;
use Gravatar\Image;

trait ImageHasMaxRating
{
    /**
     * @var string|null The maximum rating to allow for the avatars.
     */
    protected ?string $maxRating = null;

    /**
     * Get or set the maximum allowed rating for avatars.
     *
     * @param string|null $maxRating
     * @return Image|string|null
     */
    public function maxRating(?string $maxRating = null): Image|string|null
    {
        if ($maxRating === null) {
            return $this->getMaxRating();
        }

        return $this->setMaxRating($maxRating);
    }

    /**
     * Alias for the "rating" method.
     *
     * @param int|null $maxRating
     * @return Image|string|null
     */
    public function r(?string $maxRating = null): Image|string|null
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
     * @param string|null $maxRating The maximum rating to use for avatars.
     * @return Image The current Gravatar Image instance.
     * @throws InvalidMaxRatingImageException
     */
    public function setMaxRating(?string $maxRating = null): Image
    {
        if ($maxRating === null) {
            return $this;
        }

        $maxRating = strtolower($maxRating);

        if (! in_array($maxRating, $this->validMaxRating())) {
            $message = sprintf(
                'Invalid rating "%s" specified, only allowed to be used are: %s',
                $maxRating,
                implode(', ', $this->validMaxRating())
            );

            throw new InvalidMaxRatingImageException($message);
        }

        $this->maxRating = $maxRating;

        return $this;
    }

    /**
     * List of accepted max rating string names.
     *
     * @return array
     */
    private function validMaxRating(): array
    {
        return ['g', 'pg', 'r', 'x'];
    }
}
