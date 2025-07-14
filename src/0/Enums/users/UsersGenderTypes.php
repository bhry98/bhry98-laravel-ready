<?php

namespace Bhry98\Bhry98LaravelReady\Enums\users;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum UsersGenderTypes implements HasIcon, HasLabel, HasColor
{
    case Male;
    case Female;

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Male => 'sky',
            self::Female => 'pink',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Male => 'ionicon-male-outline',
            self::Female => 'ionicon-female-outline',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Male => __("Bhry98::enums.users-gender-types.male"),
            self::Female => __("Bhry98::enums.users-gender-types.female"),
        };
    }
}
