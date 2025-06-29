<?php

namespace Bhry98\Bhry98LaravelReady\Services\locations;

use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCitiesModel;
use Bhry98\Bhry98LaravelReady\Notifications\auth\SuccessfullyRegistration;
use Bhry98\Bhry98LaravelReady\Services\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;

class CitiesManagementService extends BaseService
{
    /**
     * @param string $code
     * @param array|null $relations
     * @param bool $withRelationsCount
     * @param bool $withTrash
     * @return LocationsCitiesModel|null
     */
    public function getByCode(string $code, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?LocationsCitiesModel
    {
        $record = LocationsCitiesModel::query()->where(['code' => $code]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
        if ($withRelationsCount) $record->withCount(['governorates', 'cities', 'users']);
        return $record->first();
    }

    /**
     * @param int $id
     * @param array|null $relations
     * @param bool $withRelationsCount
     * @param bool $withTrash
     * @return LocationsCitiesModel|null
     */
    public function getById(int $id, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?LocationsCitiesModel
    {
        $record = LocationsCitiesModel::query()->where(['id' => $id]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
        if ($withRelationsCount) $record->withCount(['governorates', 'cities', 'users']);
        return $record->first();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function createCity(array $data): bool
    {
        $record = LocationsCitiesModel::query()->create($data);
        if (!$record) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.created-field"));
            return false;
        } else {
            if (array_key_exists('names', $data)) {
                foreach ($data['names'] as $locale => $value) {
                    $record->setLocalized('name', $value, $locale);
                }
            }
            bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.created-success"));
        }
        bhry98_created_log((bool)$record, "create new locations city", context: ['record' => $record->toArray()]);
        return (bool)$record;
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateCity(int $id, array $data): bool
    {
        $record = self::getById($id);
        if (!$record) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.updated-field"));
            return false;
        }
        $update = $record->update($data);
        if (!$update) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.updated-field"));
            return false;
        } else {
            if (array_key_exists('names', $data)) {
                $record = self::getById($id);
                foreach ($data['names'] as $locale => $value) {
                    $record->setLocalized('name', $value, $locale);
                }
            }
            bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.updated-success"));
        }
        bhry98_updated_log((bool)$update, "update locations city", context: ['record' => $record, 'data' => $data]);
//        auth()->user()->notify(new SuccessfullyRegistration());
        return $update;
    }

    /**
     * @param int $id
     * @param bool $force
     * @return bool|null
     */
    public function deleteCity(int $id, bool $force = false): ?bool
    {
        $record = self::getById($id, withTrash: true);
        if (!$record) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.deleted-field"));
            return false;
        }
        $recordClone = self::getById($id, withTrash: true);
        if ($force) {
            $delete = $record->forceDelete();
            bhry98_force_delete_log((bool)$delete, "force delete locations city", ['record' => $recordClone]);
            if (!$delete) {
                bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.force-deleted-field"));
            } else {
                bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.force-deleted-success"));
            }
        } else {
            $delete = $record->delete();
            bhry98_deleted_log((bool)$delete, "delete locations city", ['record' => $recordClone]);
            if (!$delete) {
                bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.deleted-field"));
            } else {
                bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.deleted-success"));
            }
        }
        return $delete;
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function restoreCity(int $id): ?bool
    {
        $record = self::getById($id, withTrash: true);
        if (!$record) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.restores-field"));
            return false;
        }
        $restore = $record->restore();
        bhry98_restored_log((bool)$restore, "restore locations city", ['record' => $record]);
        if (!$restore) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.restored-field"));
            return false;
        } else {
            bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.restored-success"));
        }
        return $restore;
    }

    /**
     * @param int $pageNumber
     * @param int $perPage
     * @param array|null $relations
     * @param array|null $filters
     * @return LengthAwarePaginator
     */
    public function getAll(int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null, bool $getActiveOnly = true): LengthAwarePaginator
    {
        $data = LocationsCitiesModel::query()->latest('id');
        if ($getActiveOnly) $data->active();
        if (!empty($filters)) {
            self::applyFilters($data, $filters, LocationsCitiesModel::class);
            $pageNumber = 0;
        }
        if ($relations) $data->with($relations);
        $data->withCount(['users']);
        return $data->paginate($perPage, page: $pageNumber);
    }

    /**
     * @param string|null $searchStr
     * @param int $limit
     * @param int|null $governorateId
     * @return array
     */
    public function getOptions(?string $searchStr = null, int $limit = 20, ?int $governorateId = null): array
    {
        $data = LocationsCitiesModel::query()->with('localizations');
        if ($governorateId) $data->where('governorate_id', $governorateId);
        $data->orderBy('id', 'desc');
        if ($searchStr) {
            $data->whereHas('localizations', callback: fn($q) => $q->where('locale', app()->getLocale())->where('value', 'like', "%{$searchStr}%"));
            $data->orWhereLike('default_name', value: "%{$searchStr}%");
        }
        $data->limit($limit);
        $result = $data->get();
        return $result->mapWithKeys(function ($model) {
            return [$model->id => $model->name ?? $model->default_name];
        })->toArray();
    }
}
