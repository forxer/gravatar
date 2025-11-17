<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

trait ImageHasInitials
{
    /**
     * The user initials to use with "initials" default option
     */
    public ?string $initials = null;

    /**
     * The name to use with "initials" default option for generating initials.
     */
    public ?string $initialsName = null;

    /**
     * Get or set the user initials to use with "initials" default option.
     *
     * @param  string|null  $initials  User initials.
     * @return $this|string|null
     */
    public function initials(?string $initials = null): static|string|null
    {
        if ($initials === null) {
            return $this->initials;
        }

        $this->initials = $initials;

        return $this;
    }

    /**
     * Get or set the name to use with "initials" default option for generating initials.
     *
     * @param  string|null  $initialsName  Name for generating initials.
     * @return $this|string|null
     */
    public function initialsName(?string $initialsName = null): static|string|null
    {
        if ($initialsName === null) {
            return $this->initialsName;
        }

        $this->initialsName = $initialsName;

        return $this;
    }

    /**
     * Convenience method to set both default image to "initials" and the initials value.
     *
     * @param  string  $initials  User initials.
     * @return $this The current Gravatar Image instance.
     */
    public function withInitials(string $initials): static
    {
        return $this->defaultImage('initials')
            ->initials($initials);
    }

    /**
     * Convenience method to set both default image to "initials" and the name value.
     *
     * @param  string  $initialsName  Name for generating initials.
     * @return $this The current Gravatar Image instance.
     */
    public function withInitialsName(string $initialsName): static
    {
        return $this->defaultImage('initials')
            ->initialsName($initialsName);
    }
}
