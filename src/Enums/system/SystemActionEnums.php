<?php

namespace Bhry98\Bhry98LaravelReady\Enums\system;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum SystemActionEnums implements HasColor, HasLabel, HasIcon
{
    case Creating;
    case Updating;
    case Deleting;
    case Restoring;
    case ForceDeleting;
    case Other;


    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Creating => 'success',
            self::Updating => 'primary',
            self::Deleting, self::ForceDeleting => 'danger',
            self::Restoring => 'warning',
            self::Other => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Creating => 'heroicon-o-check-badge',
            self::Updating => 'heroicon-o-pencil-square',
            self::Deleting, self::ForceDeleting => 'heroicon-o-trash',
            self::Restoring => 'heroicon-o-arrow-path',
            self::Other => 'heroicon-o-exclamation-circle',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Creating => __("Bhry98::enums.system-action.creating"),
            self::Updating => __("Bhry98::enums.system-action.updating"),
            self::Deleting => __("Bhry98::enums.system-action.deleting"),
            self::ForceDeleting => __("Bhry98::enums.system-action.force-deleting"),
            self::Restoring => __("Bhry98::enums.system-action.restoring"),
            self::Other => __("Bhry98::enums.system-action.other"),
        };
    }
}
