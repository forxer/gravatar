<?php

declare(strict_types=1);

namespace Gravatar\Enum;

/**
 * Gravatar default image types
 */
enum DefaultImage: string
{
    case INITIALS = 'initials';
    case COLOR = 'color';
    case NOT_FOUND = '404';
    case MYSTERY_PERSON = 'mp';
    case IDENTICON = 'identicon';
    case MONSTERID = 'monsterid';
    case WAVATAR = 'wavatar';
    case RETRO = 'retro';
    case ROBOHASH = 'robohash';
    case BLANK = 'blank';

    /**
     * Get all valid default image values as strings
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Try to create a DefaultImage from a string value
     *
     * @param  string  $value  The string value to convert.
     * @return self|null
     */
    public static function tryFromString(string $value): ?self
    {
        return self::tryFrom(strtolower($value));
    }
}
