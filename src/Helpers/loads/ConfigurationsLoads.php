<?php

namespace Bhry98\Helpers\loads;

use Bhry98\Helpers\models\QueueJobBatchesModel;
use Bhry98\Helpers\models\QueueJobFailedModel;
use Bhry98\Helpers\models\QueueJobModel;
use Bhry98\Helpers\models\SessionsModel;
use Bhry98\Settings\Models\SettingsCoreModel;
use Bhry98\Users\Models\UsersAuthenticationLogModel;
use Bhry98\Users\Models\UsersPersonalAccessTokenModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class ConfigurationsLoads extends ServiceProvider
{
    public function boot(): void
    {
        self::sessionsConfig();
        self::authConfig();
        self::queueConfig();
        self::loggingConfig();
        self::settingsConfig();
        self::mailConfig();
        self::authenticationLogConfig();
    }

    private function sessionsConfig(): void
    {
        Sanctum::usePersonalAccessTokenModel(UsersPersonalAccessTokenModel::class);
        config()->set('session.driver', 'database');
        config()->set('session.table', (new SessionsModel)->getTable());
        config()->set('session.lifetime', 120);
        config()->set('session.expire_on_close', false);
        config()->set('session.encrypt', false);
        config()->set('session.files', storage_path('framework/sessions'));
        config()->set('session.lottery', [2, 100]);
    }

    private function authConfig(): void
    {

    }

    private function queueConfig(): void
    {
        config()->set("queue.connections.database", [
            'driver' => 'database',
            'connection' => "mysql",
            'table' => (new QueueJobModel)->getTable(),
            'queue' => env('DB_QUEUE', 'default'),
            'retry_after' => (int)env('DB_QUEUE_RETRY_AFTER', 90),
            'after_commit' => false,
        ]);
        config()->set("queue.default", 'database');
        config()->set("queue.batching", [
            'database' => env('DB_CONNECTION', 'sqlite'),
            'table' => (new QueueJobBatchesModel)->getTable(),
        ]);
        config()->set("queue.failed", [
            'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
            'database' => env('DB_CONNECTION', 'sqlite'),
            'table' => (new QueueJobFailedModel)->getTable(),
        ]);
    }

    private function loggingConfig(): void
    {
        if (Schema::hasTable('logs_system')) {
            config()->set('logging.channels.database.driver', 'custom');
            config()->set('logging.channels.database.via', LoggerHandler::class);
            config()->set('logging.channels.database.ignore_exceptions', false);
            config()->set('logging.default', 'database');
        }
    }

    private function settingsConfig(): void
    {
        config()->set('settings.table', (new SettingsCoreModel)->getTable());
        config()->set('settings.driver', "eloquent");
        config()->set('settings.teams', false);
    }

    private function authenticationLogConfig(): void
    {
        config()->set('authentication-log.table_name', (new UsersAuthenticationLogModel())->getTable());
        config()->set('authentication-log.notifications.new-device.location', false);
        config()->set('authentication-log.notifications.failed-login.location', false);
    }

    private function mailConfig(): void
    {
//        config()->set('mail.default', "smtp");
        config()->set('mail.mailers.smtp', [
            'transport' => 'smtp',
            'scheme' => env('MAIL_SCHEME'),
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', "mail0.serv00.com"),
            'port' => (int)env('MAIL_PORT', 465),
            'username' => env('MAIL_USERNAME', "code.faster@bhry98.serv00.net"),
            'password' => env('MAIL_PASSWORD', "P@ssw0rd"),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
        ]);
        config()->set('mail.from', [
            'address' => env('MAIL_FROM_ADDRESS', 'code.faster@bhry98.serv00.net'),
            'name' => env('MAIL_FROM_NAME', 'Code Faster'),
        ]);
    }
}