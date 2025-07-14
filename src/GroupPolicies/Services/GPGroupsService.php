<?php

namespace Bhry98\GP\Services;

use Bhry98\GP\Models\GPGroupsModel;
use Bhry98\Helpers\extends\BaseService;
use Bhry98\Users\Models\UsersCoreModel;
use Bhry98\GP\Models\GPGroupsUsersModel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

/**
 * Service class responsible for managing group-related operations.
 */
class GPGroupsService extends BaseService
{
    /**
     * Retrieve a group by its unique code.
     *
     * @param string $code
     * @param array|null $relations
     * @param bool $withRelationsCount
     * @param bool $withTrash
     * @return GPGroupsModel|null
     */
    public function getGroupByCode(string $code, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?GPGroupsModel
    {
        $record = GPGroupsModel::query()->where(['code' => $code]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
        if ($withRelationsCount) $record->withCount(['users', 'precessions']);
        return $record->first();
    }

    /**
     * Retrieve a group by its ID.
     *
     * @param int $id
     * @param array|null $relations
     * @param bool $withRelationsCount
     * @param bool $withTrash
     * @return GPGroupsModel|null
     */
    public function getGroupById(int $id, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?GPGroupsModel
    {
        $record = GPGroupsModel::query()->where(['id' => $id]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
        if ($withRelationsCount) $record->withCount(['users', 'precessions']);
        return $record->first();
    }

    /**
     * Retrieve all groups with optional filters and relations.
     *
     * @param int $pageNumber
     * @param int $perPage
     * @param array|null $relations
     * @param array|null $filters
     * @return LengthAwarePaginator
     */
    public function allGroups(int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null): LengthAwarePaginator
    {
        $query = GPGroupsModel::query()->orderByDesc('id');

        if (!empty($filters)) {
            self::applyFilters($query, $filters, GPGroupsModel::class);
            $pageNumber = 0;
        }

        if ($relations) {
            $query->with($relations);
        }

        return $query->withCount(['users', 'permissions'])
            ->paginate(
                perPage: $perPage,
                page: $pageNumber,
            );
    }

    /**
     * Get dropdown options for groups.
     *
     * @param string|null $searchStr
     * @param int $limit
     * @return array
     */
    public function getOptions(?string $searchStr = null, int $limit = 20): array
    {
        $list = GPGroupsModel::query();
        if ($searchStr) $list->filterLocalized('name', $searchStr);
        $data = $list->get();
        return $data->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        })->toArray();
    }

    /**
     * Create a new group.
     *
     * @param array $data
     * @return GPGroupsModel|null
     */
    public function createNewGroup(array $data): ?GPGroupsModel
    {
        $record = GPGroupsModel::query()->create($data);
        !$record ? bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.created-field")) : bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.created-success"));
        bhry98_created_log(success: (bool)$record, message: "create new group policy", context: ["record" => $record->toArray()]);
        return $record;
    }
    /**
     * Add or remove a user from a group using their codes.
     *
     * @param string $groupCode
     * @param string $userCode
     * @param bool $add
     * @return bool
     */
    public function manageUserInGroup(string $groupCode, string $userCode, bool $add = true): bool
    {
        $group = $this->getGroupByCode($groupCode);
        if (!$group) return false;

        $user = (new UsersManagementService())->getByCode($userCode, withTrash: true);
        if (!$user) return false;

        if ($add) {
            $update = GPGroupsUsersModel::query()->updateOrCreate([
                "group_id" => $group->id,
                "user_id" => $user->id,
            ]);
            bhry98_created_log(
                success: (bool)$update,
                message: "User (CODE: {$user->code}) joined group (CODE: {$group->code})",
                context: ["user" => $user->toArray(), "group" => $group->toArray()]
            );
        } else {
            if ($user->id != auth()->id()) {
                $update = GPGroupsUsersModel::query()
                    ->where(["group_id" => $group->id, "user_id" => $user->id])
                    ->forceDelete();
                bhry98_force_delete_log(
                    success: (bool)$update,
                    message: "User (CODE: {$user->code}) left group (CODE: {$group->code})",
                    context: ["user" => $user->toArray(), "group" => $group->toArray()]
                );
            } else {
                $update = false;
            }
        }

        if ($update) {
            bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.updated-success"));
            Cache::forget("user_permissions_{$user->id}");
        } else {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.updated-field"));
        }

        return (bool)$update;
    }


    /**
     * Retrieve all users in a group.
     *
     * @param string $groupCode
     * @param int $pageNumber
     * @param int $perPage
     * @param array|null $relations
     * @param array|null $filters
     * @return LengthAwarePaginator
     */
    public function allUsersFromGroup(string $groupCode, int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null): LengthAwarePaginator
    {
        $groupRecord = $this->groupDetails($groupCode);
        $data = UsersCoreModel::query()
            ->whereHas('groups', function ($query) use ($groupRecord) {
                $query->where('group_id', $groupRecord?->id);
            })
            ->orderBy('id', 'desc');

        if (!empty($filters)) {
            self::applyFilters($data, $filters, UsersCoreModel::class);
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

    /**
     * Retrieve group details with optional relations.
     *
     * @param string $groupCode
     * @param array|null $relations
     * @return GPGroupsModel|null
     */
    public function groupDetails(string $groupCode, array|null $relations = null): ?GPGroupsModel
    {
        $data = GPGroupsModel::query()->where('code', $groupCode);
        if ($data && $relations) {
            $data->with($relations);
        }
        return $data->withCount(['users', 'permissions'])->first();
    }
}
