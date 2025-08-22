<?php

namespace Bhry98\AccountCenter\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum AcChatMessagesTypes implements HasLabel, HasColor,HasIcon
{
    case Text;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Text => __("Bhry98::ac.message-types.text"),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Text => Color::Sky,
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Text => 'heroicon-o-document-text',
        };
    }
}
