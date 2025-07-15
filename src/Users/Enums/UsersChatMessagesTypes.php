<?php

namespace Bhry98\Users\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum UsersChatMessagesTypes implements HasLabel, HasColor
{
    case Text;
    public function getLabel(): ?string
    {
        return match ($this) {
            self::Text => __("enums.ac-chat-messages-type.text"),
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
