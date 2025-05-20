<?php

namespace Bhry98\Bhry98LaravelReady;

use Bhry98\Bhry98LaravelReady\Console\Commands\seeds\UpdateEnumsData;
use Bhry98\Bhry98LaravelReady\Console\Commands\seeds\UpdateLocationsData;
use Bhry98\Bhry98LaravelReady\Console\Commands\seeds\UpdateRBACData;
use Bhry98\Bhry98LaravelReady\Exceptions\HandlerUnAuthenticatedException;
use Bhry98\Bhry98LaravelReady\Helpers\CreateCustomLogger;
use Bhry98\Bhry98LaravelReady\Models\logs\LogsSystemModel;
use Bhry98\Bhry98LaravelReady\Models\media\MediaLibraryModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACPermissionsModel;
use Bhry98\Bhry98LaravelReady\Models\sessions\SessionsCoreModel;
use Bhry98\Bhry98LaravelReady\Models\sessions\SessionsPersonalAccessTokenModel;
use Bhry98\Bhry98LaravelReady\Models\cache\CacheCoreModel;
use Bhry98\Bhry98LaravelReady\Models\cache\CacheLocksModel;
use Bhry98\Bhry98LaravelReady\Models\settings\SettingsCoreModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersNotificationsModel;
use Bhry98\Bhry98LaravelReady\Providers\LaravelCoreAuthServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class Bhry98LaravelReadyServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        self::loadPackageFiles();
        $this->app->singleton(abstract: ExceptionHandler::class, concrete: HandlerUnAuthenticatedException::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        self::loadMigrationFiles();
        self::loadCommands();
        self::loadRoutes();
        self::loadTranslations();
        try {
            DB::connection()->getPdo();
//            \Illuminate\Notifications\Notification::useDatabaseNotificationModel(UsersNotificationsModel::class);
            self::setDefaultConfiguration();
            self::overridingDefaultPersonalAccessTokenModels();
            if (Schema::hasTable(RBACPermissionsModel::TABLE_NAME)) {
                $this->app->register(LaravelCoreAuthServiceProvider::class);
            }
        } catch (\Throwable $e) {
        }


        $this->publishes([
            __DIR__ . '/Config/bhry98.php' => config_path('bhry98.php'),
        ]);
    }

    function overridingDefaultPersonalAccessTokenModels(): void
    {
        try {
            Sanctum::usePersonalAccessTokenModel(model: SessionsPersonalAccessTokenModel::class);
        } catch (\Throwable $e) {
        }
    }

    function loadPackageFiles(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->mergeConfigFrom(path: __DIR__ . "{$ds}Config{$ds}bhry98.php", key: 'bhry98');
    }

    function loadMigrationFiles(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadMigrationsFrom(paths: [
            __DIR__ . "{$ds}Database{$ds}migrations{$ds}cache",
            __DIR__ . "{$ds}Database{$ds}migrations{$ds}enums",
            __DIR__ . "{$ds}Database{$ds}migrations{$ds}identities",
            __DIR__ . "{$ds}Database{$ds}migrations{$ds}localizations",
            __DIR__ . "{$ds}Database{$ds}migrations{$ds}locations",
            __DIR__ . "{$ds}Database{$ds}migrations{$ds}logs",
            __DIR__ . "{$ds}Database{$ds}migrations{$ds}queue",
            __DIR__ . "{$ds}Database{$ds}migrations{$ds}rbac",
            __DIR__ . "{$ds}Database{$ds}migrations{$ds}sessions",
            __DIR__ . "{$ds}Database{$ds}migrations{$ds}users",
            __DIR__ . "{$ds}Database{$ds}migrations{$ds}settings",
        ]);
    }

    function loadCommands(): void
    {
        $this->commands(commands: [
            UpdateLocationsData::class,
            UpdateEnumsData::class,
            UpdateRBACData::class,
        ]);
    }

    function loadRoutes(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadRoutesFrom(path: __DIR__ . "{$ds}Routes{$ds}api.php");
    }

    function loadTranslations(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadTranslationsFrom(path: __DIR__ . "{$ds}Locales", namespace: "Bhry98");
    }

    function setDefaultConfiguration(): void
    {
        //sessions.php config file
        config()->set('session.driver', Schema::hasTable(SessionsCoreModel::TABLE_NAME) ? 'database' : 'file');
        config()->set(key: 'session.table', value: SessionsCoreModel::TABLE_NAME);
        config()->set(key: 'session.lifetime', value: 120);
        config()->set(key: 'session.expire_on_close', value: false);
        config()->set(key: 'session.encrypt', value: false);
        config()->set(key: 'session.files', value: storage_path(path: 'framework/sessions'));
        config()->set(key: 'session.lottery', value: [2, 100]);
        // logging.php config file
        config()->set(key: 'logging.channels.database', value: [
            'driver' => 'custom',
            'via' => CreateCustomLogger::class,
            'ignore_exceptions' => false,
        ]);
        config()->set('logging.default', Schema::hasTable(LogsSystemModel::TABLE_NAME) ? 'database' : 'file');
        // cache.php config file
        config()->set('cache.driver', Schema::hasTable(CacheCoreModel::TABLE_NAME) ? 'database' : 'file');
        config()->set(key: 'cache.stores.database', value: [
            'driver' => 'database',
            'connection' => bhry98_app_settings('session_connection'),
            'table' => CacheCoreModel::TABLE_NAME,
            'lock_connection' => bhry98_app_settings('session_connection'),
            'lock_table' => CacheLocksModel::TABLE_NAME,
        ]);
        // auth.php config file
        config()->set(key: "auth.providers", value: [
            'users' => [
                'driver' => 'eloquent',
                'model' => bhry98_app_settings('users_model'),
            ],
        ]);
        // media_library.php
        config()->set(key: 'media-library.disk_name', value: 'public');
        config()->set(key: 'media-library.media_model', value: MediaLibraryModel::class);
        config()->set(key: 'media-library.queue_connection_name', value: "database");
        // settings
        config()->set(key: 'settings.table', value: SettingsCoreModel::TABLE_NAME);
        config()->set(key: 'settings.driver', value: "eloquent");
        config()->set(key: 'settings.teams', value: false);
    }
}