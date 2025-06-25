<?php

namespace Bhry98\Bhry98LaravelReady\Services\locations;

use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCitiesModel;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCountriesModel;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsGovernoratesModel;
use Bhry98\Bhry98LaravelReady\Services\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;

class GovernorateManagementService extends BaseService
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
        if (array_key_exists('names', $data)) {
            foreach ($data['names'] as $locale => $value) {
               if($value) $record->setLocalized('name', $value, $locale);
            }
        }
        if (!$update) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.updated-field"));
            return false;
        } else {
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
        bhry98_deleted_log((bool)$restore, "restore locations governorate", ['record' => $record]);
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
    public function getAll(int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null, string|null $countryGlobalCode = null): LengthAwarePaginator
    {
        $data = LocationsGovernoratesModel::query()->latest('id');
        if ($countryGlobalCode) {
            $country = LocationsCountriesModel::query()->where('country_code', $countryGlobalCode)->first();
            $data->where("country_id", $country?->id ?? "");
        }
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
    public function getAllCities(string $governorateCode, int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null): LengthAwarePaginator
    {
        $governorate = self::getByCode($governorateCode);
        $data = LocationsCitiesModel::query()->where(["governorate_id" => $governorate?->id ?? ""])->latest('id');
        if (!empty($filters)) {
            self::applyFilters($data, $filters, LocationsCitiesModel::class);
            $pageNumber = 0;
        }
        if ($relations) $data->with($relations);
        $data->withCount(['users']);
        return $data->paginate($perPage, page: $pageNumber);
    }



    //    public function getAllGovernoratesByGlobalCountryCode(string $countryGlobalCode, int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null): LengthAwarePaginator
//    {
//        $country = LocationsCountriesModel::query()->where('country_code', $countryGlobalCode)->first();
//        $data = LocationsGovernoratesModel::query()
//            ->where("country_id", $country?->id ?? "")
//            ->orderBy('id', 'desc');
//        if (!empty($filters)) {
//            self::applyFilters($data, $filters, LocationsGovernoratesModel::class);
//            $pageNumber = 0;
//        }
//        if ($relations) {
//            $data->with($relations);
//        }
//        return $data->withCount(['users', 'cities'])
//            ->paginate(
//                perPage: $perPage,
//                page: $pageNumber,
//            );
//    }
//    public function searchByName(string $governorateName, int $limit = 20): array
//    {
//        $data = LocationsGovernoratesModel::query();
//        $data->orderBy(column: 'id', direction: 'desc');
//        $data->whereHas(relation: 'localizations', callback: fn($q) => $q->where('locale', app()->getLocale())->where('value', 'like', "%{$governorateName}%"));
//        $data->orWhereLike(column: 'default_name', value: "%{$governorateName}%");
//        $data->limit(value: $limit);
//        $result = $data->get();
//        return $result->mapWithKeys(function ($model) {
//            $label = optional($model->localizations->where('locale', app()->getLocale())->first())->value ?? $model->default_name . 33;
//            return [$model->id => $label];
//        })->toArray();
//    }
}
