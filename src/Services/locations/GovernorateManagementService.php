<?php

namespace Bhry98\Bhry98LaravelReady\Services\locations;

use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCitiesModel;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCountriesModel;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsGovernoratesModel;
use Bhry98\Bhry98LaravelReady\Services\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;

class GovernorateManagementService extends BaseService
{
    public function getByCode(string $identityCode, array|null $relations = null): ?LocationsGovernoratesModel
    {
        $record = LocationsGovernoratesModel::query()->where(column: 'identity_code', value: $identityCode)->first();
        if ($relations) {
            $record->with($relations);
        }
        return $record;
    }

    public function createNewGovernorate(array $data): LocationsGovernoratesModel
    {
        $record = LocationsGovernoratesModel::query()->create($data);
        bhry98_created_log(success: (bool)$record, message: "CORE => GovernorateManagementService@createNewGovernorate", context: $record->toArray());
        return $record;
    }

    public function updateGovernorate(string $governorateCode, array $data): bool
    {
        $record = self::getByCode($governorateCode);
        $update = $record->update($data);
        bhry98_updated_log(success: $update, message: "CORE => GovernorateManagementService@updateGovernorate", context: ['old' => $record, 'new' => $data]);
        return $update;
    }

    public function deleteGovernorate(string $governorateCode, bool $force = false): ?bool
    {
        $record = self::getByCode($governorateCode);
        if ($force) {
            $update = $record->forceDelete();
        } else {
            $update = $record->delete();
        }
        bhry98_force_delete_log(success: (bool)$update, message: "CORE => GovernorateManagementService@deleteGovernorate", context: ['old' => $record, 'force' => $force]);
        return $update;
    }

    public function searchByName(string $governorateName, int $limit = 20): array
    {
        $data = LocationsGovernoratesModel::query();
        $data->orderBy(column: 'id', direction: 'desc');
        $data->whereHas(relation: 'localizations', callback: fn($q) => $q->where('locale', app()->getLocale())->where('value', 'like', "%{$governorateName}%"));
        $data->orWhereLike(column: 'default_name', value: "%{$governorateName}%");
        $data->limit(value: $limit);
        $result = $data->get();
        return $result->mapWithKeys(function ($model) {
            $label = optional($model->localizations->where('locale', app()->getLocale())->first())->value ?? $model->default_name . 33;
            return [$model->id => $label];
        })->toArray();
    }

    public function getAll(int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null, string|null $countryGlobalCode = null): LengthAwarePaginator
    {
        $data = LocationsGovernoratesModel::query()
            ->orderBy('id', 'desc');
        if ($countryGlobalCode) {
            $country = LocationsCountriesModel::query()->where('country_code', $countryGlobalCode)->first();
            $data->where("country_id", $country?->id ?? "");
        }
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

}
