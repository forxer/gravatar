<?php

declare(strict_types=1);

namespace Gravatar\Enum;

/**
 * Gravatar profile data formats
 */
enum ProfileFormat: string
{
    case JSON = 'json';
    case XML = 'xml';
    case PHP = 'php';
    case VCF = 'vcf';
    case QR = 'qr';

    /**
     * Get all valid format values as strings
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Try to create a ProfileFormat from a string value
     */
    public static function tryFromString(string $value): ?self
    {
        return self::tryFrom($value);
    }
}
