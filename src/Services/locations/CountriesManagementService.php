<?php

namespace Bhry98\Bhry98LaravelReady\Services\locations;

use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCitiesModel;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCountriesModel;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsGovernoratesModel;
use Bhry98\Bhry98LaravelReady\Services\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;

class CountriesManagementService extends BaseService
{
    public function getByCode(string $identityCode, array|null $relations = null): ?LocationsCountriesModel
    {
        $record = LocationsCountriesModel::query()->where('identity_code', $identityCode)->withCount(['governorates', 'cities','users']);
        if ($relations) {
            $record->with($relations);
        }
        return $record->first();
    }

    public function createNewCountry(array $data): LocationsCountriesModel
    {
        $record = LocationsCountriesModel::query()->create($data);
        bhry98_created_log(success: (bool)$record, message: "CORE => CountriesManagementService@createNewCountry", context: $record->toArray());
        return $record;
    }

    public function updateCountry(string $countryCode, array $data): bool
    {
        $record = self::getByCode($countryCode);
        $update = $record->update($data);
        bhry98_updated_log(success: $update, message: "CORE => CountriesManagementService@updateCountry", context: ['old' => $record, 'new' => $data]);
        return $update;
    }

    public function deleteCountry(string $countryCode, bool $force = false): ?bool
    {
        $record = self::getByCode($countryCode);
        if ($force) {
            $update = $record->forceDelete();
        } else {
            $update = $record->delete();
        }
        bhry98_force_delete_log(success: (bool)$update, message: "CORE => CountriesManagementService@deleteCountry", context: ['old' => $record, 'force' => $force]);
        return $update;
    }

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

}
