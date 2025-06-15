<?php

namespace Bhry98\Bhry98LaravelReady\Database\seeders\users;

use Bhry98\Bhry98LaravelReady\Enums\enums\EnumsCoreTypes;
use Bhry98\Bhry98LaravelReady\Models\enums\EnumsCoreModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsUsersModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Illuminate\Database\Seeder;

class DefaultAdministratorUser extends Seeder
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
        $type = EnumsCoreModel::query()
            ->where("type", "=", EnumsCoreTypes::UsersType)
            ->where("default_name", "=", "Administrator")
            ->first();
        $user = UsersCoreUsersModel::query()->updateOrCreate(
            [
                "username" => "administrator",
            ],
            [
                "type_id" => $type?->id,
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
            RBACGroupsModel::query()->get()->each(function ($group) use ($user) {
                RBACGroupsUsersModel::query()->updateOrCreate(
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
