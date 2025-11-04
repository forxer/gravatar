<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

trait ImageForceDefault
{
    /**
     * @var bool Should we force the default image to always load?
     */
    protected bool $forceDefault = false;

    /**
     * Get or set if we have to force the default image to be always load.
     */
    public function forceDefault(?bool $forceDefault = null): bool|static
    {
        if ($forceDefault === null) {
            return $this->getForceDefault();
        }

        return $this->setForceDefault($forceDefault);
    }

    /**
     * Alias for the "forceDefault" method.
     */
    public function f(?bool $forceDefault = null): bool|static
    {
        return $this->forceDefault($forceDefault);
    }

    /**
     * Check if we are forcing the default image to be always load.
     *
     * @return bool Are we forcing the default image?
     */
    public function getForceDefault(): bool
    {
        return $this->forceDefault;
    }

    /**
     * Alias for the "getForceDefault" method.
     *
     * @return bool Are we forcing the default image?
     */
    public function forcingDefault(): bool
    {
        return $this->getForceDefault();
    }

    /**
     * Set if the default image has to be always load.
     *
     * @param  bool  $forceDefault  Should we force or not the default image to be always load.
     * @return $this The current Gravatar Image instance.
     */
    public function setForceDefault(bool $forceDefault): static
    {
        $this->forceDefault = $forceDefault;

        return $this;
    }

    /**
     * Force the default image to be always load.
     *
     * @return $this The current Gravatar Image instance.
     */
    public function enableForceDefault(): static
    {
        return $this->setForceDefault(true);
    }

    /**
     * Do not force the default image to be always load.
     *
     * @return $this The current Gravatar Image instance.
     */
    public function disableForceDefault(): static
    {
        return $this->setForceDefault(false);
    }
}
