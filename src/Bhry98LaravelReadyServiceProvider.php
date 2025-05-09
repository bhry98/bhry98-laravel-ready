<?php

namespace Bhry98\Bhry98LaravelReady;

use Bhry98\Bhry98LaravelReady\Console\Commands\seeds\UpdateEnumsData;
use Bhry98\Bhry98LaravelReady\Console\Commands\seeds\UpdateLocationsData;
use Bhry98\Bhry98LaravelReady\Console\Commands\seeds\UpdateRBACData;
use Bhry98\Bhry98LaravelReady\Console\Commands\seeds\UpdateUSERSData;
use Bhry98\Bhry98LaravelReady\Console\Commands\seeds\UpdateUsersFromADManagerToLocal;
use Bhry98\Bhry98LaravelReady\Console\Commands\UpdateCoreDatabase;
use Bhry98\Bhry98LaravelReady\Exceptions\HandlerUnAuthenticatedException;
use Bhry98\Bhry98LaravelReady\Helpers\CreateCustomLogger;
use Bhry98\Bhry98LaravelReady\Models\sessions\SessionsCoreModel;
use Bhry98\Bhry98LaravelReady\Models\sessions\SessionsPersonalAccessTokenModel;
use Bhry98\Bhry98LaravelReady\Models\cache\CacheCoreModel;
use Bhry98\Bhry98LaravelReady\Models\cache\CacheLocksModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Providers\LaravelCoreAuthServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use PDO;

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
        self::setDefaultConfiguration();
        self::overridingDefaultPersonalAccessTokenModels();
        self::loadMigrationFiles();
        self::loadCommands();
        self::loadRoutes();
        self::loadTranslations();
        $this->app->register(LaravelCoreAuthServiceProvider::class);
    }

    function overridingDefaultPersonalAccessTokenModels(): void
    {
        Sanctum::usePersonalAccessTokenModel(model: SessionsPersonalAccessTokenModel::class);
    }

    function loadPackageFiles(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->mergeConfigFrom(path: __DIR__ . "{$ds}Config{$ds}bhry98.php", key: 'bhry98');
    }

    function loadMigrationFiles(): void
    {
        // Only run this logic in the console (artisan)
        if (!App::runningInConsole()) {
            return;
        }

        // Get current artisan input
        $input = $_SERVER['argv'] ?? [];

        // Find the `--database=core` flag
        $usesCoreConnection = collect($input)->contains(function ($arg) {
            return str_starts_with($arg, '--database=core');
        });

        if (!$usesCoreConnection) {
            return;
        }
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
        ]);
    }

    function loadCommands(): void
    {
        $this->commands(commands: [
            UpdateCoreDatabase::class,
            UpdateLocationsData::class,
            UpdateEnumsData::class,
            UpdateRBACData::class,
            UpdateUSERSData::class,
            UpdateUsersFromADManagerToLocal::class,
        ]);
    }

    function loadRoutes(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadRoutesFrom(path: __DIR__ . "{$ds}Routes{$ds}api.php");
//        // Register routes with middleware
//        Route::middleware(['api', ])
//            ->group(__DIR__ . "{$ds}Routes{$ds}api.php");
    }

    function loadTranslations(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->loadTranslationsFrom(path: __DIR__ . "{$ds}Locales", namespace: "Bhry98");
    }

    function setDefaultConfiguration(): void
    {

        // database.php config file
        config()->set(key: "database.default", value: "app");
        config()->set(key: 'database.connections.core', value: [
            'driver' => 'mysql',
            'url' => '',
            'host' => bhry98_core_settings(key: 'db_host'),
            'port' => bhry98_core_settings(key: 'db_port'),
            'database' => bhry98_core_settings(key: 'db_name'),
            'username' => bhry98_core_settings(key: 'db_username'),
            'password' => bhry98_core_settings(key: 'db_password'),
            'unix_socket' => env(key: 'DB_SOCKET', default: ''),
            'charset' => env(key: 'DB_CHARSET', default: 'utf8mb4'),
            'collation' => env(key: 'DB_COLLATION', default: 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded(extension: 'pdo_mysql') ? array_filter([PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),]) : [],

        ]);
        config()->set(key: 'database.connections.app', value: [
            'driver' => 'mysql',
            'url' => '',
            'host' => bhry98_app_settings(key: 'db_host'),
            'port' => bhry98_app_settings(key: 'db_port'),
            'database' => bhry98_app_settings(key: 'db_name'),
            'username' => bhry98_app_settings(key: 'db_username'),
            'password' => bhry98_app_settings(key: 'db_password'),
            'unix_socket' => env(key: 'DB_SOCKET', default: ''),
            'charset' => env(key: 'DB_CHARSET', default: 'utf8mb4'),
            'collation' => env(key: 'DB_COLLATION', default: 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded(extension: 'pdo_mysql') ? array_filter([PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),]) : [],

        ]);
        //sessions.php config file
        config()->set(key: 'session.connection', value: 'core');
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
        // cache.php config file
        config()->set(key: 'cache.default', value: 'database');
        config()->set(key: 'cache.stores.database', value: [
            'driver' => 'database',
            'connection' => "core",
            'table' => CacheCoreModel::TABLE_NAME,
            'lock_connection' => "core",
            'lock_table' => CacheLocksModel::TABLE_NAME,
        ]);
        // ldap.php config file
        config()->set(key: 'ldap.default', value: "prod");
        config()->set(key: 'ldap.connections.prod', value: [
            'hosts' => bhry98_core_settings(key: 'ldap_hosts'),
            'username' => bhry98_core_settings(key: 'ldap_username'),
            'password' => bhry98_core_settings(key: 'ldap_password'),
            'port' => bhry98_core_settings(key: 'ldap_port'),
            'base_dn' => bhry98_core_settings(key: 'ldap_base_dn'),
            'timeout' => 5,
            'use_ssl' => bhry98_core_settings(key: 'ldap_use_ssl'),
            'use_tls' => bhry98_core_settings(key: 'ldap_use_tls'),
            'use_sasl' => bhry98_core_settings(key: 'ldap_use_sasl'),
            'sasl_options' => [
                // 'mech' => 'GSSAPI',
            ],
        ]);
        config()->set(key: 'ldap.cache', value: [
            'enabled' => true,
            'driver' => "database",
        ]);
        config()->set(key: 'ldap.logging', value: [
            'enabled' => true,
            'channel' => "database",
            'level' => env('LOG_LEVEL', 'info'),
        ]);
        // auth.php config file
        config()->set(key: "auth.providers", value: [
            'users' => [
                'driver' => 'eloquent',
                'model' => UsersCoreUsersModel::class,
            ],
        ]);
        /////////////////////////////////////////////////
        if (DB::connection(name: 'core')->getDatabaseName()) {
            config()->set(key: 'session.driver', value: 'database');
            config()->set(key: 'logging.default', value: 'database');
        } else {
            config()->set(key: 'session.driver', value: 'file');
            config()->set(key: 'logging.default', value: 'file');
        }
    }
}