<?php

namespace Bhry98\Bhry98LaravelReady\Services\users;

use Bhry98\Bhry98LaravelReady\Enums\enums\EnumsTypes;
use Bhry98\Bhry98LaravelReady\Enums\users\UsersAccountTypes;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCountriesModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreModel;
use Bhry98\Bhry98LaravelReady\Notifications\users\UserUpdatedSuccessfully;
use Bhry98\Bhry98LaravelReady\Services\BaseService;
use Bhry98\Bhry98LaravelReady\Services\enums\EnumsManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\CitiesManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\CountriesManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\GovernorateManagementService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class UsersManagementService extends BaseService
{
    /**
     * @param string $code
     * @param array|null $relations
     * @param bool $withRelationsCount
     * @param bool $withTrash
     * @return UsersCoreModel|null
     */
    public function getByCode(string $code, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?UsersCoreModel
    {
        $record = UsersCoreModel::query()->where(['code' => $code]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
//        if ($withRelationsCount) $record->withCount(['governorates', 'cities', 'users']);
        return $record->first();
    }

    /**
     * @param int $id
     * @param array|null $relations
     * @param bool $withRelationsCount
     * @param bool $withTrash
     * @return UsersCoreModel|null
     */
    public function getById(int $id, array|null $relations = null, bool $withRelationsCount = false, bool $withTrash = false): ?UsersCoreModel
    {
        $record = UsersCoreModel::query()->where(['id' => $id]);
        if ($withTrash) $record->withTrashed();
        if ($relations) $record->with($relations);
//        if ($withRelationsCount) $record->withCount(['governorates', 'cities', 'users']);
        return $record->first();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function createNewUser(array $data): bool
    {
        $record = UsersCoreModel::query()->create($data);
        !$record ? bhry98_send_filament_notification("danger", __("Bhry98::notifications.filament.created-field")) : bhry98_send_filament_notification("success", __("Bhry98::notifications.filament.created-success"));
        bhry98_created_log(success: (bool)$record, message: "create new user", context: ['record' => $record->toArray()]);
        return (bool)$record;
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
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
            if (array_key_exists('country', $data)) $data['country_id'] = (new CountriesManagementService)->getByCode($data['country'])?->id;
            if (array_key_exists('governorate', $data)) $data['governorate_id'] = (new GovernorateManagementService())->getByCode($data['governorate'])?->id;
            if (array_key_exists('city', $data)) $data['city_id'] = (new CitiesManagementService())->getByCode($data['city'])?->id;
            if (array_key_exists('type', $data)) $data['type_id'] = (new EnumsManagementService())->getByCode($data['type'])?->id;
            $update = $user->update($data);
//            if ($update) Notification::sendNow(auth()->user(), new UserUpdatedSuccessfully(auth()->id()), ['database']);
//            if ($update) auth()->user()->notifyNow(new UserUpdatedSuccessfully(), ["database"]);
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
