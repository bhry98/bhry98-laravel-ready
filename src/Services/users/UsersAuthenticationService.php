<?php

namespace Bhry98\Bhry98LaravelReady\Services\users;

use Bhry98\Bhry98LaravelReady\Enums\enums\EnumsCoreTypes;
use Bhry98\Bhry98LaravelReady\Enums\users\UsersAccountTypes;
use Bhry98\Bhry98LaravelReady\Enums\users\UsersVerifyCodeTypes;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersVerifyCodesModel;
use Bhry98\Bhry98LaravelReady\Notifications\auth\ResetPasswordCode;
use Bhry98\Bhry98LaravelReady\Services\BaseService;
use Bhry98\Bhry98LaravelReady\Services\enums\EnumsManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\CitiesManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\CountriesManagementService;
use Bhry98\Bhry98LaravelReady\Services\locations\GovernorateManagementService;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

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
        $tokenResult = $user->createToken($user->code);
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
            $userType = $enumsService->getDefault(enumTypeCode: EnumsCoreTypes::UsersType->name, enumDefaultName: UsersAccountTypes::User->name);
        }
        // if a normal user type didn't find abort, 400
        abort_if(!$userType, 400, __("validation.required", ["attribute" => "type"]), ['type' => __("validation.required", ["attribute" => "type"])]);
        // add normal user in database
        $data['type_id'] = $userType->id;
        if (array_key_exists('country', $data)) $data['country_id'] = (new CountriesManagementService)->getByCode($data['country'])?->id;
        if (array_key_exists('governorate', $data)) $data['governorate_id'] = (new GovernorateManagementService())->getByCode($data['governorate'])?->id;
        if (array_key_exists('city', $data)) $data['city_id'] = (new CitiesManagementService())->getByCode($data['city'])?->id;
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

    public function sendResetPasswordCodeViaEmail($email): bool
    {
        $user = UsersCoreUsersModel::query()->where('email', $email)->first();
        if (!$user) return false;
        if ($this->userHasManyResetPasswordAttempt($user)) return false;
        UsersVerifyCodesModel::query()->where('user_id', $user->id)->update(['valid' => false]);
        $code = UsersVerifyCodesModel::query()->create([
            "user_id" => $user->id,
            "type" => UsersVerifyCodeTypes::ResetPassword->name,
        ]);
        $user->notifyNow(new ResetPasswordCode($code));
        return (bool)$code;
    }

    public function getTokenForResetPasswordViaEmail($email): ?string
    {
        $user = UsersCoreUsersModel::query()->where('email', $email)->first();
        if (!$user) return false;
        $login = self::loginViaUser($user);
        if ($login) {
            $user->must_change_password = true;
            $user->save();
            return $login;
        }
        return null;
    }

    public function verifyCode(UsersVerifyCodeTypes $codeType, int $code, string $email, bool $setAsNotValid = true): bool
    {
        $user = UsersCoreUsersModel::query()->where('email', $email)->first();
        if (!$user) return false;
        $code = UsersVerifyCodesModel::query()->where([
            "user_id" => $user->id,
            "type" => $codeType,
            "valid" => true,
            "verify_code" => $code
        ])->first();
        $bool = $code && Carbon::parse($code->expired_at ?? now()->subMinute())?->isFuture();
        if ($setAsNotValid) $code?->update(['valid' => false]);
        return $bool;
    }

    public function userHasManyResetPasswordAttempt(UsersCoreUsersModel $user): bool
    {
        $attempt = UsersVerifyCodesModel::query()
            ->where([
                'user_id' => $user->id,
                "type" => UsersVerifyCodeTypes::ResetPassword,
            ])
            ->whereDate('created_at', '>=', now()->subHour())
            ->count();
        return $attempt >= bhry98_get_setting('reset_password_attempt_limit', 5);
    }

    public function logout(): bool
    {
        bhry98_add_log(level: 'info', message: 'User logout', context: ['user' => Auth::user()?->code ?? '']);
        Auth::user()?->currentAccessToken()->delete();
        Auth::forgetUser();
        return !auth()->check();
    }
}
