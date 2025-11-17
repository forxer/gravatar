<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

trait HasEmail
{
    /**
     * The address email to be used.
     */
    public ?string $email = null;

    /**
     * Get or set the address email to be used.
     *
     * @param  string|null  $email  The address email to use.
     * @return $this|string|null
     */
    public function email(?string $email = null): static|string|null
    {
        if ($email === null) {
            return $this->email;
        }

        $this->email = $email;

        return $this;
    }
}
