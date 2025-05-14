<?php

namespace Bhry98\Bhry98LaravelReady\Services\users;

use Bhry98\Bhry98LaravelReady\Models\users\UsersADManagerUsersModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Services\BaseService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
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

    public function logout(): bool
    {
        bhry98_add_log(level: 'info', message: 'User logout', context: ['user' => Auth::user()?->identity_code ?? '']);
        Auth::user()?->currentAccessToken()->delete();
        Auth::forgetUser();
        return !auth()->check();
    }
}
