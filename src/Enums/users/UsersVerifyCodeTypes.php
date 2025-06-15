<?php

namespace Bhry98\Bhry98LaravelReady\Enums\users;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum UsersVerifyCodeTypes implements HasIcon, HasLabel, HasColor
{
    case ResetPassword;
    case VerifyEmail;
    case VerifyPhone;
    case Other;

    public function getColor(): string|array|null
    {
        return "gray";
    }

    public function getIcon(): ?string
    {
        return "ionicon-male-outline";
//        return match ($this) {
//            self::Male => 'ionicon-male-outline',
//            self::Female => 'ionicon-female-outline',
//        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ResetPassword => __("Bhry98::enums.users-verify-code-types.reset-password"),
            self::VerifyEmail => __("Bhry98::enums.users-verify-code-types.verify-email"),
            self::VerifyPhone => __("Bhry98::enums.users-verify-code-types.verify-phone"),
            self::Other => __("Bhry98::enums.users-verify-code-types.other"),
        };
    }
}
