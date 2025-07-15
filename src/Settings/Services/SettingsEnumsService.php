<?php

namespace Bhry98\Settings\Services;

use Bhry98\Helpers\extends\BaseService;
use Bhry98\Settings\Enums\EnumsTypes;
use Bhry98\Settings\Models\SettingsEnumsModel;
use Illuminate\Pagination\LengthAwarePaginator;

class SettingsEnumsService extends BaseService
{
    /**
     * @param string $code
     * @param array|null $relations
     * @param bool $withRelationsCount
     * @param bool $withTrash
     * @return SettingsEnumsModel|null
     */
    public function getByCode(string $code, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?SettingsEnumsModel
    {
        $record = SettingsEnumsModel::query()->where(['code' => $code]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
        if ($withRelationsCount) $record->withCount(['children']);
        return $record->first();
    }

    /**
     * @param int $id
     * @param array|null $relations
     * @param bool $withRelationsCount
     * @param bool $withTrash
     * @return SettingsEnumsModel>|null
     */
    public function getById(int $id, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?SettingsEnumsModel
    {
        $record = SettingsEnumsModel::query()->where(['id' => $id]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
        if ($withRelationsCount) $record->withCount(['children']);
        return $record->first();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function createEnum(array $data): bool
    {
        $record = SettingsEnumsModel::query()->create($data);
        if (!$record) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.created-field"));
            return false;
        } else {
            if (array_key_exists('names', $data)) {
                foreach ($data['names'] as $locale => $value) {
                    $record->setLocalized('name', $value, $locale);
                }
            }
            bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.created-success"));
        }
        bhry98_created_log((bool)$record, "create new system enum", context: ['record' => $record->toArray()]);
        return (bool)$record;
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateEnum(int $id, array $data): bool
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
                    $record->setLocalized('name', $value, $locale);
                }
            }
            bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.updated-success"));
        }
        bhry98_updated_log((bool)$update, "update system enum", context: ['record' => $record, 'data' => $data]);
        return $update;
    }

    /**
     * @param int $id
     * @param bool $force
     * @return bool|null
     */
    public function deleteEnum(int $id, bool $force = false): ?bool
    {
        $record = self::getById($id, withTrash: true);
        if (!$record) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.deleted-field"));
            return false;
        }
        $recordClone = self::getById($id, withTrash: true);
        if ($force) {
            $delete = $record->forceDelete();
            bhry98_force_delete_log((bool)$delete, "force delete system enum", ['record' => $recordClone]);
            if (!$delete) {
                bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.force-deleted-field"));
            } else {
                bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.force-deleted-success"));
            }
        } else {
            $delete = $record->delete();
            bhry98_deleted_log((bool)$delete, "delete system enum", ['record' => $recordClone]);
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
    public function restoreEnum(int $id): ?bool
    {
        $record = self::getById($id, withTrash: true);
        if (!$record) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.restores-field"));
            return false;
        }
        $restore = $record->restore();
        bhry98_restored_log((bool)$restore, "restore system enum", ['record' => $record]);
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
     * @param bool $getActiveOnly
     * @return LengthAwarePaginator
     */
    public function getAll(int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null, bool $getActiveOnly = true): LengthAwarePaginator
    {
        $data = SettingsEnumsModel::query()->latest('id');
        if ($getActiveOnly) $data->active();
        if (!empty($filters)) {
            self::applyFilters($data, $filters, SettingsEnumsModel::class);
            $pageNumber = 0;
        }
        if ($relations) $data->with($relations);
        return $data->paginate($perPage, page: $pageNumber);
    }

    /**
     * @param string $enumTypeCode
     * @param string $enumDefaultName
     * @param string|null $enumModule
     * @param array|null $relations
     * @param bool $withTrash
     * @return SettingsEnumsModel|null
     */
    public function getDefault(EnumsTypes $enumTypeCode, string $enumDefaultName, ?string $enumModule = null, array|null $relations = null, bool $withTrash = false): ?SettingsEnumsModel
    {
        $record = SettingsEnumsModel::query()->where(["type" => $enumTypeCode->name, "default_name" => $enumDefaultName]);
        if ($relations) $record->with($relations);
        if ($withTrash) $record->withTrashed();
        return $record->first();
    }

    /**
     * @param string $type
     * @param int $pageNumber
     * @param int $perPage
     * @param array|null $relations
     * @param array|null $filters
     * @return LengthAwarePaginator
     */
    public function getAllByType(string $type, int $pageNumber = 0, int $perPage = 20, array|null $relations = null, array|null $filters = null): LengthAwarePaginator
    {
//        $enumType = SettingsEnumsModel::from($type);
        $data = SettingsEnumsModel::query()
            ->active()
            ->where('type', $type)
            ->orderBy('id', 'desc');
        if (!empty($filters)) {
            self::applyFilters($data, $filters, SettingsEnumsModel::class);
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


    /**
     * @param $type
     * @param string|null $searchStr
     * @param int $limit
     * @return array
     */
    public function searchByName($type, ?string $searchStr, int $limit = 20): array
    {
        $data = SettingsEnumsModel::query();
        $data->where(['type' => $type]);
        $data->whereHas('localizations', callback: fn($q) => $q->where('locale', app()->getLocale())->where('value', 'like', "%{$searchStr}%"));
        $data->whereLike('default_name', value: "%{$searchStr}%");
        $data->limit($limit);
        $data->orderBy('ordering');
        $result = $data->get();
        return $result->mapWithKeys(function ($model) {
            $label = optional($model->localizations->where('locale', app()->getLocale())->first())->value ?? $model->default_name;
            return [$model->id => $label];
        })->toArray();
    }

    /**
     * @param $type
     * @param int $limit
     * @param bool $active
     * @return array
     */
    public function selectOptions($type, int $limit = 20, bool $active = true): array
    {
        $list = SettingsEnumsModel::with('localizations');
        $list->where(['type' => $type, 'active' => $active]);
        $list->orderBy('ordering', 'asc');
        $list->limit(value: $limit);
        return $list->get()->mapWithKeys(function ($model) {
            $label = optional($model->localizations->where('locale', app()->getLocale())->first())->value ?? $model->default_name;
            return [$model->id => $label];
        })->toArray();
    }
}
