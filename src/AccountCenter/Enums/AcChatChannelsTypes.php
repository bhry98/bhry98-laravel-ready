<?php

namespace Bhry98\AccountCenter\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;

enum AcChatChannelsTypes implements HasLabel, HasColor, HasIcon
{
    case Announcement;
    case Group;
    case OneToOne;
    case Notifications;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Announcement => __("Bhry98::ac.channel-types.announcement"),
            self::Group => __("Bhry98::ac.channel-types.group"),
            self::OneToOne => __("Bhry98::ac.channel-types.one-to-one"),
            self::Notifications => __("Bhry98::ac.channel-types.notifications"),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Announcement => Color::Sky,
            self::Group => Color::Orange,
            self::OneToOne => Color::Gray,
            self::Notifications => Color::Blue,
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Announcement => 'heroicon-o-megaphone',
            self::Group => 'heroicon-o-user-group',
            self::OneToOne => 'heroicon-o-user',
            self::Notifications => 'heroicon-o-bell',
        };
    }
}
