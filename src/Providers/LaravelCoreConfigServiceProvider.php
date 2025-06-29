<?php

namespace Bhry98\Bhry98LaravelReady\Providers;

use Bhry98\Bhry98LaravelReady\Helpers\logs\CreateCustomLogger;
use Bhry98\Bhry98LaravelReady\Models\media\MediaLibraryModel;
use Bhry98\Bhry98LaravelReady\Models\sessions\SessionsCoreModel;
use Bhry98\Bhry98LaravelReady\Models\settings\SettingsCoreModel;
use Illuminate\Support\ServiceProvider;

class LaravelCoreConfigServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        self::sessionsConfig();
        self::loggingConfig();
        self::cacheConfig();
        self::authConfig();
        self::mediaLibraryConfig();
        self::settingsConfig();
        self::mailConfig();
    }

    private function sessionsConfig(): void
    {
        config()->set('session.driver', 'database');
        config()->set(key: 'session.table', value: SessionsCoreModel::TABLE_NAME);
        config()->set(key: 'session.lifetime', value: 120);
        config()->set(key: 'session.expire_on_close', value: false);
        config()->set(key: 'session.encrypt', value: false);
        config()->set(key: 'session.files', value: storage_path(path: 'framework/sessions'));
        config()->set(key: 'session.lottery', value: [2, 100]);
    }

    private function loggingConfig(): void
    {
        config()->set(key: 'logging.channels.database', value: [
            'driver' => 'custom',
            'via' => CreateCustomLogger::class,
            'ignore_exceptions' => false,
        ]);
        config()->set('logging.default', 'database');
    }

    private function cacheConfig(): void
    {
        config()->set('cache.driver', 'file');
    }

    private function authConfig(): void
    {
        config()->set(key: "auth.providers", value: [
            'users' => [
                'driver' => 'eloquent',
                'model' => bhry98_app_settings('users_model'),
            ],
        ]);
    }

    private function mediaLibraryConfig(): void
    {
        config()->set(key: 'media-library.disk_name', value: 'public');
        config()->set(key: 'media-library.media_model', value: MediaLibraryModel::class);
        config()->set(key: 'media-library.queue_connection_name', value: "database");
    }

    private function settingsConfig(): void
    {
        config()->set(key: 'settings.table', value: SettingsCoreModel::TABLE_NAME);
        config()->set(key: 'settings.driver', value: "eloquent");
        config()->set(key: 'settings.teams', value: false);
    }

    private function mailConfig(): void
    {
        config()->set('mail.mailers.smtp', [
            'transport' => 'smtp',
            'scheme' => env(key: 'B_MAIL_SCHEME'),
            'url' => env(key: 'B_MAIL_URL'),
            'host' => env(key: 'B_MAIL_HOST', default: "mail0.serv00.com"),
            'port' => env(key: 'B_MAIL_PORT', default: 465),
            'username' => env(key: 'B_MAIL_USERNAME', default: "code.faster@bhry98.serv00.net"),
            'password' => env(key: 'B_MAIL_PASSWORD', default: "P@ssw0rd"),
            'timeout' => null,
            'local_domain' => env(key: 'MAIL_EHLO_DOMAIN', default: parse_url(env(key: 'APP_URL', default: 'http://localhost'), component: PHP_URL_HOST)),
        ]);
        config()->set('mail.from', [
            'address' => env(key: 'B_MAIL_FROM_ADDRESS', default: 'code.faster@bhry98.serv00.net'),
            'name' => env(key: 'B_MAIL_FROM_NAME', default: 'Code Faster'),
        ]);
    }
}
