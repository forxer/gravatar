<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

trait HasEmail
{
    /**
     * @var string|null The address email to be used.
     */
    protected ?string $email = null;

    /**
     * Get or set the address email to be used.
     *
     * @return $this|string|null
     */
    public function email(?string $email = null): static|string|null
    {
        if ($email === null) {
            return $this->getEmail();
        }

        return $this->setEmail($email);
    }

    /**
     * Get the address email to be used.
     *
     * @return string|null The current email in use.
     */
    public function getEmail(): ?string
    {
        return $this->email;
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
