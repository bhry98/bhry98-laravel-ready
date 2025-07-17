<?php

namespace Bhry98\Users\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum UsersLoginTypes implements HasIcon, HasLabel, HasColor
{
    case UsernamePassword;
    case EmailPassword;
    case NationalIdPassword;
    case PhonePassword;
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
            self::UsernamePassword => __("Bhry98::enums.users-login-types.username-password"),
            self::EmailPassword => __("Bhry98::enums.users-login-types.email-password"),
            self::NationalIdPassword => __("Bhry98::enums.users-login-types.national-id-password-password"),
            self::PhonePassword => __("Bhry98::enums.users-login-types.phone-password"),
            self::PhoneOtp => __("Bhry98::enums.users-login-types.phone-otp"),
            self::EmailOtp => __("Bhry98::enums.users-login-types.email-otp"),
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

    public static function isValid(string|UsersLoginTypes $name): bool
    {
        if ($name instanceof UsersLoginTypes) $name = $name->name;
        return in_array($name, array_column(self::cases(), 'name'), true);
    }

}
