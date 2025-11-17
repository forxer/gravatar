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
     * The username to use with "initials" default option.
     */
    public ?string $name = null;

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
     * Get or set the username to use with "initials" default option.
     *
     * @param  string|null  $name  Username.
     * @return $this|string|null
     */
    public function name(?string $name = null): static|string|null
    {
        if ($name === null) {
            return $this->name;
        }

        $this->name = $name;

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
     * @param  string  $name  Username.
     * @return $this The current Gravatar Image instance.
     */
    public function withName(string $name): static
    {
        return $this->defaultImage('initials')
            ->name($name);
    }
}
