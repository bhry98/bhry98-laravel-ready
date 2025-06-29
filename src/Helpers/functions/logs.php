<?php

use Bhry98\Bhry98LaravelReady\Enums\system\SystemActionEnums;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCountriesModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Carbon\Carbon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;

//if (!function_exists(function: 'bhry98_add_log')) {
//    function bhry98_add_log($level, string $message, array $context = []): void
//    {
//        switch ($level) {
//            case 'info':
//                \Illuminate\Support\Facades\Log::info(message: $message, context: $context);
//                break;
//            case 'debug':
//                \Illuminate\Support\Facades\Log::debug(message: $message, context: $context);
//                break;
//            case 'error':
//                \Illuminate\Support\Facades\Log::error(message: $message, context: $context);
//                break;
//            case 'warning':
//                \Illuminate\Support\Facades\Log::warning(message: $message, context: $context);
//                break;
//            case 'notice':
//                \Illuminate\Support\Facades\Log::notice(message: $message, context: $context);
//                break;
//            case 'alert':
//                \Illuminate\Support\Facades\Log::alert(message: $message, context: $context);
//                break;
//            case 'emergency':
//                \Illuminate\Support\Facades\Log::emergency(message: $message, context: $context);
//                break;
//            default:
//                \Illuminate\Support\Facades\Log::error(message: "Cant Find Log Level $level", context: $context);
//                \Illuminate\Support\Facades\Log::info(message: $message, context: $context);
//                break;
//        }
//    }
//}
if (!function_exists(function: 'bhry98_created_log')) {
    function bhry98_created_log(bool $success, string $message = "", array $context = []): void
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1] ?? [];
        $class = $trace['class'] ?? 'N/A';
        $method = $trace['function'] ?? 'N/A';
        if ($success) {
            Log::info(message: $message ?? "Created Successfully", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "context" => $context,
                "action" => SystemActionEnums::Creating->name,

            ]);
        } else {
            Log::error(message: $message ?? "Created Field", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "context" => $context,
                "action" => SystemActionEnums::Creating->name,

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
            Log::info(message: $message ?? "Updated Successfully", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "context" => $context,
                "action" => SystemActionEnums::Updating->name,
            ]);
        } else {
            Log::error(message: $message ?? "Updated Field", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "context" => $context,
                "action" => SystemActionEnums::Updating->name,
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
            Log::info(message: $message ?? "Deleted Successfully", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "action" => SystemActionEnums::Deleting->name,
                "context" => $context,
            ]);
        } else {
            Log::error(message: $message ?? "Deleted Field", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "action" => SystemActionEnums::Deleting->name,
                "context" => $context,
            ]);
        }
    }
}
if (!function_exists(function: 'bhry98_restored_log')) {
    function bhry98_restored_log(bool $success, string $message = "", array $context = []): void
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1] ?? [];
        $class = $trace['class'] ?? 'N/A';
        $method = $trace['function'] ?? 'N/A';
        if ($success) {
            Log::info(message: $message ?? "Restored Successfully", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "action" => SystemActionEnums::Restoring->name,
                "context" => $context
            ]);
        } else {
            Log::error(message: $message ?? "Restored Field", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "action" => SystemActionEnums::Restoring->name,
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
            Log::info(message: $message ?? "Force-Deleted Successfully", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "action" => SystemActionEnums::ForceDeleting->name,
                "context" => $context
            ]);
        } else {
            Log::error(message: $message ?? "Force-Deleted Field", context: [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "action" => SystemActionEnums::ForceDeleting->name,
                "context" => $context
            ]);
        }
    }
}

