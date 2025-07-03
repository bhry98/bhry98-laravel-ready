<?php
return [
    "Administrators" => [
        "names" => [
            "ar" => "مجموعة المسؤوليين",
            "en" => "Administrators group",
        ],
        "descriptions" => [
            "ar" => "هذه المجموعة تحتوي على جميع الصلاحيات وتُستخدم لإدارة النظام بالكامل.",
            "en" => "This group has all permissions and is used to fully manage the system.",
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
        "descriptions" => [
            "ar" => "هذه المجموعة للمستخدمين العاديين بصلاحيات محدودة لإدارة حساباتهم الشخصية فقط.",
            "en" => "This group is for normal users with limited permissions to manage their own accounts only.",
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
