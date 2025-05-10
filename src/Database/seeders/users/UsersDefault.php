<?php

namespace Bhry98\Bhry98LaravelReady\Database\seeders\users;

use Bhry98\Bhry98LaravelReady\Enums\enums\EnumsCoreTypes;
use Bhry98\Bhry98LaravelReady\Enums\Modules;
use Bhry98\Bhry98LaravelReady\Models\enums\EnumsCoreModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsUsersModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Illuminate\Database\Seeder;

class UsersDefault extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::usersArray() ?? [] as $user) {
            $timezone = EnumsCoreModel::query()
                ->where("type", "=", EnumsCoreTypes::Timezone)
                ->where("module", "=", Modules::Core)
                ->where("default_name", "=", "Africa/Cairo")
                ->first();
            $type = EnumsCoreModel::query()
                ->where("type", "=", EnumsCoreTypes::UsersType)
                ->where("module", "=", Modules::Core)
                ->where("default_name", "=", "Normal User")
                ->first();
            $user = UsersCoreUsersModel::query()->updateOrCreate(
                [
                    "username" => $user['username'],
                    "email" => $user['email'],
                ],
                [
//                    "type_id" => $type?->id,
//                    "timezone_id" => $timezone?->id,
//                    "gender_id" => $employee['gender'] == "1" ? 3 : 4,
//                    "display_name" => $employee['display_name']['en'] ?? ($firstName ?? $employee['username']),
//                    "first_name" => $firstName,
//                    "last_name" => Str::afterLast($employee['name']['en'], " "),
//                    "national_id" => $employee['national_id'],
//                    "username" => $employee['username'] ?? $employee['code'],
//                    "email" => $employee['email'] ?? $employee['code'] . "@valleysoft-eg.local",
//                    "password" => $employee["password"],
//                    "is_active" => $employee["active"],
                ]);
            if ($user) {
                // add default permissions
                RBACGroupsModel::query()->where('is_default', true)->get()->each(function ($group) use ($user) {
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

    function usersArray(): array
    {
        return [];

    }

}
