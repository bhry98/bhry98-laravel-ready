<?php

namespace Bhry98\Locations\Services;

use Bhry98\Helpers\extends\BaseService;
use Bhry98\Locations\Models\LocationsCitiesModel;
use Bhry98\Locations\Models\LocationsCountriesModel;
use Bhry98\Locations\Models\LocationsGovernoratesModel;
use Illuminate\Pagination\LengthAwarePaginator;

class LocationsGovernorateService extends BaseService
{
    /**3
     * @param string $code
     * @param array|null $relations
     * @param bool $withRelationsCount
     * @param bool $withTrash
     * @return LocationsGovernoratesModel|null
     */
    public function getByCode(string $code, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?LocationsGovernoratesModel
    {
        $record = LocationsGovernoratesModel::query()->where(['code' => $code]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
        if ($withRelationsCount) $record->withCount(['cities', 'users']);
        return $record->first();
    }

    /**
     * @param int $id
     * @param array|null $relations
     * @param bool $withRelationsCount
     * @param bool $withTrash
     * @return LocationsGovernoratesModel|null
     */
    public function getById(int $id, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?LocationsGovernoratesModel
    {
        $record = LocationsGovernoratesModel::query()->where(['id' => $id]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
        if ($withRelationsCount) $record->withCount(['cities', 'users']);
        return $record->first();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function createGovernorate(array $data): bool
    {
        $record = LocationsGovernoratesModel::query()->create($data);

        if (!$record) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.created-field"));
            return false;
        } else {
            if (array_key_exists('names', $data)) {
                foreach ($data['names'] as $locale => $value) {
                    if ($value) $record->setLocalized('name', $value, $locale);
                }
            }
            bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.created-success"));
        }
        bhry98_created_log((bool)$record, "create new locations governorate", context: ['record' => $record->toArray()]);
        return (bool)$record;
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateGovernorate(int $id, array $data): bool
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
                    if ($value) $record->setLocalized('name', $value, $locale);
                }
            }
            bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.updated-success"));
        }
        bhry98_updated_log((bool)$update, "update locations governorate", context: ['record' => $record, 'data' => $data]);
        return $update;
    }

    /**
     * @param int $id
     * @param bool $force
     * @return bool|null
     */
    public function deleteGovernorate(int $id, bool $force = false): ?bool
    {
        $record = self::getById($id, withTrash: true);
        if (!$record) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.deleted-field"));
            return false;
        }
        $recordClone = self::getById($id, withTrash: true);
        if ($force) {
            $delete = $record->forceDelete();
            bhry98_force_delete_log((bool)$delete, "force delete locations governorate", ['record' => $recordClone]);
            if (!$delete) {
                bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.force-deleted-field"));
            } else {
                bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.force-deleted-success"));
            }

        } else {
            $delete = $record->delete();
            bhry98_deleted_log((bool)$delete, "delete locations governorate", ['record' => $recordClone]);
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
    public function restoreGovernorate(int $id): ?bool
    {
        $record = self::getById($id, withTrash: true);
        if (!$record) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.restores-field"));
            return false;
        }
        $restore = $record->restore();
        bhry98_restored_log((bool)$restore, "restore locations governorate", ['record' => $record]);
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
     * @param string|null $countryGlobalCode
     * @return LengthAwarePaginator
     */
    public function getAll(int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null, string|null $countryGlobalCode = null, bool $getActiveOnly = true): LengthAwarePaginator
    {
        $data = LocationsGovernoratesModel::query()->latest('id');
        if ($countryGlobalCode) {
            $country = LocationsCountriesModel::query()->where('country_code', $countryGlobalCode)->first();
            $data->where("country_id", $country?->id ?? "");
        }
        if ($getActiveOnly) $data->active();
        if (!empty($filters)) {
            self::applyFilters($data, $filters, LocationsGovernoratesModel::class);
            $pageNumber = 0;
        }
        if ($relations) $data->with($relations);
        $data->withCount(['users', 'cities']);
        return $data->paginate($perPage, page: $pageNumber);
    }

    /**
     * @param string $governorateCode
     * @param int $pageNumber
     * @param int $perPage
     * @param array|null $relations
     * @param array|null $filters
     * @return LengthAwarePaginator
     */
    public function getAllCities(string $governorateCode, int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null, bool $getActiveOnly = true): LengthAwarePaginator
    {
        $governorate = self::getByCode($governorateCode);
        $data = LocationsCitiesModel::query()->where(["governorate_id" => $governorate?->id ?? ""])->latest('id');
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
     * @param int|null $countryId
     * @return array
     */
    public function getOptions(?string $searchStr = null, int $limit = 20, ?int $countryId = null): array
    {
        $data = LocationsGovernoratesModel::query()->with('localizations');
        if ($countryId) $data->where('country_id', $countryId);
        $data->orderBy('id', 'desc');
        if ($searchStr) {
            $data->whereHas('localizations', callback: fn($q) => $q->where('locale', app()->getLocale())->where('value', 'like', "%{$searchStr}%"));
            $data->orWhereLike( 'default_name', value: "%{$searchStr}%");
        }
        $data->limit($limit);
        $result = $data->get();
        return $result->mapWithKeys(function ($model) {
            return [$model->id => $model->name ?? $model->default_name];
        })->toArray();
    }
}
