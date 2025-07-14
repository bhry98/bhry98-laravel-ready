<?php

use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreModel;

return [
    "app_settings" => [
        // database settings
        "db_host" => env(key: "DB_HOST"),
        "db_port" => env(key: "DB_PORT", default: "3306"),
        "db_name" => env(key: "DB_DATABASE"),
        "db_username" => env(key: "DB_USERNAME"),
        "db_password" => env(key: "DB_PASSWORD"),
        // auth settings
        "login_via" => "phone_number",// username, email, phone_number by default username
        "users_model" => UsersCoreModel::class,
        "locales" => ["ar", "en"],
        // validation settings
        "validations" => [
            "users_require_username" => "required",
            "users_require_phone_number" => "nullable",
            "users_require_email" => "nullable",
            "users_require_national_id" => "nullable",
        ],

    ],

    "filament" => [
        "pagination" => [
            "per_page" => [10, 30, 50],
        ],
        "panel-name" => "bhry98",
        "default-panel" => true,
        "multi-panels" => false,
        "users-pages" => [],
    ],
    "date" => [
        "format" => "Y-m-d | h:i A",
        "format_time" => "h:i A",
        "format_notification" => "Y M d",
        "format_without_time" => "Y-m-d",
    ],
];
