<?php

use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;

if (!function_exists(function: 'bhry98_date_formatted')) {
    function bhry98_date_formatted($date = ''): array
    {
        return [
            "iso" => $date,
            'format' => $date?->format(config(key: "bhry98.date.format")) ?? null,
            'format_time' => $date?->format(config(key: "bhry98.date.format_time")) ?? null,
            'format_notification' => $date?->format(config(key: "bhry98.date.format_notification")) ?? null,
            'format_without_time' => $date?->format(config(key: "bhry98.date.format_without_time")) ?? null,
        ];
    }
}

if (!function_exists(function: 'bhry98_app_settings')) {
    function bhry98_app_settings($key, $default = null)
    {
        return config(key: "bhry98.app_settings.$key", default: $default);
    }
}
if (!function_exists(function: 'bhry98_core_settings')) {
    function bhry98_core_settings($key, $default = null)
    {
        return config(key: "bhry98.core_settings.$key", default: $default);
    }
}
if (!function_exists(function: 'bhry98_add_log')) {
    function bhry98_add_log($level, string $message, array $context = []): void
    {
        switch ($level) {
            case 'info':
                \Illuminate\Support\Facades\Log::info(message: $message, context: $context);
                break;
            case 'debug':
                \Illuminate\Support\Facades\Log::debug(message: $message, context: $context);
                break;
            case 'error':
                \Illuminate\Support\Facades\Log::error(message: $message, context: $context);
                break;
            case 'warning':
                \Illuminate\Support\Facades\Log::warning(message: $message, context: $context);
                break;
            case 'notice':
                \Illuminate\Support\Facades\Log::notice(message: $message, context: $context);
                break;
            case 'alert':
                \Illuminate\Support\Facades\Log::alert(message: $message, context: $context);
                break;
            case 'emergency':
                \Illuminate\Support\Facades\Log::emergency(message: $message, context: $context);
                break;
            default:
                \Illuminate\Support\Facades\Log::error(message: "Cant Find Log Level $level", context: $context);
                \Illuminate\Support\Facades\Log::info(message: $message, context: $context);
                break;
        }
    }
}
if (!function_exists(function: 'bhry98_created_log')) {
    function bhry98_created_log(bool $success, string $message = "", array $context = []): void
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1] ?? [];
        $class = $trace['class'] ?? 'N/A';
        $method = $trace['function'] ?? 'N/A';
        if ($success) {
            Log::info(message: "Created Successfully", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "context" => $context
            ]);
        } else {
            Log::error(message: "Created Field", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "context" => $context
            ]);
        }
    }
}
if (!function_exists(function: 'bhry98_updated_log')) {
    function bhry98_updated_log(bool $success, string $message = "", array $context = []): void
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1] ?? [];
        $class = $trace['class'] ?? 'N/A';
        $method = $trace['function'] ?? 'N/A';
        if ($success) {
            Log::info(message: "Updated Successfully", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "context" => $context
            ]);
        } else {
            Log::error(message: "Updated Field", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "context" => $context
            ]);
        }
    }
}
if (!function_exists(function: 'bhry98_deleted_log')) {
    function bhry98_deleted_log(bool $success, string $message = "", array $context = []): void
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1] ?? [];
        $class = $trace['class'] ?? 'N/A';
        $method = $trace['function'] ?? 'N/A';
        if ($success) {
            Log::info(message: "Deleted Successfully", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "context" => $context
            ]);
        } else {
            Log::error(message: "Deleted Field", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "context" => $context
            ]);
        }
    }
}
if (!function_exists(function: 'bhry98_force_delete_log')) {
    function bhry98_force_delete_log(bool $success, string $message = "", array $context = []): void
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1] ?? [];
        $class = $trace['class'] ?? 'N/A';
        $method = $trace['function'] ?? 'N/A';
        if ($success) {
            Log::info(message: "Force-Deleted Successfully", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "context" => $context
            ]);
        } else {
            Log::error(message: "Force-Deleted Field", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "context" => $context
            ]);
        }
    }
}
if (!function_exists(function: 'bhry98_common_database_columns')) {
    function bhry98_common_database_columns(Blueprint $table, bool $softDeletes = false, bool $userLog = false, bool $active = false): void
    {
        if ($active) $table->boolean(column: 'active')->default(value: true);
        if ($userLog) $table->foreignId(column: 'created_by')->nullable()->references(column: "id")->on(table: UsersCoreUsersModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
        if ($userLog) $table->foreignId(column: 'updated_by')->nullable()->references(column: "id")->on(table: UsersCoreUsersModel::TABLE_NAME)->cascadeOnUpdate()->cascadeOnDelete();
        $table->timestamp(column: 'created_at')->useCurrent();
        $table->timestamp(column: 'updated_at')->useCurrentOnUpdate();
        if ($softDeletes) $table->softDeletes();
    }
}
