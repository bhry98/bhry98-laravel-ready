<?php

namespace Bhry98\Bhry98LaravelReady\Services\users;

use Bhry98\Bhry98LaravelReady\Enums\enums\EnumsCoreTypes;
use Bhry98\Bhry98LaravelReady\Enums\users\UsersDefaultType;
use Bhry98\Bhry98LaravelReady\Models\users\UsersADManagerUsersModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Services\BaseService;
use Bhry98\Bhry98LaravelReady\Services\enums\EnumsManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\CitiesManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\CountriesManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\GovernorateManagementService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use function Laravel\Prompts\select;

class UsersAuthenticationService extends BaseService
{
    public function loginByUsername(string $username, string $password): ?string
    {
        if (auth()->attempt(["username" => $username, "password" => $password])) {
            $userExists = UsersCoreUsersModel::query()->where('username', $username)->first();
            return self::loginViaUser($userExists);
        }
        return false;
    }

    public function loginByEmail(string $email, string $password): ?string
    {
        if (auth()->attempt(["email" => $email, "password" => $password])) {
            $userExists = UsersCoreUsersModel::query()->where('email', $email)->first();
            return self::loginViaUser($userExists);
        }
        return false;
    }

    public function loginByPhoneNumber(string $phoneNumber, string $password): ?string
    {
        if (auth()->attempt(["phone_number" => $phoneNumber, "password" => $password])) {
            $userExists = UsersCoreUsersModel::query()->where('phone_number', $phoneNumber)->first();
            return self::loginViaUser($userExists);
        }
        return false;
    }

    public function loginViaUser(UsersCoreUsersModel|Authenticatable $user): string
    {
        Auth::loginUsingId($user->id);
        $tokenResult = $user->createToken($user->identity_code);
        return $tokenResult->plainTextToken;
    }

    public function getAuthUser(array|null $relations = null): ?Authenticatable
    {
        $user = UsersCoreUsersModel::query()->where('id', Auth::id());
        if ($user && $relations) {
            $user->with($relations);
        }
        return $user->first();
    }

    public function registration(array $data): UsersCoreUsersModel|null
    {
        $enumsService = new EnumsManagementService();
        if (array_key_exists('type', $data)) {
            // check if a default normal user type exists
            $userType = $enumsService->getByCode(enumCode: $data['type']);
        } else {
            // get a default user type
            $userType = $enumsService->getDefault(enumTypeCode: EnumsCoreTypes::UsersType->value, enumDefaultName: UsersDefaultType::User->value);
        }
        // if a normal user type didn't find abort, 400
        abort_if(!$userType, 400, __("validation.required", ["attribute" => "type"]), ['type' => __("validation.required", ["attribute" => "type"])]);
        // add normal user in database
        $data['type_id'] = $userType->id;
        if (array_key_exists('country', $data)) $data['country_id'] = (new CountriesManagementService)->getByCode(identityCode: $data['country'])?->id;
        if (array_key_exists('governorate', $data)) $data['governorate_id'] = (new GovernorateManagementService())->getByCode(identityCode: $data['governorate'])?->id;
        if (array_key_exists('city', $data)) $data['city_id'] = (new CitiesManagementService())->getByCode(identityCode: $data['city'])?->id;
        $user = UsersCoreUsersModel::query()->create($data);
        if ($user) {
            // if added successfully, add log [info] and return the user
            Log::info(message: "User registered successfully with id {$user->id}", context: ['user' => $user]);
            return $user;
        } else {
            // if added successfully, add log [error] and return user
            Log::error(message: "User registered field", context: ['user' => $user]);
            return null;
        }
    }

    public function logout(): bool
    {
        bhry98_add_log(level: 'info', message: 'User logout', context: ['user' => Auth::user()?->identity_code ?? '']);
        Auth::user()?->currentAccessToken()->delete();
        Auth::forgetUser();
        return !auth()->check();
    }
}
