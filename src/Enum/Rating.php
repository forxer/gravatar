<?php

declare(strict_types=1);

namespace Gravatar\Enum;

/**
 * Gravatar image rating levels
 */
enum Rating: string
{
    case G = 'g';
    case PG = 'pg';
    case R = 'r';
    case X = 'x';

    /**
     * Get all valid rating values as strings
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Try to create a Rating from a string value
     */
    public static function tryFromString(string $value): ?self
    {
        return self::tryFrom(strtolower($value));
    }
}
