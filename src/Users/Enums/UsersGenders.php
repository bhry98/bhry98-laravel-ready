<?php

namespace Bhry98\Users\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum UsersGenders implements HasIcon, HasLabel, HasColor
{
    case Male;
    case Female;
    case Hidden;

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Male => Color::Blue,
            self::Female => Color::Pink,
            self::Hidden => Color::Gray,
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Male => 'heroicon-o-user-circle',
            self::Female => 'heroicon-o-user-group',
            self::Hidden => 'heroicon-o-eye-slash',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Male => __('Bhry98::users.genders.male'),
            self::Female => __('Bhry98::users.genders.female'),
            self::Hidden => __('Bhry98::users.genders.hidden'),
        };
    }
}
