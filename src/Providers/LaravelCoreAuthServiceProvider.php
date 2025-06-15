<?php

namespace Bhry98\Bhry98LaravelReady\Providers;

use Bhry98\Bhry98LaravelReady\Models\rbac\RBACPermissionsModel;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class LaravelCoreAuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        $this->registerPolicies();
        if (!Cache::has('permissions')) self::updatePermissionInCache();
        $permissions = Cache::get('permissions');
        foreach ($permissions ?? [] as $permissionCode) {
            Gate::define($permissionCode, function ($user) use ($permissionCode) {
                return $user->hasPermission($permissionCode);
            });
        }
    }
    function updatePermissionInCache(): void
    {
        if (Schema::hasTable(RBACPermissionsModel::TABLE_NAME)) {
            $permission = RBACPermissionsModel::query()->pluck('code')->toArray();
            Cache::put('permissions', $permission);
        }
    }
}
