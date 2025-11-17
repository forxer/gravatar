<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

trait ImageForceDefault
{
    /**
     * Should we force the default image to always load?
     */
    public bool $forceDefault = false;

    /**
     * Get or set if we have to force the default image to be always load.
     *
     * @param  bool|null  $forceDefault  Should we force or not the default image to be always load.
     * @return bool|$this
     */
    public function forceDefault(?bool $forceDefault = null): bool|static
    {
        if ($forceDefault === null) {
            return $this->forceDefault;
        }

        $this->forceDefault = $forceDefault;

        return $this;
    }

    /**
     * Alias for checking if we are forcing the default image.
     *
     * @return bool Are we forcing the default image?
     */
    public function forcingDefault(): bool
    {
        return $this->forceDefault;
    }

    /**
     * Force the default image to be always load.
     *
     * @return $this The current Gravatar Image instance.
     */
    public function enableForceDefault(): static
    {
        return $this->forceDefault(true);
    }

    /**
     * Do not force the default image to be always load.
     *
     * @return $this The current Gravatar Image instance.
     */
    public function disableForceDefault(): static
    {
        return $this->forceDefault(false);
    }
}
