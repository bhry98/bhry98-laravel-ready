<?php

namespace Bhry98\Users\Services;

use Bhry98\Helpers\extends\BaseService;
use Bhry98\Locations\Services\LocationsCitiesService;
use Bhry98\Locations\Services\LocationsCountriesService;
use Bhry98\Locations\Services\LocationsGovernorateService;
use Bhry98\Settings\Enums\EnumsTypes;
use Bhry98\Settings\Services\SettingsEnumsService;
use Bhry98\Users\Enums\UsersAccountTypes;
use Bhry98\Users\Enums\UsersVerifyCodeTypes;
use Bhry98\Users\Interfaces\OtpSenderInterface;
use Bhry98\Users\Models\UsersCoreModel;
use Bhry98\Users\Models\UsersVerifyCodesModel;
use Bhry98\Users\Notifications\auth\ResetPasswordCode;
use Bhry98\Users\Notifications\auth\SuccessfullyRegistration;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UsersAuthenticationService extends BaseService
{
    public function loginByUsername(string $username, string $password): ?string
    {
        if (auth()->attempt(["username" => $username, "password" => $password])) {
            $userExists = UsersCoreModel::query()->where('username', $username)->first();
            return self::loginViaUser($userExists);
        }
        return null;
    }

    public function loginByEmail(string $email, string $password): ?string
    {
        if (auth()->attempt(["email" => $email, "password" => $password])) {
            $userExists = UsersCoreModel::query()->where('email', $email)->first();
            return self::loginViaUser($userExists);
        }
        return null;
    }

    public function loginByPhoneNumber(string $phoneNumber, string $password): ?string
    {
        if (auth()->attempt(["phone_number" => $phoneNumber, "password" => $password])) {
            $userExists = UsersCoreModel::query()->where('phone_number', $phoneNumber)->first();
            return self::loginViaUser($userExists);
        }
        return null;
    }

    public function loginViaUser(UsersCoreModel|Authenticatable $user): string
    {
        Auth::loginUsingId($user->id);
        $tokenResult = $user->createToken($user->code);
        return $tokenResult->plainTextToken;
    }

    public function getAuthUser(array|null $relations = null): ?Authenticatable
    {
        $user = UsersCoreModel::query()->where('id', Auth::id());
        if ($user && $relations) $user->with($relations);
        return $user->first();
    }

    public function registration(array $data): UsersCoreModel|null
    {
        $enumsService = new SettingsEnumsService();
        if (array_key_exists('type', $data) && $data['type']) {
            // check if a default normal user type exists
            $userType = $enumsService->getByCode($data['type']);
        } else {
            // get a default user type
            $userType = $enumsService->getDefault(EnumsTypes::UsersType, UsersAccountTypes::User->name);
        }
        // if a normal user type didn't find abort, 400
        // add a normal user in a database
        $data['type_id'] = $userType?->id ?? null;
        if (array_key_exists('country', $data)) $data['country_id'] = (new LocationsCountriesService)->getByCode($data['country'])?->id;
        if (array_key_exists('governorate', $data)) $data['governorate_id'] = (new LocationsGovernorateService())->getByCode($data['governorate'])?->id;
        if (array_key_exists('city', $data)) $data['city_id'] = (new LocationsCitiesService())->getByCode($data['city'])?->id;
        $user = UsersCoreModel::query()->create($data);
        if ($user) {
            // if added successfully, add log [info] and return the user
            Log::info(message: "User registered successfully with id {$user->id}", context: ['user' => $user]);
//            if (config('bhry98.registration.must_verify_phone') && filled($user->phone_number)) {
//                $user->must_verify_phone = true;
//                $user->save();
//                $user->refresh();
//                $this->sendOtpViaSms($user->phone_number, UsersVerifyCodeTypes::VerifyPhone);
//            }
            (new UsersNotificationsService())->sendNotificationToUser($user, new SuccessfullyRegistration($user));
            return $user;
        } else {
            // if added successfully, add log [error] and return user
            Log::error(message: "User registered field", context: ['user' => $user]);
            return null;
        }
    }

    public function sendOtpViaSms($phoneNumber, UsersVerifyCodeTypes $forType): bool
    {
        $user = UsersCoreModel::query()->where('phone_number', $phoneNumber)->first();
        if (!$user) return false;
        if ($this->userHasManyResetPasswordAttempt($user)) return false;
        UsersVerifyCodesModel::query()->where('user_id', $user->id)->update(['valid' => false]);
        $code = UsersVerifyCodesModel::query()->create(["user_id" => $user->id, "type" => $forType->name]);
        app(OtpSenderInterface::class)->sendOtp($user->phone_number, $code->verify_code);
        return (bool)$code;
    }

    public function userHasManyResetPasswordAttempt(UsersCoreModel $user): bool
    {
        $attempt = UsersVerifyCodesModel::query()
            ->where([
                'user_id' => $user->id,
                "type" => UsersVerifyCodeTypes::ResetPassword,
            ])
            ->whereDate('created_at', '>=', now()->subHour())
            ->count();
        return $attempt >= config('bhry98.otp_attempt_limit', 5);
    }


    //////////////////
    public function sendResetPasswordCodeViaEmail($email): bool
    {
        $user = UsersCoreModel::query()->where('email', $email)->first();
        if (!$user) return false;
        if ($this->userHasManyResetPasswordAttempt($user)) return false;
        UsersVerifyCodesModel::query()->where('user_id', $user->id)->update(['valid' => false]);
        $code = UsersVerifyCodesModel::query()->create([
            "user_id" => $user->id,
            "type" => UsersVerifyCodeTypes::ResetPassword,
        ]);
        $user->notifyNow(new ResetPasswordCode($code));
        $user->update(['must_change_password' => true]);
        return (bool)$code;
    }

    public function getTokenForResetPasswordViaEmail($email): ?string
    {
        $user = UsersCoreModel::query()->where('email', $email)->first();
        if (!$user) return false;
        $login = self::loginViaUser($user);
        if ($login) {
            $user->must_change_password = true;
            $user->save();
            return $login;
        }
        return null;
    }

    public function verifyPhoneNumber($phoneNumber): bool
    {
        $user = UsersCoreModel::query()->where('phone_number', $phoneNumber)->first();
        if (!$user) return false;
        $user->must_verify_phone = false;
        return $user->save();
    }

    public function verifyEmail($email): bool
    {
        $user = UsersCoreModel::query()->where('email', $email)->first();
        if (!$user) return false;
        $user->must_verify_email = false;
        return $user->save();
    }

    public function verifyCode(int $code, ?string $userIdentifier, bool $setAsNotValid = true): ?UsersVerifyCodesModel
    {
        if (!$userIdentifier) return null;
        $user = UsersCoreModel::query()->where('email', $userIdentifier)->orWhere('phone_number', $userIdentifier)->first();
        if (!$user) return null;
        $code = UsersVerifyCodesModel::query()->where([
            "user_id" => $user->id,
            "valid" => true,
            "verify_code" => $code
        ])->first();
        $bool = $code && Carbon::parse($code->expired_at ?? now()->subMinute())?->isFuture();
        if ($setAsNotValid) $code?->update(['valid' => false]);
        $code?->refresh();
        return $bool ? $code : null;
    }


    public function logout(): bool
    {
//        bhry98_add_log(level: 'info', message: 'User logout', context: ['user' => Auth::user()?->code ?? '']);
        Auth::user()?->currentAccessToken()->delete();
        Auth::forgetUser();
        return !auth()->check();
    }
}
