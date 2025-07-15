<?php

namespace Bhry98\Bhry98LaravelReady\Helpers\loads;

use Bhry98\Bhry98LaravelReady\Filament\Pages\Applications\ApplicationsSwitcher;
use Bhry98\Bhry98LaravelReady\Helpers\logs\LoggerHandler;
use Bhry98\Bhry98LaravelReady\Models\media\MediaLibraryModel;
use Bhry98\Bhry98LaravelReady\Models\queue\QueueJobBatchesModel;
use Bhry98\Bhry98LaravelReady\Models\queue\QueueJobFailedModel;
use Bhry98\Bhry98LaravelReady\Models\queue\QueueJobModel;
use Bhry98\Bhry98LaravelReady\Models\sessions\SessionsModel;
use Bhry98\Bhry98LaravelReady\Models\settings\SettingsCoreModel;
use Filament\Facades\Filament;
use Filament\Panel;
use Filament\View\PanelsRenderHook;

class LaravelCoreConfigLoad
{
    static function load(): void
    {
        (new LaravelCoreConfigLoad)->sessionsConfig();
        (new LaravelCoreConfigLoad)->loggingConfig();
        (new LaravelCoreConfigLoad)->cacheConfig();
        (new LaravelCoreConfigLoad)->authConfig();
        (new LaravelCoreConfigLoad)->mediaLibraryConfig();
        (new LaravelCoreConfigLoad)->settingsConfig();
        (new LaravelCoreConfigLoad)->mailConfig();
        (new LaravelCoreConfigLoad)->queueConfig();
        (new LaravelCoreConfigLoad)->filamentLanguageSwitcherConfig();
    }

    private function sessionsConfig(): void
    {
        config()->set('session.driver', 'database');
        config()->set(key: 'session.table', value: SessionsModel::TABLE_NAME);
        config()->set(key: 'session.lifetime', value: 120);
        config()->set(key: 'session.expire_on_close', value: false);
        config()->set(key: 'session.encrypt', value: false);
        config()->set(key: 'session.files', value: storage_path(path: 'framework/sessions'));
        config()->set(key: 'session.lottery', value: [2, 100]);
    }

    private function queueConfig(): void
    {
        config()->set('queue.default', 'database');
        config()->set('queue.connections.database', value: [
            'driver' => 'database',
            'connection' => "mysql",
            'table' => QueueJobModel::TABLE_NAME,
            'queue' => "database",
            'retry_after' => (int)env('DB_QUEUE_RETRY_AFTER', 90),
            'after_commit' => false,
        ]);
        config()->set('queue.batching', value: [
            'database' => 'mysql',
            'table' => QueueJobBatchesModel::TABLE_NAME,
        ]);
        config()->set('queue.failed', value: [
            'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
            'database' => 'mysql',
            'table' => QueueJobFailedModel::TABLE_NAME,
        ]);
    }

    private function loggingConfig(): void
    {
        config()->set(key: 'logging.channels.database', value: [
            'driver' => 'custom',
            'via' => LoggerHandler::class,
            'ignore_exceptions' => false,
        ]);
        config()->set('logging.default', env("B_LOGS", 'file'));
    }

    private function cacheConfig(): void
    {
        config()->set('cache.default', env("B_CACHE", 'file'));
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
        config()->set('mail.default', "smtp");
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

    private function filamentLanguageSwitcherConfig(): void
    {
        if (config("bhry98.filament.multi-panels", false)) {
            foreach (Filament::getPanels() as $panel) {
                $panel
                    ->pages([
                        ApplicationsSwitcher::class
                    ])
                    ->renderHook(
                        PanelsRenderHook::USER_MENU_BEFORE,
                        fn() => view('Bhry98::applications.application-switcher-btn')
                    );
            }
        }
//        Filament::serving(function () {
//            foreach (Filament::getPanels() as $panel) {
////                if ($panel->getId() == "corporate") dd($panel->getId());
//                $panel->renderHook(
//                    PanelsRenderHook::USER_MENU_BEFORE,
//                    fn() => view('Bhry98::applications.application-switcher-btn')
//                );
//            }
//        });
        config()->set('filament-translation-component.languages', [
            "en" => [
                "label" => "English",
                "flag" => "us"
            ],
            "ar" => [
                "label" => "Arabic",
                "flag" => "eg"
            ],
        ]);
    }
}
