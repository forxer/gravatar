<?php

declare(strict_types=1);

namespace Gravatar;

use Stringable;

interface GravatarInterface extends Stringable
{
    /**
     * Build the URL based on the provided settings.
     */
    public function url(): string;

    /**
     * Create a copy of the current instance with all its settings.
     *
     * @param  string|null  $email  Optional new email address for the copy.
     * @return static A new instance with the same settings.
     */
    public function copy(?string $email = null): static;
}
