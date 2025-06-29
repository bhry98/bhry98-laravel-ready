<?php

use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;

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
        "users_model" => UsersCoreUsersModel::class,
        "locales" => ["ar", "en"],
        // validation settings
        "validations" => [
            "users_require_username" => "required",
            "users_require_phone_number" => "nullable",
            "users_require_email" => "nullable",
            "users_require_national_id" => "nullable",
        ],

    ],
    "rbac" => [
        "default_groups" => ["Users"],
        "groups" => [
            // "GROUP UNIQUE NAME" => [
            // "locales_name" => [
            //   "ar" => "اسم بالعربية",
            //   "en" => "name in english",
            //    # add any locale you want here
            //  ],
            // "default_permission" => "*" or ["permission_code_1", "permission_code_2"],
            // "can_delete" => false,
            // "is_default" => false,
            // "active" => true
            //],
        ],
        "permissions" => [
            //  "SERVICE.ACTION NAME" => [
            //      "locales" => [
            //       "ar" => "اسم الصلاحية بالعربية",
            //       "en" => "permissions arabic name ",
            //   ],
            //],

        ],

    ],
    "filament" => [
        "pagination" => [
            "per_page" => [10, 30, 50],
        ],
        "users-pages" => [],
    ],
    "date" => [
        "format" => "Y-m-d | h:i A",
        "format_time" => "h:i A",
        "format_notification" => "Y M d",
        "format_without_time" => "Y-m-d",
    ],
];