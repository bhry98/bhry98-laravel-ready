<?php

namespace Bhry98\Bhry98LaravelReady\Enums\system;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum SystemSettingsEnums implements HasColor, HasLabel, HasIcon
{
    case TermsAndConditions;

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::TermsAndConditions => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::TermsAndConditions => 'tabler-license',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::TermsAndConditions => __("Bhry98::enums.system-settings.terms-and-conditions"),
        };
    }
}
