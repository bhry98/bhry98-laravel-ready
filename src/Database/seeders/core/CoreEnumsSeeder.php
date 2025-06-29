<?php

namespace Bhry98\Bhry98LaravelReady\Database\seeders\core;

use Bhry98\Bhry98LaravelReady\Models\enums\EnumsCoreModel;
use Illuminate\Database\Seeder;

class CoreEnumsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        self::seedByFileName('users');
    }

    function seedByFileName($fileName): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $enums = include __DIR__ . "$ds..$ds..{$ds}data{$ds}enums$ds$fileName.php";
        foreach ($enums ?? [] as $key => $enum) {
            foreach ($enum ?? [] as $enumValue) {
                $enumRecord = EnumsCoreModel::query()->updateOrCreate(
                    [
                        'default_name' => array_key_exists('default_name', $enumValue) ? $enumValue['default_name'] : $enumValue['locales']['en'],
                        'type' => $enumValue['type'],
                    ],
                    [
                        'default_name' => array_key_exists('default_name', $enumValue) ? $enumValue['default_name'] : $enumValue['locales']['en'],
                        'type' => $enumValue['type'],
                        'default_color' => self::getHexColor($enumValue['default_color']??""),
                        'api_access' => $enumValue['api_access'],
                        'can_delete' => $enumValue['can_delete'],
                        'parent_id' => $enumValue['parent_id'],
                    ]);
                foreach ($enumValue['locales'] ?? [] as $local => $value) {
                    $enumRecord->setLocalized(column: 'name', value: $value, locale: $local);
                }
            }
        }
    }

    function getHexColor(string $color): string
    {
        return match ($color) {
            'red' => '#b0171d',
            'orange' => '#f6b26b',
            'azure', 'blue' => '#4ba9fd',
            'pink' => '#ff54b8',
            'green' => '#6aa84f',
            default => '#bcbcbc',
        };
    }

}
