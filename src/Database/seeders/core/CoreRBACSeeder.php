<?php

namespace Bhry98\Bhry98LaravelReady\Database\seeders\core;

use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsPermissionsModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACPermissionsModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

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
                    "default_name" => $group['names']['en'],
                    "default_description" => $group['descriptions']['en'],
                    "can_delete" => $group['can_delete'] ?? false,
                    "is_default" => $group['is_default'] ?? false,
                    "active" => $group['active'] ?? true,
                ]);
            if (array_key_exists("default_permission", $group)) {
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
                     include __DIR__ . "$ds..$ds..{$ds}data{$ds}rbac{$ds}permissions{$ds}locations.php",
                     include __DIR__ . "$ds..$ds..{$ds}data{$ds}rbac{$ds}permissions{$ds}users.php",
                     include __DIR__ . "$ds..$ds..{$ds}data{$ds}rbac{$ds}permissions{$ds}rbac.php",
                     config('bhry98.rbac.permissions', []),
                 ] as $set) {
            if (is_array($set) && count($set) > 0) {
                $permissions = $permissions->merge($set);
            }
        }
        $permissions?->each(function ($permission, $key) {
            $permissionRecord = RBACPermissionsModel::query()->updateOrCreate(
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
