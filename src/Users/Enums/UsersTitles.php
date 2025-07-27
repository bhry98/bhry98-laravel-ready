<?php

namespace Bhry98\Users\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum UsersTitles implements HasIcon, HasLabel, HasColor
{
    case Mr;
    case Mrs;
    case Ms;
    case Dr;
    case Eng;
    case Prof;
    case Other;

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Mr,self::Eng => Color::Blue,
            self::Mrs, self::Ms => Color::Pink,
            self::Dr, self::Prof => Color::Indigo,
            self::Other => Color::Gray,
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Mr => 'heroicon-o-user',
            self::Mrs => 'heroicon-o-user-group',
            self::Ms => 'heroicon-o-user-group',
            self::Dr => 'heroicon-o-academic-cap',
            self::Prof => 'heroicon-o-academic-cap',
            self::Eng => 'heroicon-o-academic-cap',
            self::Other => 'heroicon-o-question-mark-circle',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Mr => __('Bhry98::users.titles.mr'),
            self::Mrs => __('Bhry98::users.titles.mrs'),
            self::Ms => __('Bhry98::users.titles.ms'),
            self::Dr => __('Bhry98::users.titles.dr'),
            self::Prof => __('Bhry98::users.titles.prof'),
            self::Eng => __('Bhry98::users.titles.eng'),
            self::Other => __('Bhry98::users.titles.other'),
        };
    }
}
