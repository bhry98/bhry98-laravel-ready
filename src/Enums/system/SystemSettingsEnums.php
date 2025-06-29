<?php

namespace Bhry98\Bhry98LaravelReady\Enums\system;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum SystemSettingsEnums implements HasColor, HasLabel, HasIcon
{
    case TermsAndConditions;
    case defaultInputPhoneCountry;

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::TermsAndConditions => 'gray',
            self::defaultInputPhoneCountry => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::TermsAndConditions => 'heroicon-o-document-text',
            self::defaultInputPhoneCountry => 'heroicon-o-flag',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::TermsAndConditions => __("Bhry98::enums.system-settings.terms-and-conditions"),
            self::defaultInputPhoneCountry => __("Bhry98::enums.system-settings.default-input-phone-country"),
        };
    }
}
