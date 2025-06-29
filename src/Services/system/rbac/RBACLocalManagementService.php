<?php

namespace Bhry98\Bhry98LaravelReady\Services\system\rbac;

use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsPermissionsModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsUsersModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACPermissionsModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Services\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;

class RBACLocalManagementService extends BaseService
{
    public function allPermissions(int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null): LengthAwarePaginator
    {
        $data = RBACPermissionsModel::query()->orderBy('id', 'desc');
        if (!empty($filters)) {
            self::applyFilters($data, $filters, RBACPermissionsModel::class);
            $pageNumber = 0;
        }
        if ($data && $relations) {
            $data->with($relations);
        }
        return $data->withCount(['groups'])
            ->paginate(
                perPage: $perPage,
                page: $pageNumber,
            );
    }

    public function allGroups(int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null): LengthAwarePaginator
    {
        $data = RBACGroupsModel::query()->orderBy('id', 'desc');
        if (!empty($filters)) {
            self::applyFilters($data, $filters, RBACGroupsModel::class);
            $pageNumber = 0;
        }
        if ($data && $relations) {
            $data->with($relations);
        }
        return $data->withCount(['users', 'permissions'])
            ->paginate(
                perPage: $perPage,
                page: $pageNumber,
            );
    }

    public function allUsersFromGroup(string $groupCode, int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null): LengthAwarePaginator
    {
        $groupRecord = self::groupDetails($groupCode);
        $data = UsersCoreUsersModel::query()
            ->whereHas('groups', function ($query) use ($groupRecord) {
                $query->where('group_id', $groupRecord?->id);
            })
            ->orderBy('id', 'desc');
        if (!empty($filters)) {
            self::applyFilters($data, $filters, UsersCoreUsersModel::class);
            $pageNumber = 0;
        }
        if ($data && $relations) {
            $data->with($relations);
        }
        return $data->withCount(['groups'])
            ->paginate(
                perPage: $perPage,
                page: $pageNumber,
            );
    }

    public function groupDetails(string $groupCode, array|null $relations = null): ?RBACGroupsModel
    {
        $data = RBACGroupsModel::query()->where('code', $groupCode);
        if ($data && $relations) {
            $data->with($relations);
        }
        return $data->withCount(['users', 'permissions'])->first();
    }

    public function manageUserInGroup(string $groupCode, string $userIdentityCode, bool $add = true): bool
    {
        $groupRecord = self::groupDetails($groupCode);
        $user = UsersCoreUsersModel::query()->where('identity_code', $userIdentityCode)->first();
        if ($groupRecord && $user) {
            $record = RBACGroupsUsersModel::query();
            if ($add) {
                $update = $record->updateOrCreate(["group_id" => $groupRecord->id, "user_id" => $user->id]);
            } else {
                $record->where(["group_id" => $groupRecord->id, "user_id" => $user->id])->forceDelete();
                $update = !RBACGroupsUsersModel::query()->where(["group_id" => $groupRecord->id, "user_id" => $user->id])->exists();
            };
            bhry98_updated_log(
                success: (bool)$update,
                message: "CORE => RBACLocalManagementService@manageUserInGroup",
                context: ['group' => $groupRecord, "user" => $user, 'add' => $add]
            );
            return (bool)$update;
        }
        return false;
    }
    public function managePermissionInGroup(string $groupCode, string $permissionCode, bool $add = true): bool
    {
        $groupRecord = self::groupDetails($groupCode);
        $permission = RBACPermissionsModel::query()->where('code', $permissionCode)->first();
        if ($groupRecord && $permission) {
            $record = RBACGroupsPermissionsModel::query();
            if ($add) {
                $update = $record->updateOrCreate(["group_id" => $groupRecord->id, "permission_id" => $permission->id]);
            } else {
                $record->where(["group_id" => $groupRecord->id, "permission_id" => $permission->id])->forceDelete();
                $update = !RBACGroupsUsersModel::query()->where(["group_id" => $groupRecord->id, "permission_id" => $permission->id])->exists();
            };
            bhry98_updated_log(
                success: (bool)$update,
                message: "CORE => RBACLocalManagementService@managePermissionInGroup",
                context: ['group' => $groupRecord, "permission" => $permission, 'add' => $add]
            );
            return (bool)$update;
        }
        return false;
    }

}
