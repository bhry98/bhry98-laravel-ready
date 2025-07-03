<?php

namespace Bhry98\Bhry98LaravelReady\Services\system\rbac;

use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsPermissionsModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsUsersModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACPermissionsModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Services\BaseService;
use Bhry98\Bhry98LaravelReady\Services\users\UsersManagementService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class RBACLocalManagementService extends BaseService
{
    /**
     * @param string $code
     * @param array|null $relations
     * @param bool $withRelationsCount
     * @param bool $withTrash
     * @return RBACGroupsModel|null
     */
    public function getGroupByCode(string $code, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?RBACGroupsModel
    {
        $record = RBACGroupsModel::query()->where(['code' => $code]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
        if ($withRelationsCount) $record->withCount(['users', 'precessions']);
        return $record->first();
    }

    /**
     * @param int $id
     * @param array|null $relations
     * @param bool $withRelationsCount
     * @param bool $withTrash
     * @return RBACGroupsModel|null
     */
    public function getGroupById(int $id, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?RBACGroupsModel
    {
        $record = RBACGroupsModel::query()->where(['id' => $id]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
        if ($withRelationsCount) $record->withCount(['users', 'precessions']);
        return $record->first();
    }

    /**
     * @param string|null $searchStr
     * @param int $limit
     * @return array
     */
    public function getOptions(?string $searchStr = null, int $limit = 20): array
    {
        $list = RBACGroupsModel::query();
        if ($searchStr) $list->filterLocalized('name', $searchStr);
        $data = $list->get();
        return $data->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        })->toArray();
    }

    public function createNewGroup(array $data): ?RBACGroupsModel
    {
        $record = RBACGroupsModel::query()->create($data);
        !$record ? bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.created-field")) : bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.created-success"));
        bhry98_created_log(success: (bool)$record, message: "create new group policy", context: ["record" => $record->toArray()]);
        return $record;
    }

    public function manageGroupUser(int $groupId, int $userId, bool $add = true): bool
    {
        $group = self::getGroupById($groupId);
        if (!$group) return false;
        $user = (new UsersManagementService())->getById($userId, withTrash: true);
        if (!$user) return false;
        if ($add) {
            $update = RBACGroupsUsersModel::query()->updateOrCreate(["group_id" => $group->id, "user_id" => $user->id]);
            bhry98_created_log(success: (bool)$update, message: "join user (CODE : {$user->code}) to group (CODE : {$group->code})", context: ["user" => $user->toArray(), 'group' => $group->toArray()]);
        } else {
            if ($user->id != auth()->id()) {
                $update = RBACGroupsUsersModel::query()->where(["group_id" => $group->id, "user_id" => $user->id])->forceDelete();
                bhry98_force_delete_log(success: (bool)$update, message: "leave user (CODE : {$user->code}) from group (CODE : {$group->code})", context: ["user" => $user->toArray(), 'group' => $group->toArray()]);
            } else {
                $update = false;
            }
        }
        !$update ? bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.updated-field")) : bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.updated-success"));
        if ($update) Cache::forget("user_permissions_{$user->id}");
        return (bool)$update;
    }

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


//    public function managePermissionInGroup(string $groupCode, string $permissionCode, bool $add = true): bool
//    {
//        $groupRecord = self::groupDetails($groupCode);
//        $permission = RBACPermissionsModel::query()->where('code', $permissionCode)->first();
//        if ($groupRecord && $permission) {
//            $record = RBACGroupsPermissionsModel::query();
//            if ($add) {
//                $update = $record->updateOrCreate(["group_id" => $groupRecord->id, "permission_id" => $permission->id]);
//            } else {
//                $record->where(["group_id" => $groupRecord->id, "permission_id" => $permission->id])->forceDelete();
//                $update = !RBACGroupsUsersModel::query()->where(["group_id" => $groupRecord->id, "permission_id" => $permission->id])->exists();
//            };
//            bhry98_updated_log(
//                success: (bool)$update,
//                message: "CORE => RBACLocalManagementService@managePermissionInGroup",
//                context: ['group' => $groupRecord, "permission" => $permission, 'add' => $add]
//            );
//            return (bool)$update;
//        }
//        return false;
//    }

}
