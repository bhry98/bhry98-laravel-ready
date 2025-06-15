<?php

namespace Bhry98\Bhry98LaravelReady\Services\users;

use Bhry98\Bhry98LaravelReady\Enums\enums\EnumsCoreTypes;
use Bhry98\Bhry98LaravelReady\Enums\users\UsersAccountTypes;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
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
    public function getByCode(string $code, array|null $relations = null): ?UsersCoreUsersModel
    {
        $data = UsersCoreUsersModel::query()->where('code', $code);
        if ($relations) {
            $data->with($relations);
        }
        return $data->first();
    }

    public function getById(int $id, array|null $relations = null): ?UsersCoreUsersModel
    {
        $data = UsersCoreUsersModel::query()->where('id', $id);
        if ($relations) {
            $data->with($relations);
        }
        return $data->first();
    }

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

    public function createNewUser(array $data): ?UsersCoreUsersModel
    {
        $first_name = $data["first_name"];
        $last_name = $data["last_name"];
        $data["display_name"] = "$first_name $last_name";
        $record = UsersCoreUsersModel::query()->create($data);
        bhry98_created_log(success: (bool)$record, message: "CORE => UsersManagementService@createNewUser", context: $record->toArray());
        return $record;
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
