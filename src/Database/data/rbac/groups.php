<?php
return [
    "Administrators" => [
        "locales_name" => [
            "ar" => "مجموعة المسؤوليين",
            "en" => "Administrators group",
        ],
        "default_permission" => "*",
        "can_delete" => false,
        "is_default" => false,
        "active" => true
    ],
    "Users" => [
        "locales_name" => [
            "ar" => "مجموعة المستخدمين العاديين",
            "en" => "Normal Users group",
        ],
        "default_permission" => [
            "Core.MyAccount.ChangePassword",
            "Core.MyAccount.ChangeAvatar",
            "Core.MyAccount.ChangeTimezone",
        ],
        "can_delete" => false,
        "is_default" => true,
        "active" => true
    ],
];
