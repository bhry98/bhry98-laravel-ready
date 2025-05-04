<?php

namespace Bhry98\LaravelUsersCore\Enums;

class  IdentityType
{
    public const User = 'user';
    public const AdminUser = 'adminUser';
    public const Customer = 'customer';

    static array $types = [
        self::User,
        self::Customer,
        self::AdminUser,
    ];

    public static function all(): array
    {
        return array_merge(static::$types);
    }

    public static function has(string $type): bool
    {
        return in_array($type, static::all(), true);
    }

    public static function add(string $value): void
    {
        if (!in_array($value, static::$types, true)) {
            static::$types[] = $value;
        }
    }
}
