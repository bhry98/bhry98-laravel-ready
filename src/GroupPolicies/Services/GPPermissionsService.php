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
    public GPPermissionsModel $permissionsModel;

    public function __construct()
    {
        $this->permissionsModel = new GPPermissionsModel();
    }

    public function getById(int $id, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?GPPermissionsModel
    {
        $record = $this->permissionsModel->query()->where(['id' => $id]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
        if ($withRelationsCount) $record->withCount(['groups']);
        return $record->first();
    }

}
