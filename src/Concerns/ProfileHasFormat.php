<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

use Gravatar\Exception\InvalidProfileFormatException;

trait ProfileHasFormat
{
    private const VALID_FORMATS = ['json', 'xml', 'php', 'vcf', 'qr'];

    /**
     * The format to append to the profile URL.
     */
    public private(set) ?string $format = null {
        set {
            if ($value !== null && ! \in_array($value, self::VALID_FORMATS)) {
                throw new InvalidProfileFormatException(\sprintf(
                    'The format "%s" is not a valid one, profile format for Gravatar can be: "%s"',
                    $value,
                    implode('", "', self::VALID_FORMATS)
                ));
            }
            $this->format = $value;
        }
    }

    /**
     * Get or set the profile format to use.
     *
     * @param  string|null  $format  The profile format to use.
     * @return $this|string|null
     */
    public function format(?string $format = null): static|string|null
    {
        if ($format === null) {
            return $this->format;
        }

        return $this->setFormat($format);
    }

    /**
     * Alias for the "format" method.
     *
     * @return $this|string|null
     */
    public function f(?string $format = null): static|string|null
    {
        return $this->format($format);
    }

    /**
     * Set the profile format to use.
     *
     * @param  string|null  $format  The profile format to use
     * @return $this The current Profile instance
     *
     * @throws InvalidProfileFormatException
     */
    public function setFormat(?string $format = null): static
    {
        if ($format !== null) {
            $this->format = $format;
        }

        return $this;
    }
}
