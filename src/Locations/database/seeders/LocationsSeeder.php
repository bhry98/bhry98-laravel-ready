<?php

namespace Bhry98\Locations\database\seeders;

use Bhry98\Locations\Models\LocationsCitiesModel;
use Bhry98\Locations\Models\LocationsCountriesModel;
use Bhry98\Locations\Models\LocationsGovernoratesModel;
use Illuminate\Database\Seeder;
use function Laravel\Prompts\select;


class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countriesArray = include bhry98_locations_path("database/data/countries.php");
        foreach ($countriesArray ?? [] as $country) {
            $fixData = [
                "country_code" => $country["code"],
                "default_name" => $country["name_en"],
                "flag" => $country["flag"],
                "lang_key" => $country["lang_key"],
                "dial_code" => $country["dial_code"],
                "system_lang" => false,
                "active" => in_array($country["code"], ['EG', "SA"]),
            ];
            $countryAfterAdd = LocationsCountriesModel::query()->updateOrCreate(["country_code" => $country["code"]], $fixData);
            if ($countryAfterAdd) {
                self::addLocalizations($countryAfterAdd, $country);
                match ($country["code"]) {
                    "EG" => self::addEgyptGovernorates($countryAfterAdd->id),
                    "SA" => self::addSaudiArabiaGovernorates($countryAfterAdd->id),
                    default => null,
                };
            }
        }
    }

    static function addEgyptGovernorates($egypt_id): void
    {
        $governoratesArray = include bhry98_locations_path("database/data/governorates/egypt.php");
        foreach ($governoratesArray ?? [] as $governorate) {
            $fixData = [
                "default_name" => $governorate["name_en"],
                "country_id" => $egypt_id,
                "active" => true
            ];
            $governorateAfterAdd = LocationsGovernoratesModel::query()->updateOrCreate([
                'country_id' => $egypt_id,
                'default_name' => $governorate["name_en"]
            ], $fixData);
            if ($governorateAfterAdd) {
                self::addLocalizations($governorateAfterAdd, $governorate);
                match ($governorate["name_en"]) {
                    "Cairo" => self::addEgyptCairoCities($egypt_id, $governorateAfterAdd->id),
                    "Giza" => self::addEgyptGizaCities($egypt_id, $governorateAfterAdd->id),
                    "Alexandria" => self::addEgyptAlexandriaCities($egypt_id, $governorateAfterAdd->id),
                    default => null,
                };
            }
        }
    }

    static function addEgyptCairoCities($egypt_id, $cairo_id): void
    {
        $citiesArray = include bhry98_locations_path("database/data/cities/egypt_cairo.php");
        foreach ($citiesArray ?? [] as $city) {
            $fixData = [
                "default_name" => $city["name_en"],
                "country_id" => $egypt_id,
                "governorate_id" => $cairo_id,
                "active" => true
            ];
            $cityRecord = LocationsCitiesModel::query()->updateOrCreate([
                "country_id" => $egypt_id,
                "governorate_id" => $cairo_id,
                "default_name" => $city["name_en"]
            ], $fixData);
            self::addLocalizations($cityRecord, $city);
        }
    }

    static function addEgyptGizaCities($egypt_id, $giza_id): void
    {
        $citiesArray = include bhry98_locations_path("database/data/cities/egypt_giza.php");
        foreach ($citiesArray ?? [] as $city) {
            $fixData = [
                "default_name" => $city["name_en"],
                "country_id" => $egypt_id,
                "governorate_id" => $giza_id,
                "active" => true
            ];
            $cityRecord = LocationsCitiesModel::query()->updateOrCreate([
                "country_id" => $egypt_id,
                "governorate_id" => $giza_id,
                "default_name" => $city["name_en"]
            ], $fixData);
            self::addLocalizations($cityRecord, $city);
        }
    }

    static function addEgyptAlexandriaCities($egypt_id, $alexandria_id): void
    {
        $citiesArray = include bhry98_locations_path("database/data/cities/egypt_alexandria.php");
        foreach ($citiesArray ?? [] as $city) {
            $fixData = [
                "default_name" => $city["name_en"],
                "country_id" => $egypt_id,
                "governorate_id" => $alexandria_id,
                "active" => true
            ];
            $cityRecord = LocationsCitiesModel::query()->updateOrCreate([
                "country_id" => $egypt_id,
                "governorate_id" => $alexandria_id,
                "default_name" => $city["name_en"]
            ], $fixData);
            self::addLocalizations($cityRecord, $city);
        }
    }

    static function addSaudiArabiaGovernorates($saudi_arabia_id): void
    {
        $governoratesArray = include bhry98_locations_path("database/data/governorates/saudi_arabia.php");
        foreach ($governoratesArray ?? [] as $governorate) {
            $fixData = [
                "default_name" => $governorate["name_en"],
                "country_id" => $saudi_arabia_id,
                "active" => true
            ];
            $governorateAfterAdd = LocationsGovernoratesModel::query()->updateOrCreate([
                'country_id' => $saudi_arabia_id,
                'default_name' => $governorate["name_en"]
            ], $fixData);
            self::addLocalizations($governorateAfterAdd, $governorate);
        }
    }

    static function addLocalizations(LocationsCitiesModel|LocationsCountriesModel|LocationsGovernoratesModel $record, array $data): void
    {
        $record->setLocalized(column: "name", value: $data["name_en"], locale: "en");
        $record->setLocalized(column: "name", value: $data["name_ar"], locale: "ar");
    }
}
