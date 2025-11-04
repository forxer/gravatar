<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

trait ImageHasExtraParameters
{
    /**
     * @var string|null The user initials to use with "initials" default option
     */
    protected ?string $initials = null;

    /**
     * @var string|null The username to use with "initials" default option.
     */
    protected ?string $name = null;

    /**
     * Get or set the user initials to use with "initials" default option.
     *
     * @param  string|null  $initials  User initials.
     * @return $this|string|null
     */
    public function initials(?string $initials = null): static|string|null
    {
        if ($initials === null) {
            return $this->getInitials();
        }

        return $this->setInitials($initials);
    }

    /**
     * Get the current user initials setting.
     *
     * @return string|null User initials.
     */
    public function getInitials(): ?string
    {
        return $this->initials;
    }

    /**
     * Set the user initials to use with "initials" default option.
     *
     * @param  string|null  $initials  User initials.
     * @return $this The current Gravatar Image instance.
     */
    public function setInitials(?string $initials): static
    {
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
            return $this->getName();
        }

        return $this->setName($name);
    }

    /**
     * Get the current username setting.
     *
     * @return string|null Username.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the username to use with "initials" default option.
     *
     * @param  string|null  $name  Username.
     * @return $this The current Gravatar Image instance.
     */
    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
