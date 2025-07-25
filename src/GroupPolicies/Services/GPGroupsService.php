<?php

namespace Bhry98\GP\Services;

use Bhry98\GP\Models\GPGroupsModel;
use Bhry98\GP\Models\GPGroupsPermissionsModel;
use Bhry98\Helpers\extends\BaseService;
use Bhry98\Users\Models\UsersCoreModel;
use Bhry98\GP\Models\GPGroupsUsersModel;
use Bhry98\Users\Services\UsersManagementService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class GPGroupsService extends BaseService
{

    public GPGroupsModel $groupsModel;

    public function __construct()
    {
        $this->groupsModel = new GPGroupsModel();
    }

    public function getByCode(string $code, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?GPGroupsModel
    {
        $record = $this->groupsModel->query()->where(['code' => $code]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
        if ($withRelationsCount) $record->withCount(['users', 'precessions']);
        return $record->first();
    }

    public function getById(int $id, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?GPGroupsModel
    {
        $record = $this->groupsModel->query()->where(['id' => $id]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
        if ($withRelationsCount) $record->withCount(['users', 'precessions']);
        return $record->first();
    }

    public function allGroups(int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null): LengthAwarePaginator
    {
        $query = $this->groupsModel->query()->orderByDesc('id');
        if (!empty($filters)) {
            self::applyFilters($query, $filters, $this->groupsModel::class);
            $pageNumber = 0;
        }
        if ($relations) {
            $query->with($relations);
        }
        return $query->withCount(['users', 'permissions'])->paginate(
            perPage: $perPage,
            page: $pageNumber,
        );
    }

    public function createGroup(array $data): bool
    {
        $data = $this->handleModelData($data);
        $record = $this->groupsModel->query()->create(collect($data)->except('names', 'descriptions')->toArray());
        if ($record) $this->handleLocalizedData($record, $data);
        bhry98_created_log((bool)$record, "create new group policy", ["record" => $record->toArray()]);
        $this->notifyFilament((bool)$record, "created");
        return (bool)$record;
    }

    public function updateGroup(int $id, array $data): bool
    {
        $record = $this->getById($id);
        if (!$record) return false;
        $data = $this->handleModelData($data);
        $updated = $record->update(collect($data)->except('names', 'descriptions')->toArray());
        if ($updated) $this->handleLocalizedData($record->refresh(), $data);
        bhry98_updated_log((bool)$updated, "update group policy", ["record" => $record->toArray(), 'data' => $data]);
        $this->notifyFilament((bool)$updated, "updated");
        return (bool)$updated;
    }

    public function deleteGroup(int $id, bool $force = false): bool
    {
        $record = $this->getById($id, withTrash: true);
        if (!$record) return false;
        $recordClone = $record->replicate();
        if ($force) {
            $deleted = $record->forceDelete();
            bhry98_force_delete_log((bool)$deleted, "force delete group policy", ["record" => $recordClone->toArray()]);
            $this->notifyFilament((bool)$deleted, "force-deleted");
        } else {
            $deleted = $record->delete();
            bhry98_deleted_log((bool)$deleted, "delete group policy", ["record" => $recordClone->toArray()]);
            $this->notifyFilament((bool)$deleted, "deleted");
        }
        return (bool)$deleted;
    }

    public function restoreGroup(int $id): bool
    {
        $record = $this->getById($id, withTrash: true);
        if (!$record) return false;
        $restored = $record->restore();
        bhry98_restored_log((bool)$restored, "restored group policy", ["record" => $record->toArray()]);
        $this->notifyFilament((bool)$restored, "restored");
        return (bool)$restored;
    }

    public function manageUserInGroup(int $groupId, int $userId, bool $add = true): bool
    {
        $group = $this->getById($groupId);
        if (!$group) return false;
        $user = (new UsersManagementService())->getById($userId);
        if (!$user) return false;
        if ($add) {
            $update = GPGroupsUsersModel::query()->updateOrCreate(["group_id" => $group->id, "user_id" => $user->id,]);
            bhry98_created_log((bool)$update, "User (CODE: {$user->code}) joined group (CODE: {$group->code})", ["user" => $user->toArray(), "group" => $group->toArray()]);
        } else {
            $update = GPGroupsUsersModel::query()->where(["group_id" => $group->id, "user_id" => $user->id])->forceDelete();
            bhry98_force_delete_log((bool)$update, "User (CODE: {$user->code}) left group (CODE: {$group->code})", ["user" => $user->toArray(), "group" => $group->toArray()]);
        }
        $this->notifyFilament((bool)$update, "updated");
        Cache::forget("user_permissions_{$user->id}");
        return (bool)$update;
    }

    public function managePermissionsInGroup(int $groupId, int $permissionId, bool $add = true): bool
    {
        $group = $this->getById($groupId);
        if (!$group) return false;
        $permission = (new GPPermissionsService())->getById($permissionId);
        if (!$permission) return false;
        if ($add) {
            $update = GPGroupsPermissionsModel::query()->updateOrCreate(["group_id" => $group->id, "permission_id" => $permission->id,]);
            bhry98_created_log((bool)$update, "Add permission (CODE: {$permission->code}) to group (CODE: {$group->code})", ["permission" => $permission->toArray(), "group" => $group->toArray()]);
        } else {
            $update = GPGroupsPermissionsModel::query()->where(["group_id" => $group->id, "permission_id" => $permission->id])->forceDelete();
            bhry98_force_delete_log((bool)$update, "Remove permission (CODE: {$permission->code}) from group (CODE: {$group->code})", ["permission" => $permission->toArray(), "group" => $group->toArray()]);
        }
        $this->notifyFilament((bool)$update, "updated");
        return (bool)$update;
    }

    private function handleLocalizedData(GPGroupsModel $record, array $data): void
    {
        if (array_key_exists('names', $data)) {
            foreach ($data['names'] as $locale => $name) {
                if ($name) $record->setLocalized('name', $name, $locale);
            }
        }
        if (array_key_exists('descriptions', $data)) {
            foreach ($data['descriptions'] as $locale => $description) {
                if ($description) $record->setLocalized('description', $description, $locale);
            }
        }
    }

    private function handleModelData(array $data): array
    {
        $data['default_name'] = $data['names']['en'] ?? "N/A";
        $data['description_name'] = $data['descriptions']['en'] ?? "N/A";
        return $data;
    }

}
