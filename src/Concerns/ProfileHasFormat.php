<?php

declare(strict_types=1);

namespace Gravatar\Concerns;

use Gravatar\Exception\InvalidProfileFormatException;
use Gravatar\Profile;

trait ProfileHasFormat
{
    /**
     * @var string|null The format to append to the profile URL.
     */
    protected ?string $format = null;

    /**
     * Get or set the profile format to use.
     *
     * @param  string|null  $format  The profile format to use.
     */
    public function format(?string $format = null): Profile|string|null
    {
        if ($format === null) {
            return $this->getFormat();
        }

        return $this->setFormat($format);
    }

    /**
     * Alias for the "format" method.
     *
     * @return Profile|string|null
     */
    public function f(?string $format = null)
    {
        return $this->format($format);
    }

    /**
     * Get the currently set profile format.
     *
     * @return string|null The current profile format in use
     */
    public function getFormat(): ?string
    {
        return $this->format;
    }

    /**
     * Set the profile format to use.
     *
     * @param  string|null  $format  The profile format to use
     * @return Profile The current Profile instance
     *
     * @throws InvalidProfileFormatException
     */
    public function setFormat(?string $format = null): Profile
    {
        if ($format === null) {
            return $this;
        }

        if (! \in_array($format, $this->validFormats())) {
            $message = sprintf(
                'The format "%s" is not a valid one, profile format for Gravatar can be: %s',
                $format,
                implode(', ', $this->validFormats())
            );

            throw new InvalidProfileFormatException($message);
        }

        $this->format = $format;

        return $this;
    }

    /**
     * List of accepted format.
     */
    private function validFormats(): array
    {
        return ['json', 'xml', 'php', 'vcf', 'qr'];
    }
}
