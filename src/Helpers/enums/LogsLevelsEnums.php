<?php

namespace Bhry98\Helpers\enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum LogsLevelsEnums implements HasColor, HasLabel, HasIcon
{
    case ERROR;
    case INFO;
    case WARNING;
    case DEBUG;

    case Other;


    public function getColor(): string|array|null
    {
        return match ($this) {
            self::INFO => 'primary',
            self::ERROR => 'danger',
            self::WARNING => 'warning',
            self::Other,self::DEBUG => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::ERROR => 'heroicon-o-exclamation-circle',
            self::WARNING => 'heroicon-o-exclamation-triangle',
            self::INFO => 'heroicon-o-information-circle',
            self::DEBUG => 'heroicon-o-bug-ant',
            self::Other => 'heroicon-o-table-cells',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {

            self::ERROR => __("Bhry98::enums.logs-levels.error"),
            self::INFO => __("Bhry98::enums.logs-levels.info"),
            self::WARNING => __("Bhry98::enums.logs-levels.warning"),
            self::DEBUG => __("Bhry98::enums.logs-levels.debug"),
            self::Other => __("Bhry98::enums.logs-levels.other"),
        };
    }
}
