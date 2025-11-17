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
            if ($value !== null) {
                // Convert ProfileFormat enum to string if needed
                $stringValue = $value instanceof ProfileFormat ? $value->value : $value;

                if (! \in_array($stringValue, ProfileFormat::values())) {
                    throw new InvalidProfileFormatException(\sprintf(
                        'The format "%s" is not a valid one, profile format for Gravatar can be: "%s"',
                        $stringValue,
                        implode('", "', ProfileFormat::values())
                    ));
                }
                $this->format = $stringValue;
            } else {
                $this->format = null;
            }
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

        $this->format = $format;

        return $this;
    }

    /**
     * Set the profile format to JSON.
     */
    public function formatJson(): static
    {
        return $this->format(ProfileFormat::JSON);
    }

    /**
     * Set the profile format to XML.
     */
    public function formatXml(): static
    {
        return $this->format(ProfileFormat::XML);
    }

    /**
     * Set the profile format to PHP (serialized).
     */
    public function formatPhp(): static
    {
        return $this->format(ProfileFormat::PHP);
    }

    /**
     * Set the profile format to VCF (vCard).
     */
    public function formatVcf(): static
    {
        return $this->format(ProfileFormat::VCF);
    }

    /**
     * Set the profile format to QR code.
     */
    public function formatQr(): static
    {
        return $this->format(ProfileFormat::QR);
    }
}
