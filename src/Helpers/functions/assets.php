<?php


use Bhry98\Users\Models\UsersCoreModel;
use Carbon\Carbon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Schema\Blueprint;

if (!function_exists('bhry98_date_formatted')) {

    /**
     * Format a given date using multiple formats.
     *
     * @param string|Carbon|null $date
     * @return array<string, string|null>
     */
    function bhry98_date_formatted(Carbon|string|null $date = null): array
    {
        if (empty($date)) {
            return [];
        }

        // Ensure $date is an instance of Carbon
        if (!$date instanceof Carbon) {
            try {
                $date = Carbon::parse($date);
            } catch (\Throwable $e) {
                return [];
            }
        }

        return [
            'iso' => $date->toIso8601String(),
            'format' => $date->format(config('cf.date.format', 'Y-m-d | h:i A')),
            'format_time' => $date->format(config('cf.date.format_time', 'h:i A')),
            'format_notification' => $date->format(config('cf.date.format_notification', 'Y M d')),
            'format_without_time' => $date->format(config('cf.date.format_without_time', 'Y-m-d')),
            'since' => $date->diffForHumans(),
        ];
    }
}
if (!function_exists('bhry98_common_database_columns')) {
    function bhry98_common_database_columns(Blueprint $table, bool $softDeletes = true, bool $userLog = true, bool $active = true, bool $note = true): void
    {
        if ($active) $table->boolean('active')->default(true);
        if ($note) $table->longText('note')->nullable();
        if ($userLog) $table->foreignId('created_by')->nullable()->references("id")->on((new UsersCoreModel)->getTable())->cascadeOnUpdate()->nullOnDelete();
        if ($userLog) $table->foreignId('updated_by')->nullable()->references("id")->on((new UsersCoreModel)->getTable())->cascadeOnUpdate()->nullOnDelete();
        if ($userLog && $softDeletes) $table->foreignId('deleted_by')->nullable()->references("id")->on((new UsersCoreModel)->getTable())->cascadeOnUpdate()->nullOnDelete();
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrentOnUpdate();
        if ($softDeletes) $table->timestamp('deleted_at')->nullable();
    }
}

if (!function_exists('bhry98_common_filament_columns')) {
    function bhry98_common_filament_columns(bool $withCreated = true, bool $withUpdated = true, bool $withDeleted = true, bool $withActive = true, bool $activeButtonDisabled = false): array
    {
        if ($withActive) $columns[] = ToggleColumn::make('active')->label(__("Bhry98::global.active"))->disabled($activeButtonDisabled);
        if ($withCreated) $columns[] = TextColumn::make('created_at')->date(config("bhry98.date.format"))->toggleable()->toggledHiddenByDefault()->label(__("Bhry98::global.created-at"));
        if ($withCreated) $columns[] = TextColumn::make('createdBy.email')->default("---")->toggleable()->toggledHiddenByDefault()->label(__("Bhry98::global.created-by"));
        if ($withUpdated) $columns[] = TextColumn::make('updated_at')->date(config("bhry98.date.format"))->toggleable()->toggledHiddenByDefault()->label(__("Bhry98::global.updated-at"));
        if ($withUpdated) $columns[] = TextColumn::make('updatedBy.email')->default("---")->toggleable()->toggledHiddenByDefault()->label(__("Bhry98::global.updated-by"));
        if ($withDeleted) $columns[] = TextColumn::make('deleted_at')->date(config("bhry98.date.format"))->toggleable()->toggledHiddenByDefault()->label(__("Bhry98::global.deleted-at"));
        if ($withDeleted) $columns[] = TextColumn::make('deletedBy.email')->default("---")->toggleable()->toggledHiddenByDefault()->label(__("Bhry98::global.deleted-by"));
        return $columns ?? [];
    }
}


if (!function_exists('bhry98_app_setting_get')) {
    function bhry98_app_setting_get(string $key, ?string $default = null)
    {
        return \Rawilk\Settings\Facades\Settings::get($key, $default);
    }
}
if (!function_exists('bhry98_app_setting_set')) {
    function bhry98_app_setting_set(string $key, string $value)
    {
        return \Rawilk\Settings\Facades\Settings::set($key, $value);
    }
}
