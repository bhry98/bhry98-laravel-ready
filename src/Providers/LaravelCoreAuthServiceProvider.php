<?php

namespace Bhry98\Bhry98LaravelReady\Providers;

use Bhry98\Bhry98LaravelReady\Models\rbac\RBACPermissionsModel;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

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
        // get all permissions from the cache or get from a database and restore in cache
        if (!Cache::has('permissions')) {
            self::updatePermissionInCache();
        }
        $permission = Cache::get('permissions');
        foreach ($permission as $p) {
            Gate::define($p, function ($User) use ($p) {
                return $User->hasPermission($p);
            });
        }
    }

    function updatePermissionInCache(): void
    {
        $permission = RBACPermissionsModel::query()->pluck('code')->toArray();
        Cache::put('permissions', $permission);
    }
}
