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
    public ?string $format = null {
        set(ProfileFormat|string|null $value) {
            if ($value === null) {
                $this->format = null;

                return;
            }

            $stringValue = $value instanceof ProfileFormat ? $value->value : $value;
            $enum = ProfileFormat::tryFrom($stringValue);

            if ($enum === null) {
                throw new InvalidProfileFormatException(\sprintf(
                    'The format "%s" is not a valid one, profile format for Gravatar can be: "%s"',
                    $stringValue,
                    implode('", "', ProfileFormat::values())
                ));
            }

            $this->format = $enum->value;
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
        if (\func_num_args() === 0) {
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
        $this->format = ProfileFormat::JSON;

        return $this;
    }

    /**
     * Set the profile format to XML.
     */
    public function formatXml(): static
    {
        $this->format = ProfileFormat::XML;

        return $this;
    }

    /**
     * Set the profile format to PHP (serialized).
     */
    public function formatPhp(): static
    {
        $this->format = ProfileFormat::PHP;

        return $this;
    }

    /**
     * Set the profile format to VCF (vCard).
     */
    public function formatVcf(): static
    {
        $this->format = ProfileFormat::VCF;

        return $this;
    }

    /**
     * Set the profile format to QR code.
     */
    public function formatQr(): static
    {
        $this->format = ProfileFormat::QR;

        return $this;
    }
}
