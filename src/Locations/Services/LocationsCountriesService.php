<?php

namespace Bhry98\Locations\Services;
use Bhry98\Helpers\extends\BaseService;
use Bhry98\Locations\Models\LocationsCitiesModel;
use Bhry98\Locations\Models\LocationsCountriesModel;
use Bhry98\Locations\Models\LocationsGovernoratesModel;
use Illuminate\Pagination\LengthAwarePaginator;

class LocationsCountriesService extends BaseService
{
    /**
     * @param int $id
     * @param array|null $relations
     * @param bool $withRelationsCount
     * @param bool $withTrash
     * @return LocationsCountriesModel|null
     */
    public function getById(int $id, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?LocationsCountriesModel
    {
        $record = LocationsCountriesModel::query()->where(['id' => $id]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
        if ($withRelationsCount) $record->withCount(['governorates', 'cities', 'users']);
        return $record->first();
    }

    /**
     * @param string $code
     * @param array|null $relations
     * @param bool $withRelationsCount
     * @param bool $withTrash
     * @return LocationsCountriesModel|null
     */
    public function getByCode(string $code, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?LocationsCountriesModel
    {
        $record = LocationsCountriesModel::query()->where(['code' => $code]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
        if ($withRelationsCount) $record->withCount(['governorates', 'cities', 'users']);
        return $record->first();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function createCountry(array $data): bool
    {
        $record = LocationsCountriesModel::query()->create($data);
        if (!$record) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.created-field"));
            return false;
        } else {
            bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.created-success"));
        }
        bhry98_created_log(success: (bool)$record, message: "create new country", context: ['record' => $record->toArray()]);
        return (bool)$record;
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateCountry(int $id, array $data): bool
    {
        $record = self::getById($id);
        if (!$record) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.updated-field"));
            return false;
        }
        $updated = $record->update(collect($data)->except(['names'])?->toArray() ?? []);
        if ($updated) {
            if (array_key_exists('names', $data)) {
                $record = self::getById($id);
                foreach ($data['names'] as $locale => $value) {
                    if ($value)$record->setLocalized('name', $value, $locale);
                }
            }
            bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.updated-success"));
        } else {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.updated-failed"));
        }
        bhry98_updated_log(success: $updated, message: "update country", context: ['record' => $record?->toArray(), 'data' => $data]);
        return $updated;
    }

    /**
     * @param int $id
     * @param bool $force
     * @return bool
     */
    public function deleteCountry(int $id, bool $force = false): bool
    {
        $record = self::getById($id, withTrash: true);
        if (!$record) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.deleted-field"));
            return false;
        }
        $recordClone = self::getById($id, withTrash: true);
        if ($force) {
            $deleted = $record?->forceDelete();
            bhry98_force_delete_log((bool)$deleted, "force delete country", ['record' => $recordClone]);
            if (!$deleted) {
                bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.force-deleted-field"));
            } else {
                bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.force-deleted-success"));
            }

        } else {
            $deleted = $record?->delete();
            bhry98_deleted_log((bool)$deleted, "delete country", ['record' => $recordClone]);
            if (!$deleted) {
                bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.deleted-field"));
            } else {
                bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.deleted-success"));
            }

        }
        return (bool)$deleted;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function restoreCountry(int $id): bool
    {
        $record = self::getById($id, withTrash: true);
        if (!$record) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.restored-field"));
            return false;
        }
        $restored = $record?->restore();
        bhry98_restored_log((bool)$restored, "restore country", ['record' => $record]);
        if ((bool)$restored) {
            bhry98_send_filament_notification("info", __("Bhry98::notifications.filament.restored-success"));
        } else {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.restored-failed"));
        }
        return (bool)$restored;
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
        $data = LocationsCountriesModel::query()->latest('id');
        if ($getActiveOnly) $data->active();
        if (!empty($filters)) {
            self::applyFilters($data, $filters, LocationsCountriesModel::class);
            $pageNumber = 0;
        }
        if ($relations) $data->with($relations);
        $data->withCount(['users', 'governorates', 'cities']);
        return $data->paginate($perPage, page: $pageNumber);
    }

    /**
     * @param string $countryCode
     * @param int $pageNumber
     * @param int $perPage
     * @param array|null $relations
     * @param array|null $filters
     * @return LengthAwarePaginator
     */
    public function getAllGovernorates(string $countryCode, int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null, bool $getActiveOnly = true): LengthAwarePaginator
    {
        $country = self::getByCode($countryCode);
        $data = LocationsGovernoratesModel::query()->where(["country_id" => $country?->id ?? ""])->latest('id');
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
     * @param string $countryCode
     * @param int $pageNumber
     * @param int $perPage
     * @param array|null $relations
     * @param array|null $filters
     * @return LengthAwarePaginator
     */
    public function getAllCities(string $countryCode, int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null, bool $getActiveOnly = true): LengthAwarePaginator
    {
        $country = self::getByCode($countryCode);
        $data = LocationsCitiesModel::query()->where(["country_id" => $country?->id ?? ""])->latest('id');
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
     * @param int $limit
     * @return array
     */
    public function getOptions(int $limit = 20): array
    {
        $data = LocationsCountriesModel::query()->with('localizations');
        $data->orderBy('id', 'desc');
        $data->limit($limit);
        $result = $data->get();
        return $result->mapWithKeys(function ($model) {
            return [$model->id => $model->name_label];
        })->toArray();
    }

    /**
     * @param string $countryName
     * @param int $limit
     * @return array
     */
    public function searchByName(string $countryName, int $limit = 20): array
    {
        $data = LocationsCountriesModel::query()->with('localizations');
        $data->orderBy(column: 'id', direction: 'desc');
        $data->whereHas(relation: 'localizations', callback: fn($q) => $q->where('locale', app()->getLocale())->where('value', 'like', "%{$countryName}%"));
        $data->orWhereLike(column: 'default_name', value: "%{$countryName}%");
        $data->limit(value: $limit);
        $result = $data->get();
        return $result->mapWithKeys(function ($model) {
            return [$model->id => "($model->flag) $model->name"];
        })->toArray();
    }

}
