<?php
return [
    "Administrators" => [
        "names" => [
            "ar" => "مجموعة المسؤوليين",
            "en" => "Administrators group",
        ],
        "default_permission" => "*",
        "can_delete" => false,
        "is_default" => false,
        "active" => true
    ],
    "Users" => [
        "names" => [
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
