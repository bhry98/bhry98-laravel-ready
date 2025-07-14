<?php

use Bhry98\Bhry98LaravelReady\Enums\system\SystemActionEnums;
use Illuminate\Support\Facades\Log;

if (!function_exists('bhry98_created_log')) {
    function bhry98_created_log(bool $success, string $message = "", array $context = []): void
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1] ?? [];
        $class = $trace['class'] ?? 'N/A';
        $method = $trace['function'] ?? 'N/A';
        if ($success) {
            Log::info($message ?? "Created Successfully", [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "context" => $context,
                "action" => SystemActionEnums::Creating->name,

            ]);
        } else {
            Log::error($message ?? "Created Field", [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "context" => $context,
                "action" => SystemActionEnums::Creating->name,
            ]);
        }
    }
}
if (!function_exists('bhry98_updated_log')) {
    function bhry98_updated_log(bool $success, string $message = "", array $context = []): void
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1] ?? [];
        $class = $trace['class'] ?? 'N/A';
        $method = $trace['function'] ?? 'N/A';
        if ($success) {
            Log::info($message ?? "Updated Successfully", [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "context" => $context,
                "action" => SystemActionEnums::Updating->name,
            ]);
        } else {
            Log::error($message ?? "Updated Field", [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "context" => $context,
                "action" => SystemActionEnums::Updating->name,
            ]);
        }
    }
}
if (!function_exists('bhry98_deleted_log')) {
    function bhry98_deleted_log(bool $success, string $message = "", array $context = []): void
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1] ?? [];
        $class = $trace['class'] ?? 'N/A';
        $method = $trace['function'] ?? 'N/A';
        if ($success) {
            Log::info($message ?? "Deleted Successfully", [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "action" => SystemActionEnums::Deleting->name,
                "context" => $context,
            ]);
        } else {
            Log::error($message ?? "Deleted Field", [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "action" => SystemActionEnums::Deleting->name,
                "context" => $context,
            ]);
        }
    }
}
if (!function_exists('bhry98_restored_log')) {
    function bhry98_restored_log(bool $success, string $message = "", array $context = []): void
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1] ?? [];
        $class = $trace['class'] ?? 'N/A';
        $method = $trace['function'] ?? 'N/A';
        if ($success) {
            Log::info($message ?? "Restored Successfully", [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "action" => SystemActionEnums::Restoring->name,
                "context" => $context
            ]);
        } else {
            Log::error($message ?? "Restored Field", [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "action" => SystemActionEnums::Restoring->name,
                "context" => $context
            ]);
        }
    }
}
if (!function_exists('bhry98_force_delete_log')) {
    function bhry98_force_delete_log(bool $success, string $message = "", array $context = []): void
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1] ?? [];
        $class = $trace['class'] ?? 'N/A';
        $method = $trace['function'] ?? 'N/A';
        if ($success) {
            Log::info($message ?? "Force-Deleted Successfully", [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "action" => SystemActionEnums::ForceDeleting->name,
                "context" => $context
            ]);
        } else {
            Log::error($message ?? "Force-Deleted Field", [
                "class" => $class,
                "method" => $method,
                "message" => $message,
                "action" => SystemActionEnums::ForceDeleting->name,
                "context" => $context
            ]);
        }
    }
}
if (!function_exists('bhry98_error_log')) {
    function bhry98_error_log(string $message = "", array $context = []): void
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1] ?? [];
        $class = $trace['class'] ?? 'N/A';
        $method = $trace['function'] ?? 'N/A';
        Log::error($message ?? "System Error", [
            "class" => $class,
            "method" => $method,
            "message" => $message,
            "action" => SystemActionEnums::Other->name,
            "context" => $context
        ]);
    }
}

