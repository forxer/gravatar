<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

use Gravatar\Enum\ProfileFormat;
use Gravatar\Exception\InvalidProfileFormatException;

trait ProfileHasFormat
{
    /**
     * The format to append to the profile URL.
     */
    public private(set) ?string $format = null {
        set {
            if ($value !== null && ! \in_array($value, ProfileFormat::values())) {
                throw new InvalidProfileFormatException(\sprintf(
                    'The format "%s" is not a valid one, profile format for Gravatar can be: "%s"',
                    $value,
                    implode('", "', ProfileFormat::values())
                ));
            }
            $this->format = $value;
        }
    }

    /**
     * Get or set the profile format to use.
     *
     * @param  ProfileFormat|string|null  $format  The profile format to use.
     * @return $this|string|null
     */
    public function format(ProfileFormat|string|null $format = null): static|string|null
    {
        if ($format === null) {
            return $this->format;
        }

        return $this->setFormat($format);
    }

    /**
     * Alias for the "format" method.
     *
     * @param  ProfileFormat|string|null  $format  The profile format to use.
     * @return $this|string|null
     */
    public function f(ProfileFormat|string|null $format = null): static|string|null
    {
        return $this->format($format);
    }

    /**
     * Set the profile format to use.
     *
     * @param  ProfileFormat|string|null  $format  The profile format to use
     * @return $this The current Profile instance
     *
     * @throws InvalidProfileFormatException
     */
    public function setFormat(ProfileFormat|string|null $format = null): static
    {
        if ($format !== null) {
            $this->format = $format instanceof ProfileFormat ? $format->value : $format;
        }

        return $this;
    }
}
