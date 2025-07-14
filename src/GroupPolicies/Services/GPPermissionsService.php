<?php

namespace Bhry98\GP\Services;

use Bhry98\GP\Models\GPPermissionsModel;
use Bhry98\Helpers\extends\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Service class responsible for managing permission-related operations.
 */
class GPPermissionsService extends BaseService
{
    /**
     * Retrieve all permissions with optional filters and relations.
     *
     * @param int $pageNumber
     * @param int $perPage
     * @param array|null $relations
     * @param array|null $filters
     * @return LengthAwarePaginator
     */
    public function allPermissions(int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null): LengthAwarePaginator
    {
        $data = GPPermissionsModel::query()->orderByDesc('id');

        if (!empty($filters)) {
            self::applyFilters($data, $filters, GPPermissionsModel::class);
            $pageNumber = 0;
        }

        if ($relations) {
            $data->with($relations);
        }

        return $data->withCount(['groups'])
            ->paginate(
                perPage: $perPage,
                page: $pageNumber
            );
    }

    /**
     * Retrieve a permission record by its code.
     *
     * @param string $code
     * @param array|null $relations
     * @return GPPermissionsModel|null
     */
    public function getPermissionByCode(string $code, array|null $relations = null): ?GPPermissionsModel
    {
        $query = GPPermissionsModel::query()->where('code', $code);

        if ($relations) {
            $query->with($relations);
        }

        return $query->withCount(['groups'])->first();
    }

    /**
     * Get a list of permission options for dropdowns or selects.
     *
     * @param string|null $searchStr
     * @param int $limit
     * @return array<int, string>
     */
    public function getOptions(?string $searchStr = null, int $limit = 20): array
    {
        $query = GPPermissionsModel::query();

        if ($searchStr) {
            $query->filterLocalized('name', $searchStr);
        }

        $data = $query->limit($limit)->get();

        return $data->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        })->toArray();
    }
}
