<?php

namespace Bhry98;

use Bhry98\GP\Models\GPPermissionsModel;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class Bhry98AuthServiceProvider extends ServiceProvider
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
        try {
            // لو الاتصال شغال
            DB::connection()->getPdo();
            if (Schema::hasTable((new GPPermissionsModel)->getTable())) {
                $permission = GPPermissionsModel::query()->pluck('code')->toArray();
                Cache::put('permissions', $permission);
            }
        } catch (\Throwable $e) {
            // لو مفيش اتصال بالـ DB أو مشكلة في الجدول → نتخطى
            // ممكن تكتب Log بدل skip
            logger()->warning("Skipping permission cache update: " . $e->getMessage());
        }
    }
}
