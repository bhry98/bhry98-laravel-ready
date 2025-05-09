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
        $enums = include __DIR__ . "$ds..$ds..{$ds}data{$ds}enums{$ds}$fileName.php";;
        foreach ($enums ?? [] as $key => $enum) {
            foreach ($enum ?? [] as $enumValue) {
                $enumRecord = EnumsCoreModel::query()->updateOrCreate(
                    [
                        'default_name' => $enumValue['locales']['en'],
                        'type' => $enumValue['type'],
                        'module' => $enumValue['module'],
                    ],
                    [
                        'default_name' => $enumValue['locales']['en'],
                        'type' => $enumValue['type'],
                        'module' => $enumValue['module'],
                        'default_color' => array_key_exists('default_color', $enumValue) ? $enumValue['default_color'] : "gray",
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

}
