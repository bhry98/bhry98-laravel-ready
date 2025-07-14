<?php

namespace Bhry98\GP\database\seeders;

use Bhry98\GP\Models\GPGroupsModel;
use Bhry98\GP\Models\GPGroupsPermissionsModel;
use Bhry98\GP\Models\GPPermissionsModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class GPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        self::permissionsSeeder();
        self::groupsSeeder();
    }

    function groupsSeeder(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $groups = include bhry98_gp_path("database{$ds}data{$ds}groups.php");
        if (config('bhry98.gp.groups') && count(config('bhry98.gp.groups')) > 0) {
            $groups = array_merge($groups, config('bhry98.gp.groups', []));
        }
        foreach ($groups ?? [] as $key => $group) {
            $groupRecord = GPGroupsModel::query()->updateOrCreate(
                [
                    "code" => (string)$key,
                ],
                [
                    "code" => (string)$key,
                    "default_name" => $group['names']['en'],
                    "default_description" => $group['descriptions']['en'],
                    "can_delete" => $group['can_delete'] ?? false,
                    "is_default" => $group['is_default'] ?? false,
                    "active" => $group['active'] ?? true,
                ]);
            if (array_key_exists("default_permission", $group)) {
                if ($group["default_permission"] == "*") {
                    GPPermissionsModel::query()->get()->each(function ($permission) use ($groupRecord) {
                        GPGroupsPermissionsModel::query()->updateOrCreate([
                            "group_id" => $groupRecord->id,
                            "permission_id" => $permission->id,
                        ]);
                    });
                } elseif (is_array($group["default_permission"])) {
                    GPPermissionsModel::query()->whereIn("code", $group["default_permission"])->get()->each(function ($permission) use ($groupRecord) {
                        GPGroupsPermissionsModel::query()->updateOrCreate([
                            "group_id" => $groupRecord->id,
                            "permission_id" => $permission->id,
                        ]);
                    });
                }
            }
            foreach ($group['names'] ?? [] as $nameLocal => $nameValue) {
                $groupRecord->setLocalized(column: 'name', value: $nameValue, locale: $nameLocal);
            }
            foreach ($group['descriptions'] ?? [] as $descriptionLocal => $descriptionValue) {
                $groupRecord->setLocalized(column: 'description', value: $descriptionValue, locale: $descriptionLocal);
            }
        }
    }

    function permissionsSeeder(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $permissions = collect();
        foreach ([
                     include bhry98_gp_path("database{$ds}data{$ds}permissions{$ds}locations.php"),
                     include bhry98_gp_path("database{$ds}data{$ds}permissions{$ds}users.php"),
                     include bhry98_gp_path("database{$ds}data{$ds}permissions{$ds}gp.php"),
                     config('bhry98.gp.permissions', []),
                 ] as $set) {
            if (is_array($set) && count($set) > 0) {
                $permissions = $permissions->merge($set);
            }
        }
        $permissions?->each(function ($permission, $key) {
            $permissionRecord = GPPermissionsModel::query()->updateOrCreate(
                [
                    "code" => (string)$key,
                ],
                [
                    "code" => (string)$key,
                    "default_name" => $permission['names']['en'],
                    "default_description" => $permission['descriptions']['en'],
                ]);
            foreach ($permission['names'] ?? [] as $local => $value) {
                $permissionRecord->setLocalized(column: 'name', value: $value, locale: $local);
            }
            foreach ($permission['descriptions'] ?? [] as $local => $value) {
                $permissionRecord->setLocalized(column: 'description', value: $value, locale: $local);
            }
        });
    }

}
