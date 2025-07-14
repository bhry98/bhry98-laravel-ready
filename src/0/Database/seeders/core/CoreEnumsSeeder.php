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
        foreach ($enums ?? [] as  $enum) {
            foreach ($enum ?? [] as $enumValue) {
                $defaultName = $enumValue["names"]['en'];
                $defaultDescription = $enumValue["descriptions"]['en'] ?? null;
                $enumRecord = EnumsCoreModel::query()->updateOrCreate(
                    [
                        'default_name' => $defaultName,
                        'type' => $enumValue['type'],
                    ],
                    [
                        'type' => $enumValue['type'],
                        'default_name' => $defaultName,
                        'default_description' => $defaultDescription,
                        "icon" => $enumValue['icon']??null,
                        "color" => $enumValue['color'],
                        "ordering" => EnumsCoreModel::query()->where(['type' => $enumValue['type']])->max('ordering') + 1,
                        'parent_id' => $enumValue['parent_id'],
                    ]);
                foreach ($enumValue['names'] ?? [] as $nameLocal => $nameValue) {
                    if ($nameValue) $enumRecord->setLocalized('name', $nameValue, $nameLocal);
                }
                foreach ($enumValue['descriptions'] ?? [] as $descriptionLocal => $descriptionValue) {
                    if ($descriptionValue) $enumRecord->setLocalized('description', $descriptionValue, $descriptionLocal);
                }
            }
        }
    }
}
