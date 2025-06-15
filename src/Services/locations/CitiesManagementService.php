<?php

namespace Bhry98\Bhry98LaravelReady\Services\locations;

use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCitiesModel;
use Bhry98\Bhry98LaravelReady\Services\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;

class CitiesManagementService extends BaseService
{
    public function getByCode(string $code, array|null $relations = null): ?LocationsCitiesModel
    {
        $record = LocationsCitiesModel::query()->where('code',  $code)->first();
        if ($relations) {
            $record->with($relations);
        }
        return $record;
    }

    public function createNewCity(array $data): LocationsCitiesModel
    {
        $record = LocationsCitiesModel::query()->create($data);
        bhry98_created_log(success: (bool)$record, message: "CORE => CitiesManagementService@createNewCity", context: $record->toArray());
        return $record;
    }

    public function updateCity(string $identityCode, array $data): bool
    {
        $record = self::getByCode($identityCode);
        $update = $record->update($data);
        bhry98_updated_log(success: $update, message: "CORE => CitiesManagementService@updateCity", context: ['old' => $record, 'new' => $data]);
        return $update;
    }

    public function deleteCity(string $identityCode, bool $force = false): ?bool
    {
        $record = self::getByCode($identityCode);
        if ($force) {
            $update = $record->forceDelete();
        } else {
            $update = $record->delete();
        }
        bhry98_force_delete_log(success: (bool)$update, message: "CORE => CitiesManagementService@deleteCity", context: ['old' => $record, 'force' => $force]);
        return $update;
    }

    public function searchByName(string $cityName, int $limit = 20): array
    {
        $data = LocationsCitiesModel::query();
        $data->orderBy(column: 'id', direction: 'desc');
        $data->whereHas(relation: 'localizations', callback: fn($q) => $q->where('locale', app()->getLocale())->where('value', 'like', "%{$cityName}%"));
        $data->orWhereLike(column: 'default_name', value: "%{$cityName}%");
        $data->limit(value: $limit);
        $result = $data->get();
        return $result->mapWithKeys(function ($model) {
            $label = optional($model->localizations->where('locale', app()->getLocale())->first())->value ?? $model->default_name . 33;
            return [$model->id => $label];
        })->toArray();
    }

    public function getAll(int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null): LengthAwarePaginator
    {
        $data = LocationsCitiesModel::query()
            ->orderBy('id', 'desc');
        if (!empty($filters)) {
            self::applyFilters($data, $filters, LocationsCitiesModel::class);
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

}
