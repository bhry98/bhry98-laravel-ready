<?php

namespace Bhry98\Bhry98LaravelReady\Services\users;

use Bhry98\Bhry98LaravelReady\Models\users\UsersADManagerUsersModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Services\BaseService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UsersADManagerManagementService extends BaseService
{
    static function ADManagerBaseUrl(): string
    {
        $host = bhry98_core_settings(key: "adm_host");
        $port = bhry98_core_settings(key: "adm_port");
        $ssl = bhry98_core_settings(key: "adm_use_ssl");
        return $ssl ? "https://{$host}:{$port}/RestAPI" : "http://{$host}:{$port}/RestAPI";
    }

    public function getAllADManagerUsers(): ?Collection
    {
        $url = self::ADManagerBaseUrl() . "/SearchUser";
        $response = Http::get(url: $url, query: [
            "domainName" => bhry98_core_settings("adm_domain"),
            "AuthToken" => bhry98_core_settings("adm_auth_token"),
            "range" => 99999,
            "startIndex" => 1,
//            "filter"=>"accountStatus",
//            "domainList" => bhry98_core_settings("adm_domain"),
        ]);
        if ($response->successful()) {
            if (array_key_exists(key: "UsersList", array: $response->json())) {
                return collect($response->json()['UsersList']);
            }
            bhry98_add_log(
                level: "error",
                message: "can't get UsersList from success response [ADManager users list ]",
                context: $response->json()
            );
            return null;
        }
        return null;
    }

    public function syncUsersFromADManagerToLocal(): void
    {
        bhry98_add_log(level: "info", message: "start sync from ad-manager users to local database");
        // get all user's collection from azure
        $usersCollection = self::getAllADManagerUsers();
//        dd($usersCollection);;
        // add each user to the ad-manager users table
        $usersCollection->each(function ($user) {
            $fixedUser = collect($user)->mapWithKeys(function ($value, $key) {
                return [Str::lower($key) => $value == "-" ? null : $value];
            });
            $userArray = $fixedUser->toArray();
            // if $user is a model
//            if (isset($userArray['id'])) {
//                $userArray['azure_user_id'] = $userArray['id'];
//                unset($userArray['id']);
//            }
            if (UsersCoreUsersModel::query()->where('email', $userArray['email_address'])->exists()) {
                $userArray['user_id'] = UsersCoreUsersModel::query()->where('email', $userArray['email_address'])->first()->id;
            }

            UsersADManagerUsersModel::query()->updateOrCreate(["object_guid" => $userArray['object_guid']], $userArray);
        });
        bhry98_add_log(level: "info", message: "end sync from ad-manager users to local database");
    }


//    static public function getAll(int $pageNumber = 0, int $perPage = 10, string|null $searchForWord = null, array|null $relations = null): \Illuminate\Pagination\LengthAwarePaginator
//    {
//        $data = UsersADManagerUsersModel::query();
//        if (!empty($searchForWord)) {
//            $data->where('logon_name', 'like', '%' . $searchForWord . '%')
//                ->orWhere('sam_account_name', 'like', '%' . $searchForWord . '%')
//                ->orWhere('ou_name', 'like', '%' . $searchForWord . '%')
//                ->orWhere('email_address', 'like', '%' . $searchForWord . '%')//
//            ;
//            $pageNumber = 0;
//        }
//        if ($data && $relations) {
//            $data->with($relations);
//        }
//        return $data->paginate(
//            perPage: $perPage,
//            page: $pageNumber,
//        );
//    }
//
//    static public function getDetails(string $object_guid, array|null $relations = null): UsersADManagerUsersModel
//    {
//        $data = UsersADManagerUsersModel::query()->where('object_guid', $object_guid);
//        if ($data && $relations) {
//            $data->with($relations);
//        }
//        return $data->first();
//    }
//
//    public function usersStatistics(): array
//    {
//        $statistics = UsersADManagerUsersModel::query()
//            ->select([
//                DB::raw(value: 'COUNT(*) as total'),
//                DB::raw(value: 'COUNT(CASE WHEN account_enabled = true THEN 1 END) as total_active'),
//                DB::raw(value: 'COUNT(CASE WHEN account_enabled = false THEN 1 END) as total_inactive'),
//                DB::raw(value: 'COUNT(CASE WHEN EXISTS (SELECT 1 FROM users_core_users WHERE users_core_users.id = users_ad_manager_users.user_id) THEN 1 END) as total_has_core_user'),
//                DB::raw(value: 'COUNT(CASE WHEN NOT EXISTS (SELECT 1 FROM users_core_users WHERE users_core_users.id = users_ad_manager_users.user_id) THEN 1 END) as total_not_have_core_user'),
//            ])->first();
//        return [
//            'total' => $statistics->total,
//            'total_active' => $statistics->total_active,
//            'total_inactive' => $statistics->total_inactive,
//            'total_has_core_user' => $statistics->total_has_core_user,
//            'total_not_have_core_user' => $statistics->total_not_have_core_user,
//        ];
//    }
//
//    public function addNewUser(UsersCoreUsersModel $coreUser)
//    {
//        // create azure user record
//        $ldapDomain = bhry98_core_settings("default_ldap_domain", "erp.local");
//        $adManagerUser = UsersADManagerUsersModel::query()->updateOrCreate([
//            "user_id" => $coreUser->id,
//            "distinguished_name" => bhry98_core_settings("default_ldap_dn", ""),
//            "domain_name" => $ldapDomain,
//            "ou_name" => "Users",
//            "sam_account_name" => $coreUser->username,
//            "logon_name" => "$coreUser->username@$ldapDomain",
//            "first_name" => $coreUser->first_name,
//            "last_name" => $coreUser->last_name,
//            "display_name" => $coreUser->display_name,
//            "city" => $coreUser->city?->name,
//            "country" => $coreUser->country?->name,
//            "email_address" => $coreUser->email,
//            "mobile" => $coreUser->phone_number,
//        ]);
//        //TODO dispatch job to sync with azure
//        Log::info(message: "create new adManager user record", context: ['user' => $adManagerUser]);
//        return $adManagerUser;
//    }

}
