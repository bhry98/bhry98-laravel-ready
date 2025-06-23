<?php

namespace Bhry98\Bhry98LaravelReady\Database\seeders\core;

use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsPermissionsModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACPermissionsModel;
use Illuminate\Database\Seeder;

class CoreRBACSeeder extends Seeder
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
        $groups = include __DIR__ . "$ds..$ds..{$ds}data{$ds}rbac{$ds}groups.php";
        if (config('bhry98.rbac.groups') && count(config('bhry98.rbac.groups')) > 0) {
            $groups = array_merge($groups, config('bhry98.rbac.groups', []));
        }
        foreach ($groups ?? [] as $key => $group) {
            $groupRecord = RBACGroupsModel::query()->updateOrCreate(
                [
                    "code" => (string)$key,
                ],
                [
                    "code" => (string)$key,
                    "default_name" => $group['locales_name']['en'],
                    "can_delete" => $group['can_delete'] ?? false,
                    "is_default" => $group['is_default'] ?? false,
                    "active" => $group['active'] ?? true,
                ]);
            if (array_key_exists(key: "default_permission", array: $group)) {
                if ($group["default_permission"] == "*") {
                    RBACPermissionsModel::query()->get()->each(function ($permission) use ($groupRecord) {
                        RBACGroupsPermissionsModel::query()->updateOrCreate([
                            "group_id" => $groupRecord->id,
                            "permission_id" => $permission->id,
                        ]);
                    });
                } elseif (is_array($group["default_permission"])) {
                    RBACPermissionsModel::query()->whereIn("code", $group["default_permission"])->get()->each(function ($permission) use ($groupRecord) {
                        RBACGroupsPermissionsModel::query()->updateOrCreate([
                            "group_id" => $groupRecord->id,
                            "permission_id" => $permission->id,
                        ]);
                    });
                }
            }
            foreach ($group['locales_name'] ?? [] as $local => $value) {
                $groupRecord->setLocalized(column: 'name', value: $value, locale: $local);
            }
        }
    }

    function permissionsSeeder(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $permissions = include __DIR__ . "$ds..$ds..{$ds}data{$ds}rbac{$ds}permissions{$ds}locations.php";
//        if (config('bhry98.rbac.permissions') && count(config('bhry98.rbac.permissions')) > 0) {
//            $permissions = array_merge($permissions, config('bhry98.rbac.permissions', []));
//        }
        foreach ($permissions ?? [] as $key => $permission) {
            $permissionRecord = RBACPermissionsModel::query()->updateOrCreate(
                [
                    "code" => (string)$key,
                ],
                [
                    "code" => (string)$key,
                    "default_name" => $permission['names']['en'],
                    "default_discretion" => $permission['discretion']['en'],
                ]);
            foreach ($permission['names'] ?? [] as $local => $value) {
                $permissionRecord->setLocalized(column: 'name', value: $value, locale: $local);
            }
            foreach ($permission['discretion'] ?? [] as $local => $value) {
                $permissionRecord->setLocalized(column: 'discretion', value: $value, locale: $local);
            }
        }
    }

}
