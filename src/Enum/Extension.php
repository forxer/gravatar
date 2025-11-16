<?php

declare(strict_types=1);

namespace Gravatar\Enum;

/**
 * Gravatar image file extensions
 */
enum Extension: string
{
    case JPG = 'jpg';
    case JPEG = 'jpeg';
    case GIF = 'gif';
    case PNG = 'png';
    case WEBP = 'webp';

    /**
     * Get all valid extension values as strings
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Try to create an Extension from a string value
     *
     * @param  string  $value  The string value to convert.
     * @return self|null
     */
    public static function tryFromString(string $value): ?self
    {
        return self::tryFrom(strtolower($value));
    }
}
