<?php

namespace Bhry98\Settings\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum EnumsTypes implements HasColor, HasLabel, HasIcon
{
    case UsersType;
    case UsersGender;

    public function getColor(): string|array|null
    {
        return "primary";
//        return match ($this) {
////            self::Creating => 'success',
//            self::INFO => '',
//            self::ERROR => 'danger',
//            self::WARNING => 'warning',
//            self::Other, self::DEBUG => 'gray',
//        };
    }

    public function getIcon(): ?string
    {
        return "heroicon-o-information-circle";
//        return match ($this) {
//            self::ERROR => 'heroicon-o-exclamation-circle',
//            self::WARNING => 'heroicon-o-exclamation-triangle',
//            self::INFO => 'heroicon-o-information-circle',
//            self::DEBUG => 'heroicon-o-bug-ant',
//            self::Other => 'heroicon-o-table-cells',
//        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::UsersGender => __("Bhry98::enums.enums-type.user-gender"),
            self::UsersType => __("Bhry98::enums.enums-type.user-type"),
        };
    }
}
