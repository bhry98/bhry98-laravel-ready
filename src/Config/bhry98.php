<?php
return [
    "app_settings" => [
        // database settings
        "db_host" => env(key: "DB_HOST"),
        "db_port" => env(key: "DB_PORT", default: "3306"),
        "db_name" => env(key: "DB_DATABASE"),
        "db_username" => env(key: "DB_USERNAME"),
        "db_password" => env(key: "DB_PASSWORD"),
        // session settings
        "session_connection" => env(key: "DB_CONNECTION"),
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
            // "is_active" => true
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
];