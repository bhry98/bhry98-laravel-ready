<?php

namespace Bhry98\Users\Services;

use Bhry98\Helpers\extends\BaseService;
use Bhry98\Locations\Services\LocationsCitiesService;
use Bhry98\Locations\Services\LocationsCountriesService;
use Bhry98\Locations\Services\LocationsGovernorateService;
use Bhry98\Settings\Services\SettingsEnumsService;
use Bhry98\Users\Models\UsersCoreModel;

class UsersManagementService extends BaseService
{
    public UsersCoreModel $userModel;

    public function __construct()
    {
        $this->userModel = new UsersCoreModel();
    }

    public function getByCode(string $code, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?UsersCoreModel
    {
        $record = $this->userModel->query()->where(['code' => $code]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
        return $record->first();
    }

    public function getById(int $id, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?UsersCoreModel
    {
        $record = $this->userModel->query()->where(['id' => $id]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
        return $record->first();
    }

    public function createNew(array $data): UsersCoreModel
    {
        $record = $this->userModel->query()->create($data);
        bhry98_created_log((bool)$record, "create new user", ['record' => $record->toArray()]);
        $this->notifyFilament((bool)$record, "created");
        return $record;
    }




    /////////////////
    public function updateUser(int $id, array $data): bool
    {
        $record = self::getById($id);
        if (!$record) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.updated-field"));
            return false;
        }
        $update = $record->update($data);
        !$update ? bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.updated-field")) : bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.updated-success"));
        bhry98_updated_log((bool)$update, "update user", context: ['record' => $record, 'data' => $data]);
        return $update;
    }

    /**
     * @param int $id
     * @param bool $force
     * @return bool|null
     */
    public function deleteUser(int $id, bool $force = false): ?bool
    {
        $record = self::getById($id, withTrash: true);
        if (!$record) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.deleted-field"));
            return false;
        }
        $recordClone = self::getById($id, withTrash: true);
        if ($force) {
            $delete = $record->forceDelete();
            bhry98_force_delete_log((bool)$delete, "force delete user", ['record' => $recordClone]);
            if (!$delete) {
                bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.force-deleted-field"));
            } else {
                bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.force-deleted-success"));
            }
        } else {
            $delete = $record->delete();
            bhry98_deleted_log((bool)$delete, "delete user", ['record' => $recordClone]);
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
    public function restoreUser(int $id): ?bool
    {
        $record = self::getById($id, withTrash: true);
        if (!$record) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.restores-field"));
            return false;
        }
        $restore = $record->restore();
        bhry98_restored_log((bool)$restore, "restore user", ['record' => $record]);
        if (!$restore) {
            bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.restored-field"));
            return false;
        } else {
            bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.restored-success"));
        }
        return $restore;
    }

    ///////////////////////////////////////////

    public function changeAccountStatus(string $code, bool|null $status = null): bool
    {
        $user = self::getByCode($code);
        if ($user) {
            $user->active = $status ?? !$user->active;
            return $user->save();
        }
        return (bool)$user;
    }

    public function updateProfile(string $code, array $data): bool
    {
        $user = self::getByCode($code);
        if ($user) {
            if (array_key_exists('country', $data)) $data['country_id'] = (new LocationsCountriesService)->getByCode($data['country'])?->id;
            if (array_key_exists('governorate', $data)) $data['governorate_id'] = (new LocationsGovernorateService())->getByCode($data['governorate'])?->id;
            if (array_key_exists('city', $data)) $data['city_id'] = (new LocationsCitiesService())->getByCode($data['city'])?->id;
            if (array_key_exists('type', $data)) $data['type_id'] = (new SettingsEnumsService())->getByCode($data['type'])?->id;
            $update = $user->update($data);
            return $update;
        }
        return (bool)$user;
    }

    public function changePassword(string $identityCode, string $password): bool
    {
        $user = self::getByCode($identityCode);
        if ($user) {
            $user->password = $password;
            $update = $user->save();
            bhry98_updated_log(success: $update, message: "CORE => UsersManagementService@changePassword");
        }
        return $update ?? false;
    }

    public function changeMyPassword(string $newPassword): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        $user->update(["password" => $newPassword, "must_change_password" => false]);
        $update = $user->save();
        bhry98_updated_log(success: $update, message: "CORE => UsersManagementService@changeMyPassword");
        return $update ?? false;
    }


    public function delete(string $identityCode): bool
    {
        $user = self::getByCode($identityCode);
        if ($user) {
            return (bool)$user->delete();
        }
        return (bool)$user;
    }

    public function forceDelete(string $identityCode): bool
    {
        $user = self::getByCode($identityCode);
        if ($user) {
            return (bool)$user->forceDelete();
        }
        return (bool)$user;
    }
}
