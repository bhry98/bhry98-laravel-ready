<?php

namespace Bhry98\Users\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum UsersAccountTypes implements HasIcon, HasLabel, HasColor
{
    case Administrator;
    case User;
    case Customer;
    case Supplier;
    case Other;

    public function getColor(): string|array|null
    {
        return "gray";
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Administrator => 'eos-admin-o',
            self::User => 'heroicon-o-user',
            self::Customer => "carbon-customer-service",
            self::Supplier => "carbon-scis-transparent-supply",
            self::Other => "iconpark-other-o",
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Administrator => __("Bhry98::enums.users-account-types.admin"),
            self::User => __("Bhry98::enums.users-account-types.user"),
            self::Customer => __("Bhry98::enums.users-account-types.customer"),
            self::Supplier => __("Bhry98::enums.users-account-types.supplier"),
            self::Other => __("Bhry98::enums.users-account-types.other"),
        };
    }
}
