<?php


use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Database\Schema\Blueprint;

if (!function_exists('bhry98_date_formatted')) {
    function bhry98_date_formatted($date = ''): array
    {
        if (!$date) return [];
        return [
            "iso" => $date,
            'format' => $date?->format(config("cf.date.format", "Y-m-d | H:i A")) ?? null,
            'format_time' => $date?->format(config("cf.date.format_time", "H:i A")) ?? null,
            'format_notification' => $date?->format(config("cf.date.format_notification", "Y M d")) ?? null,
            'format_without_time' => $date?->format(config("cf.date.format_without_time", "Y-m-d")) ?? null,
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
//
//if (!function_exists('bhry98_user_model')) {
//    function bhry98_user_model(): \Illuminate\Database\Eloquent\Model|Illuminate\Foundation\Auth\User
//    {
//        $class = config('cf_start.user_model', \Bhry98\Users\Models\UsersCoreModel::class);
//        return new $class;
//    }
//}
//

