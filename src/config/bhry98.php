<?php

use Filament\Support\Colors\Color;

return [
    'user_model' => \Bhry98\Users\Models\UsersCoreModel::class,
    'otp_attempt_limit' => (int)env("B_OTP_ATTEMPT_LIMIT", 5),
    'bot_name' => env("B_BOT_NAME", env("APP_NAME", "B BOT")),
    'brand_logo' => env("B_BRAND_LOGO"),
    'brand_logo_size' => "40px",
    "registration" => [
        'require_username' => false,
        'require_email' => true,
        'require_phone_number' => true,
        'require_national_id' => false,
        'must_verify_phone' => true,
        'must_verify_email' => false,
        'auto_login_after_register' => true,
    ],
    'enums_type_cast' => \Bhry98\Settings\Enums\EnumsTypes::class,
    'login_type' => \Bhry98\Users\Enums\UsersLoginTypes::EmailPassword,
    'reset_password_via' => \Bhry98\Users\Enums\UsersResetPasswordTypes::EmailOtp,
    "db_prefix" => env("BHRY98_DB_PREFIX") ? trim(env("BHRY98_DB_PREFIX"), "_") . "_" : null,
    "date" => [
        "format" => "Y-m-d | h:i A",
        "format_time" => "h:i A",
        "format_notification" => "Y M d",
        "format_without_time" => "Y-m-d",
    ],
    "gp" => [
        "default_groups" => ["Users"],
        "groups" => [
            /**
             *  "GROUP-UNIQUE-NAME" => [
             *  "names" => [
             *    "ar" => "اسم بالعربية",
             *    "en" => "name in english",
             *     // add any locale you want here
             *   ],
             *  "descriptions" => [
             *    "ar" => "اسم بالعربية",
             *    "en" => "name in english",
             *     // add any locale you want here
             *   ],
             *  "default_permission" => "*" or ["permission_code_1", "permission_code_2"],
             *  "can_delete" => false,
             *  "is_default" => false,
             *  "active" => true
             * ],
             */
        ],
        "permissions" => [
            /**
             * "PERMISSION-UNIQUE-NAME" => [
             *       "names" => [
             *        "ar" => "اسم الصلاحية بالعربية",
             *        "en" => "permissions arabic name ",
             *    ],
             *       "descriptions" => [
             *        "ar" => "اسم الصلاحية بالعربية",
             *        "en" => "permissions arabic name ",
             *    ],
             * ],
             */
        ],
    ],
    "filament" => [
        "account-center" => [
            "default" => true,
            "id" => "account-center",
            "path" => "AccountCenter",
            "colors" => [
                'primary' => Color::Sky,
            ],
        ],
        "users" => [
            "id" => "users",
            "path" => "Users",
            "colors" => [
                'primary' => Color::Sky,
            ],
        ],
        "locations" => [
            "id" => "locations",
            "path" => "Locations",
            "colors" => [
                'primary' => Color::Sky,
            ],
        ],
    ],
];