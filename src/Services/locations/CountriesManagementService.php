<?php

namespace Bhry98\Bhry98LaravelReady\Services\locations;

use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCitiesModel;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCountriesModel;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsGovernoratesModel;
use Bhry98\Bhry98LaravelReady\Services\BaseService;
use Filament\Notifications\Notification;
use Illuminate\Pagination\LengthAwarePaginator;

class CountriesManagementService extends BaseService
{
    // For Filament
    /**
     * @param int $id
     * @param array|null $relations
     * @param bool $withRelationsCount
     * @param bool $withTrash
     * @return LocationsCountriesModel|null
     */
    public function getById(int $id, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?LocationsCountriesModel
    {
        $record = LocationsCountriesModel::query()->where(['id', $id]);
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
        dd($id, $record);
        if (!$record) {
            Notification::make()
                ->title(__("Bhry98::notifications.filament.updated-field"))
                ->danger()
                ->send();
            return false;
        }
        $updated = $record?->update(collect($data)->except(['names'])?->toArray() ?? []);
        if (array_key_exists('names', $data)) {
            foreach ($data['names'] as $locale => $value) {
                $record?->setLocalized('name', $value, $locale);
            }
        }
        bhry98_updated_log(success: (bool)$updated, message: "update country", context: ['record' => $record?->toArray(), 'data' => $data]);
        return (bool)$updated;
    }

    /**
     * @param int $id
     * @param bool $force
     * @return bool
     */
    public function deleteCountry(int $id, bool $force): bool
    {
        $record = self::getById($id, withTrash: true);
        $recordClone = self::getById($id, withTrash: true);
        if ($force) {
            $deleted = $record?->forceDelete();
            bhry98_force_delete_log((bool)$deleted, "force delete country", ['record' => $recordClone]);
        } else {
            $deleted = $record?->delete();
            bhry98_deleted_log((bool)$deleted, "delete country", ['record' => $recordClone]);
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
        $restored = $record?->restore();
        bhry98_restored_log((bool)$restored, "restore country", ['record' => $record]);
        return (bool)$restored;
    }

    /**
     * For APIs
     */
    public function getByCode(string $code, array|null $relations = null): ?LocationsCountriesModel
    {
        $record = LocationsCountriesModel::query()->where('code', $code)->withCount(['governorates', 'cities', 'users']);
        if ($relations) {
            $record->with($relations);
        }
        return $record->first();
    }

    public function getAll(int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null): LengthAwarePaginator
    {
        $data = LocationsCountriesModel::query()
            ->orderBy('id', 'desc');
        if (!empty($filters)) {
            self::applyFilters($data, $filters, LocationsCountriesModel::class);
            $pageNumber = 0;
        }
        if ($relations) {
            $data->with($relations);
        }
        return $data->withCount(['users', 'governorates', 'cities'])
            ->paginate(
                perPage: $perPage,
                page: $pageNumber,
            );
    }

    public function getAllGovernorates(string $countryCode, int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null): LengthAwarePaginator
    {
        $country = self::getByCode($countryCode);
        $data = LocationsGovernoratesModel::query()
            ->where("country_id", $country?->id ?? "")
            ->orderBy('id', 'desc');
        if (!empty($filters)) {
            self::applyFilters($data, $filters, LocationsGovernoratesModel::class);
            $pageNumber = 0;
        }
        if ($relations) {
            $data->with($relations);
        }
        return $data->withCount(['users', 'cities'])
            ->paginate(
                perPage: $perPage,
                page: $pageNumber,
            );
    }

    public function getAllCities(string $countryCode, int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null): LengthAwarePaginator
    {
        $country = self::getByCode($countryCode);
        $data = LocationsCitiesModel::query()
            ->where("country_id", $country?->id ?? "")
            ->orderBy('id', 'desc');
        if (!empty($filters)) {
            self::applyFilters($data, $filters, LocationsCitiesModel::class);
            $pageNumber = 0;
        }
        if ($relations) {
            $data->with($relations);
        }
        return $data->withCount(['users'])
            ->paginate(
                perPage: $perPage,
                page: $pageNumber,
            );
    }

    /**
     * Globally
     */
    public function searchByName(string $countryName, int $limit = 20): array
    {
        $data = LocationsCountriesModel::query();
        $data->orderBy(column: 'id', direction: 'desc');
        $data->whereHas(relation: 'localizations', callback: fn($q) => $q->where('locale', app()->getLocale())->where('value', 'like', "%{$countryName}%"));
        $data->orWhereLike(column: 'default_name', value: "%{$countryName}%");
        $data->limit(value: $limit);
        $result = $data->get();
        return $result->mapWithKeys(function ($model) {
            $label = optional($model->localizations->where('locale', app()->getLocale())->first())->value ?? $model->default_name . 33;
            return [$model->id => $label];
        })->toArray();
    }

}
