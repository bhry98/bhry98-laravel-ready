<?php

namespace Bhry98\Bhry98LaravelReady\Providers;

use Bhry98\Bhry98LaravelReady\Helpers\logs\LoggerHandler;
use Bhry98\Bhry98LaravelReady\Models\media\MediaLibraryModel;
use Bhry98\Bhry98LaravelReady\Models\sessions\SessionsModel;
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



    private function cacheConfig(): void
    {
        config()->set('cache.driver', 'file');
    }

    private function mediaLibraryConfig(): void
    {
        config()->set(key: 'media-library.disk_name', value: 'public');
        config()->set(key: 'media-library.media_model', value: MediaLibraryModel::class);
        config()->set(key: 'media-library.queue_connection_name', value: "database");
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