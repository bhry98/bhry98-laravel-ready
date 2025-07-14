<?php

namespace Bhry98\Users\database\seeders;

use Bhry98\GP\Models\GPGroupsModel;
use Bhry98\GP\Models\GPGroupsUsersModel;
use Bhry98\Settings\Enums\EnumsTypes;
use Bhry98\Settings\Models\SettingsEnumsModel;
use Bhry98\Users\Enums\UsersAccountTypes;
use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Database\Seeder;

class UsersDefaultAdministrator extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        self::seedAdministratorUser();
    }

    function seedAdministratorUser(): void
    {
        $type = SettingsEnumsModel::query()
            ->where("type", "=", EnumsTypes::UsersType)
            ->where("default_name", "=", "Administrator")
            ->first();
        $user = UsersCoreModel::query()->updateOrCreate(
            [
                "username" => "administrator",
            ],
            [
                "type_id" => $type?->id,
                "account_type" => UsersAccountTypes::Administrator,
                "display_name" => "Super admin",
                "first_name" => "Super",
                "last_name" => "admin",
                "username" => "administrator",
                "phone_number" => "01097033958",
                "email" => "administrator@bhry98.local",
                "must_change_password" => false,
                "password" => "12345678",
            ]
        );
        if ($user) {
            // add default permissions
            GPGroupsModel::query()->get()->each(function ($group) use ($user) {
                GPGroupsUsersModel::query()->updateOrCreate(
                    [
                        'user_id' => $user->id,
                        "group_id" => $group->id
                    ],
                    [
                        'user_id' => $user->id,
                        "group_id" => $group->id
                    ]);
            });
        }
    }

}
