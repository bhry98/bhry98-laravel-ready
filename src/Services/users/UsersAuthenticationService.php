<?php

namespace Bhry98\Bhry98LaravelReady\Services\users;

use Bhry98\Bhry98LaravelReady\Models\users\UsersADManagerUsersModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Services\BaseService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use LdapRecord\Auth\PasswordRequiredException;
use LdapRecord\Auth\UsernameRequiredException;
use LdapRecord\Container;
use LdapRecord\ContainerException;
use LdapRecord\Models\ActiveDirectory\User;

class UsersAuthenticationService extends BaseService
{
    /**
     * @throws ContainerException
     * @throws UsernameRequiredException
     * @throws PasswordRequiredException
     */
    public function login(string $samAccountName, string $password): ?string
    {
        // check if password correct from ldap
        # set connection to ldap
        $connection = Container::getConnection('prod');
        # get a user object from ldap by samAccountName (to get user base dn)
        $user = User::query()->findBy('samaccountname', $samAccountName);
        if (!$user) return false;
        # verify password with ldap
        if ($connection->auth()->attempt($user->getDn(), $password)) {
            // check if a user exists in the local database users table
            $userExists = UsersADManagerUsersModel::query()
                ->where('sam_account_name', $samAccountName)
                ->whereHas('user')
                ->first();
            if (!$userExists) return false;
            $userExists->user->password = $password;
            $userExists->user->save();
            return self::loginViaUser($userExists->user);
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
