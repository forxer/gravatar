<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

trait HasEmail
{
    /**
     * The address email to be used.
     */
    public private(set) ?string $email = null {
        set(?string $value) {
            $this->email = $value !== null ? strtolower(trim($value)) : null;
        }
    }

    /**
     * Get or set the address email to be used.
     *
     * @param  string|null  $email  The address email to use.
     * @return $this|string|null
     */
    public function email(?string $email = null): static|string|null
    {
        if (\func_num_args() === 0) {
            return $this->email;
        }

        $this->email = $email;

        return $this;
    }
}
