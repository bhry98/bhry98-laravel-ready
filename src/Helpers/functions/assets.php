<?php

use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCountriesModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Carbon\Carbon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;

if (!function_exists(function: 'bhry98_date_formatted')) {
    function bhry98_date_formatted($date = ''): array
    {
        return [
            "iso" => $date,
            'format' => $date?->format(config(key: "bhry98.app_settings.date.format", default: "Y-m-d | H:i A")) ?? null,
            'format_time' => $date?->format(config(key: "bhry98.app_settings.date.format_time", default: "H:i A")) ?? null,
            'format_notification' => $date?->format(config(key: "bhry98.app_settings.date.format_notification", default: "Y M d")) ?? null,
            'format_without_time' => $date?->format(config(key: "bhry98.app_settings.date.format_without_time", default: "Y-m-d")) ?? null,
        ];
    }
}
if (!function_exists(function: 'bhry98_app_settings')) {
    function bhry98_app_settings($key, $default = null)
    {
        return config(key: "bhry98.app_settings.$key", default: $default);
    }
}
if (!function_exists(function: 'bhry98_common_database_columns')) {
    function bhry98_common_database_columns(Blueprint $table, bool $softDeletes = false, bool $userLog = false, bool $active = false, bool $note = false): void
    {
        if ($active) $table->boolean(column: 'active')->default(value: true);
        if ($note) $table->longText('note')->nullable();
        if ($userLog) $table->foreignId(column: 'created_by')->nullable()->references(column: "id")->on(table: UsersCoreUsersModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
        if ($userLog) $table->foreignId(column: 'updated_by')->nullable()->references(column: "id")->on(table: UsersCoreUsersModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
        if ($userLog && $softDeletes) $table->foreignId(column: 'deleted_by')->nullable()->references(column: "id")->on(table: UsersCoreUsersModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
        $table->timestamp(column: 'created_at')->useCurrent();
        $table->timestamp(column: 'updated_at')->useCurrentOnUpdate();
        if ($softDeletes) $table->timestamp(column: 'deleted_at')->nullable();
    }
}
if (!function_exists(function: 'bhry98_get_setting')) {
    function bhry98_get_setting(string $key, ?string $default = null)
    {
        return \Rawilk\Settings\Facades\Settings::get(key: $key, default: $default);
    }
}
if (!function_exists(function: 'bhry98_set_setting')) {
    function bhry98_set_setting(string $key, string $value)
    {
        return \Rawilk\Settings\Facades\Settings::set(key: $key, value: $value);
    }
}
if (!function_exists(function: 'bhry98_filament_columns')) {
    function bhry98_filament_columns(bool $active = false, bool $by = false): array
    {
        if ($active) {
            $columns[] = IconColumn::make('active')
                ->label(__('Bhry98::global.active'))
                ->boolean()
                ->toggleable();
        }
        $columns[] = TextColumn::make('created_at')
            ->label(__('Bhry98::global.created-at'))
            ->getStateUsing(fn($record) => $record->created_at ? Carbon::parse($record->created_at)->format(config("bhry98.app_settings.date.format")) : "---")
            ->toggleable()
            ->toggledHiddenByDefault();
        $columns[] = TextColumn::make('updated_at')
            ->label(__('Bhry98::global.updated-at'))
            ->getStateUsing(fn($record) => $record->updated_at ? Carbon::parse($record->updated_at)->format(config("bhry98.app_settings.date.format")) : "---")
            ->toggleable()
            ->toggledHiddenByDefault();
        if ($by) {
            $columns[] = TextColumn::make('createdBy.email')
                ->label(__('Bhry98::global.created-by'))
                ->copyable()
                ->toggleable()
                ->default("---")
                ->toggledHiddenByDefault();
            $columns[] = TextColumn::make('updatedBy.email')
                ->label(__('Bhry98::global.updated-by'))
                ->copyable()
                ->toggleable()
                ->default("---")
                ->toggledHiddenByDefault();
        }
        return $columns;
    }
}

