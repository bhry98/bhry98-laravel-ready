<?php

namespace Bhry98\Bhry98LaravelReady\Services\enums;

use Illuminate\Pagination\LengthAwarePaginator;
use Bhry98\Bhry98LaravelReady\Models\enums\EnumsCoreModel;
use Bhry98\Bhry98LaravelReady\Services\BaseService;
use Bhry98\Bhry98LaravelReady\Enums\enums\EnumsCoreTypes;

class EnumsManagementService extends BaseService
{
    public function getByCode(string $enumCode, array|null $relations = null): ?EnumsCoreModel
    {
        $record = EnumsCoreModel::query()->where('code', $enumCode)->first();
        if ($relations) {
            $record->with($relations);
        }
        return $record;
    }

    public function getDefault(string $enumTypeCode, string $enumDefaultName, ?string $enumModule = null, array|null $relations = null): ?EnumsCoreModel
    {
        $record = EnumsCoreModel::query()->where(["type" => $enumTypeCode, "default_name" => $enumDefaultName,])->first();
        if ($relations) {
            $record->with($relations);
        }
        return $record;
    }

    public function createNewEnum(array $data): EnumsCoreModel
    {
        $record = EnumsCoreModel::query()->create($data);
        bhry98_created_log(success: (bool)$record, message: "CORE => EnumsManagementService@createNewEnum", context: $record->toArray());
        return $record;
    }

    public function updateEnum(string $enumCode, array $data): bool
    {
        $record = self::getByCode($enumCode);
        $update = $record->update($data);
        bhry98_updated_log(success: $update, message: "CORE => EnumsManagementService@updateEnum", context: ['old' => $record, 'new' => $data]);
        return $update;
    }

    public function deleteEnum(string $enumCode, bool $force = false): ?bool
    {
        $record = self::getByCode($enumCode);
        if ($force) {
            $update = $record->forceDelete();
        } else {
            $update = $record->delete();
        }
        bhry98_force_delete_log(success: (bool)$update, message: "CORE => EnumsManagementService@deleteEnum", context: ['old' => $record, 'force' => $force]);
        return $update;
    }

    public function getAllByType(string $type, int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null): LengthAwarePaginator
    {
        $enumType = EnumsCoreTypes::from($type);
        $data = EnumsCoreModel::query()
            ->where('type', $enumType)
            ->where('api_access',true)
            ->orderBy('id', 'desc');
        if (!empty($filters)) {
            self::applyFilters($data, $filters, EnumsCoreModel::class);
            $pageNumber = 0;
        }
        if ($relations) {
            $data->with($relations);
        }
        return $data->withCount(['children'])
            ->paginate(
                perPage: $perPage,
                page: $pageNumber,
            );
    }

}
