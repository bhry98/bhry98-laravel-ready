<?php

namespace Bhry98\Users\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum UsersResetPasswordTypes implements HasIcon, HasLabel, HasColor
{
    case PhoneOtp;
    case EmailOtp;

    public function getColor(): string|array|null
    {
        return "gray";
    }

    public function getIcon(): ?string
    {
        return "heroicon-o-user";
//        return match ($this) {
//            self::Administrator => 'eos-admin-o',
//            self::User => 'heroicon-o-user',
//            self::Customer => "carbon-customer-service",
//            self::Supplier => "carbon-scis-transparent-supply",
//            self::Other => "iconpark-other-o",
//        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PhoneOtp => __("Bhry98::enums.users-reset-password-types.phone-otp"),
            self::EmailOtp => __("Bhry98::enums.users-reset-password-types.email-otp"),
        };
    }

    public function getColumnName(): string
    {
        return match ($this) {
            self::UsernamePassword => "username",
            self::EmailPassword, self::EmailOtp => "email",
            self::NationalIdPassword => "national_id",
            self::PhonePassword, self::PhoneOtp => "phone_number",
        };
    }

    public static function isValid(string|UsersResetPasswordTypes $name): bool
    {
        if ($name instanceof UsersResetPasswordTypes) $name = $name->name;
        return in_array($name, array_column(self::cases(), 'name'), true);
    }

}
