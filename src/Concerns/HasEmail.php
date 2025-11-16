<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

trait HasEmail
{
    /**
     * The address email to be used.
     */
    public private(set) ?string $email = null;

    /**
     * Get or set the address email to be used.
     *
     * @return $this|string|null
     */
    public function email(?string $email = null): static|string|null
    {
        if ($email === null) {
            return $this->email;
        }

        return $this->setEmail($email);
    }

    /**
     * Set the address email to be used.
     *
     * @return $this
     */
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }
}
