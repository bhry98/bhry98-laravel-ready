<?php

namespace Bhry98\Users\Services;

use Bhry98\AccountCenter\Services\UsersNotificationsService;
use Bhry98\Helpers\extends\BaseService;
use Bhry98\Locations\Services\LocationsCitiesService;
use Bhry98\Locations\Services\LocationsCountriesService;
use Bhry98\Locations\Services\LocationsGovernorateService;
use Bhry98\Settings\Services\SettingsEnumsService;
use Bhry98\Users\Enums\UsersLoginTypes;
use Bhry98\Users\Enums\UsersVerifyCodeTypes;
use Bhry98\Users\Interfaces\OtpSenderInterface;
use Bhry98\Users\Models\UsersCoreModel;
use Bhry98\Users\Models\UsersVerifyCodesModel;
use Bhry98\Users\Notifications\auth\SuccessfullyRegistration;
use Bhry98\Users\Notifications\auth\VerifyCode;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersAuthenticationService extends BaseService
{

    public function registration(array $data): UsersCoreModel|null
    {
        $enumsService = new SettingsEnumsService();
        if (array_key_exists('type', $data) && $data['type']) {
            $userType = $enumsService->getByCode($data['type']);
            $data['type_id'] = $userType?->id ?? null;
        }
        if (array_key_exists('country', $data)) $data['country_id'] = (new LocationsCountriesService)->getByCode($data['country'])?->id;
        if (array_key_exists('governorate', $data)) $data['governorate_id'] = (new LocationsGovernorateService())->getByCode($data['governorate'])?->id;
        if (array_key_exists('city', $data)) $data['city_id'] = (new LocationsCitiesService())->getByCode($data['city'])?->id;
        $user = UsersCoreModel::query()->create($data);
        if (!$user) {
            bhry98_created_log(false, "user registration field", ['users' => $data]);
            return null;
        }
        if (config('bhry98.registration.must_verify_phone') && filled($user->phone_number) && config('bhry98.login_type') != UsersLoginTypes::PhoneOtp) {
            $user->must_verify_phone = true;
            $user->save();
            $user->refresh();
            $this->sendOtpViaSms($user->phone_number, UsersVerifyCodeTypes::VerifyPhone);
        }
        if (config('bhry98.registration.must_verify_email') && filled($user->email)) {
            $user->must_verify_email = true;
            $user->save();
            $user->refresh();
            $this->sendOtpViaEmail($user->email, UsersVerifyCodeTypes::VerifyEmail);
        }
        //send a welcome message to a user
        if ($user->email) (new UsersNotificationsService())->sendNotificationToUser($user, new SuccessfullyRegistration($user));
        return $user;
    }

    public function sendOtpViaSms($phoneNumber, UsersVerifyCodeTypes $forType): ?UsersVerifyCodesModel
    {
        $user = UsersCoreModel::query()->where('phone_number', $phoneNumber)->first();
        if (!$user) return null;
        DB::beginTransaction();
        if ($this->userHasManyVerifyCodesAttempt($user, $forType)) return null;
        UsersVerifyCodesModel::query()->where('user_id', $user->id)->update(['valid' => false]);
        $code = UsersVerifyCodesModel::query()->create(["user_id" => $user->id, "type" => $forType]);
        app(OtpSenderInterface::class)->sendOtp($user->phone_number, $code->verify_code);
        if ((bool)$code) {
            DB::commit();
            return $code;
        } else {
            DB::rollBack();
            return null;
        }
    }

    public function sendOtpViaEmail($email, UsersVerifyCodeTypes $forType): ?UsersVerifyCodesModel
    {
        $user = UsersCoreModel::query()->where('email', $email)->first();
        if (!$user) return null;
        DB::beginTransaction();
        if ($this->userHasManyVerifyCodesAttempt($user, $forType)) return null;
        UsersVerifyCodesModel::query()->where('user_id', $user->id)->update(['valid' => false]);
        $code = UsersVerifyCodesModel::query()->create(["user_id" => $user->id, "type" => $forType]);
        $user->notifyNow(new VerifyCode($code));
        if ((bool)$code) {
            DB::commit();
            return $code;
        } else {
            DB::rollBack();
            return null;
        }
    }

    public function userHasManyVerifyCodesAttempt(UsersCoreModel $user, UsersVerifyCodeTypes $codeType): bool
    {
        $attempt = UsersVerifyCodesModel::query()
            ->where([
                'user_id' => $user->id,
                "type" => $codeType,
            ])->whereDate('created_at', '>=', now()->subHour())->count();
        return $attempt >= config('bhry98.otp_attempt_limit', 5);
    }

    public function loginByType(string $userIdentifier, string $password): ?string
    {
        $columnName = config("bhry98.login_type")->getColumnName() ?? "username";
        if (auth()->attempt(["$columnName" => $userIdentifier, "password" => $password])) {
            $userExists = UsersCoreModel::query()->where("$columnName", $userIdentifier)->first();
            return self::loginViaUser($userExists);
        }
        return null;
    }

    public function loginViaUser(UsersCoreModel|Authenticatable $user): ?string
    {
        Auth::loginUsingId($user->id);
        $tokenResult = $user->createToken($user->code);
        if (!auth()->check()) return null;
        $loginType = config('bhry98.login_type');
        if ($tokenResult && !UsersLoginTypes::isValid($loginType)) return $tokenResult->plainTextToken;
        if ($tokenResult && $loginType == UsersLoginTypes::PhoneOtp && filled($user->phone_number)) {
            $user->must_verify_phone = true;
            $user->save();
            $user->refresh();
            $this->sendOtpViaSms($user->phone_number, UsersVerifyCodeTypes::VerifyPhone);
        }
        if ($tokenResult && $loginType == UsersLoginTypes::EmailOtp && filled($user->email)) {
            $user->must_verify_email = true;
            $user->save();
            $user->refresh();
            $this->sendOtpViaEmail($user->email, UsersVerifyCodeTypes::VerifyEmail);
        }
        return $tokenResult->plainTextToken;
    }

    public function getAuthUser(array|null $relations = null): ?Authenticatable
    {
        $user = UsersCoreModel::query()->where('id', Auth::id());
        if ($user && $relations) $user->with($relations);
        return $user->first();
    }

    public function verifyCode(int $code, string $type): ?UsersVerifyCodesModel
    {
        if (!auth()->check()) return null;
        $codeRecord = UsersVerifyCodesModel::query()->where([
            "user_id" => auth()->id(),
            "valid" => true,
            "type" => $type,
            "verify_code" => $code
        ])->first();
        $bool = $codeRecord && Carbon::parse($codeRecord->expired_at ?? now()->subMinute())?->isFuture();
        $user = UsersCoreModel::query()->where('id', auth()->id())->first();
        switch ($codeRecord?->type) {
            case UsersVerifyCodeTypes::VerifyPhone:
                $user->update(['must_verify_phone' => false]);
                break;
            case UsersVerifyCodeTypes::VerifyEmail:
                $user->update(['must_verify_email' => false]);
                break;
            case UsersVerifyCodeTypes::ResetPassword:
                $user->update(['must_change_password' => false]);
                break;
        }
        $codeRecord?->update(['valid' => false]);
        $codeRecord?->refresh();
        return $bool ? $codeRecord : null;
    }

    public function sendResetPasswordCodeViaEmail(?string $email): ?string
    {
        if (!$email) return null;
        $user = UsersCoreModel::query()->where('email', $email)->first();
        if (!$user) return null;
        $this->sendOtpViaEmail($email, UsersVerifyCodeTypes::ResetPassword);
        $user->update(['must_change_password' => true]);
        Auth::loginUsingId($user->id);
        $tokenResult = $user->createToken($user->code);
        return $tokenResult->plainTextToken;
    }

    public function sendResetPasswordCodeViaSms(?string $phoneNumber): ?string
    {
        if (!$phoneNumber) return null;
        $user = UsersCoreModel::query()->where('phone_number', $phoneNumber)->first();
        if (!$user) return null;
        $this->sendOtpViaSms($phoneNumber, UsersVerifyCodeTypes::ResetPassword);
        $user->update(['must_change_password' => true]);
        Auth::loginUsingId($user->id);
        $tokenResult = $user->createToken($user->code);
        return $tokenResult->plainTextToken;
    }

    public function logout(): bool
    {
        Auth::user()?->currentAccessToken()->delete();
        Auth::forgetUser();
        return !auth()->check();
    }

    ////////////////////
//    public function loginByUsername(string $username, string $password): ?string
//    {
//        if (auth()->attempt(["username" => $username, "password" => $password])) {
//            $userExists = UsersCoreModel::query()->where('username', $username)->first();
//            return self::loginViaUser($userExists);
//        }
//        return null;
//    }
//
//    public function loginByEmail(string $email, string $password): ?string
//    {
//        if (auth()->attempt(["email" => $email, "password" => $password])) {
//            $userExists = UsersCoreModel::query()->where('email', $email)->first();
//            return self::loginViaUser($userExists);
//        }
//        return null;
//    }
//
//    public function loginByPhoneNumber(string $phoneNumber, string $password): ?string
//    {
//        if (auth()->attempt(["phone_number" => $phoneNumber, "password" => $password])) {
//            $userExists = UsersCoreModel::query()->where('phone_number', $phoneNumber)->first();
//            return self::loginViaUser($userExists);
//        }
//        return null;
//    }
//
//
//
//
//    public function userHasManyResetPasswordAttempt(UsersCoreModel $user): bool
//    {
//        $attempt = UsersVerifyCodesModel::query()
//            ->where([
//                'user_id' => $user->id,
//                "type" => UsersVerifyCodeTypes::ResetPassword,
//            ])
//            ->whereDate('created_at', '>=', now()->subHour())
//            ->count();
//        return $attempt >= config('bhry98.otp_attempt_limit', 5);
//    }
//

//    public function sendResetPasswordCodeViaSms($phoneNumber): bool
//    {
//        $user = UsersCoreModel::query()->where('phone_number', $phoneNumber)->first();
//        if (!$user) return false;
//        if ($this->userHasManyResetPasswordAttempt($user)) return false;
//        $send = $this->sendOtpViaSms($phoneNumber, UsersVerifyCodeTypes::ResetPassword);
//        $user->update(['must_change_password' => true]);
//        return (bool)$send;
//    }
//
//    public function getTokenForResetPassword(?string $userIdentifier): ?string
//    {
//        $user = UsersCoreModel::query()->where('email', $userIdentifier)->orWhere('phone_number', $userIdentifier)->first();
//        if (!$user) return false;
//        $login = self::loginViaUser($user);
//        if ($login) {
//            $user->must_change_password = true;
//            $user->save();
//            return $login;
//        }
//        return null;
//    }
//
//    public function verifyPhoneNumber($phoneNumber): bool
//    {
//        $user = UsersCoreModel::query()->where('phone_number', $phoneNumber)->first();
//        if (!$user) return false;
//        $user->must_verify_phone = false;
//        $user->phone_number_verified_at = Carbon::now();
//        return $user->save();
//    }
//
//    public function verifyEmail($email): bool
//    {
//        $user = UsersCoreModel::query()->where('email', $email)->first();
//        if (!$user) return false;
//        $user->must_verify_email = false;
//        $user->email_verified_at = Carbon::now();
//        return $user->save();
//    }

//    public function verifyResetPasswordCode(?string $userIdentifier): bool
//    {
//        $user = UsersCoreModel::query()->where('email', $userIdentifier)->orWhere('phone_number', $userIdentifier)->first();
//        if (!$user) return false;
//        $user->must_change_password = false;
//        return $user->save();
//    }

}
