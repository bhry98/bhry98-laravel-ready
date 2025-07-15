<?php

namespace Bhry98\Users\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum UsersChatChannelsTypes implements HasLabel, HasColor
{
    case Announcement;
    case Group;
    case OneToOne;
    case Notifications;
    public function getLabel(): ?string
    {
        return match ($this) {
            self::Announcement => __("enums.ac-chat-channels-type.announcement"),
            self::Group => __("enums.ac-chat-channels-type.group"),
            self::OneToOne => __("enums.ac-chat-channels-type.one-to-one"),
            self::Notifications => __("enums.ac-chat-channels-type.notifications"),
        };
    }

    public function getColor(): string|array|null
    {
        return "gray";
    }

    public function getIcon(): ?string
    {
        return "svgs-go";
        //        return match ($this) {
//            self::Go => "svgs-go",
//        };
    }
}
