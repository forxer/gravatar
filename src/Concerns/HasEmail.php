<?php

namespace Gravatar\Concerns;

use Gravatar\Gravatar;

trait HasEmail
{
    /**
     * @var string The address email to be used.
     */
    protected $email;

    /**
     * Get or set the address email to be used.
     *
     * @param string|null $email
     * @return Gravatar|string|null
     */
    public function email(?string $email = null): Gravatar|string|null
    {
        if (null === $email) {
            return $this->getEmail();
        }

        return $this->setEmail($email);
    }

    /**
     * Get the address email to be used.
     *
     * @return int The current avatar size in use.
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the address email to be used.
     *
     * @param string $sEmail
     * @return Gravatar
     */
    public function setEmail(string $email): Gravatar
    {
        $this->email = $email;

        return $this;
    }
}
