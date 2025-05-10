<?php

namespace Bhry98\Bhry98LaravelReady\Database\seeders\core;

use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCitiesModel;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCountriesModel;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsGovernoratesModel;
use Illuminate\Database\Seeder;

class CoreLocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $countriesArray = include __DIR__ . "/..$ds..{$ds}data{$ds}locations{$ds}countries.php";
        foreach ($countriesArray ?? [] as $country) {
            $fixData = [
                "country_code" => $country["code"],
                "default_name" => $country["name"],
                "flag" => $country["flag"],
                "lang_key" => $country["lang_key"],
                "system_lang" => false,
            ];
            $countryAfterAdd = LocationsCountriesModel::query()->updateOrCreate(["country_code" => $country["code"]], $fixData);
            if ($countryAfterAdd) {
                $countryAfterAdd->setLocalized(column: "name", value: $country["name"], locale: "en");
                match ($country["code"]) {
                    "EG" => self::addEgyptGovernorates($countryAfterAdd->id),
                    "SA" => self::addSaudiArabiaGovernorates($countryAfterAdd->id),
                    default => null,
                };
            }
        }
    }

    /**
     * @param $egypt_id
     * @return void
     * to add all Egypt governorates and call the add cities method for each governorate
     */
    static function addEgyptGovernorates($egypt_id): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $egyptGovernoratesArray = include __DIR__ . "$ds..$ds..{$ds}data{$ds}locations{$ds}governorates{$ds}egypt.php";
        foreach ($egyptGovernoratesArray ?? [] as $governorate) {
            $fixData = [
                "default_name" => $governorate["name"],
                "country_id" => $egypt_id
            ];
            $governorateAfterAdd = LocationsGovernoratesModel::query()->updateOrCreate(['country_id' => $egypt_id, 'default_name' => $governorate["name"]], $fixData);
            if ($governorateAfterAdd) {
                $governorateAfterAdd->setLocalized(column: "name", value: $governorate["name"], locale: "en");
                match ($governorate["name"]) {
                    "Cairo" => self::addEgyptCairoCities($egypt_id, $governorateAfterAdd->id),
                    "Giza" => self::addEgyptGizaCities($egypt_id, $governorateAfterAdd->id),
                    "Alexandria" => self::addEgyptAlexandriaCities($egypt_id, $governorateAfterAdd->id),
                    default => null,
                };
            }
        }
    }

    /**
     * @param $egypt_id
     * @param $cairo_id
     * @return void
     * to add all cities in cairo
     */
    static function addEgyptCairoCities($egypt_id, $cairo_id): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $citiesArray = include __DIR__ . "/..$ds..{$ds}data{$ds}locations{$ds}cities{$ds}egypt_cairo.php";
        foreach ($citiesArray ?? [] as $city) {
            $fixData = [
                "default_name" => $city["name"],
                "country_id" => $egypt_id,
                "governorate_id" => $cairo_id
            ];
            $cityRecord = LocationsCitiesModel::query()->updateOrCreate([
                "country_id" => $egypt_id,
                "governorate_id" => $cairo_id,
                "default_name" => $city["name"],
            ], $fixData);
            $cityRecord->setLocalized(column: "name", value: $city["name"], locale: "en");
        }
    }

    /**
     * @param $egypt_id
     * @param $giza_id
     * @return void
     * to add all cities in giza
     */
    static function addEgyptGizaCities($egypt_id, $giza_id): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $citiesArray = include __DIR__ . "/..$ds..{$ds}data{$ds}locations{$ds}cities{$ds}egypt_giza.php";
        foreach ($citiesArray ?? [] as $city) {
            $fixData = [
                "default_name" => $city["name"],
                "country_id" => $egypt_id,
                "governorate_id" => $giza_id
            ];
            $cityRecord = LocationsCitiesModel::query()->updateOrCreate([
                "country_id" => $egypt_id,
                "governorate_id" => $giza_id,
                "default_name" => $city["name"],
            ], $fixData);
            $cityRecord->setLocalized(column: "name", value: $city["name"], locale: "en");
        }
    }

    /**
     * @param $egypt_id
     * @param $alexandria_id
     * @return void
     * to add all cities in alexandria
     */
    static function addEgyptAlexandriaCities($egypt_id, $alexandria_id): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $citiesArray = include __DIR__ . "/..$ds..{$ds}data{$ds}locations{$ds}cities{$ds}egypt_alexandria.php";
        foreach ($citiesArray ?? [] as $city) {
            $fixData = [
                "default_name" => $city["name"],
                "country_id" => $egypt_id,
                "governorate_id" => $alexandria_id
            ];
            $cityRecord = LocationsCitiesModel::query()->updateOrCreate([
                "country_id" => $egypt_id,
                "governorate_id" => $alexandria_id,
                "default_name" => $city["name"],
            ], $fixData);
            $cityRecord->setLocalized(column: "name", value: $city["name"], locale: "en");
        }
    }

    static function addSaudiArabiaGovernorates($saudi_arabia_id): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $governoratesArray = include __DIR__ . "/..$ds..{$ds}data{$ds}locations{$ds}governorates{$ds}saudi_arabia.php";
        foreach ($governoratesArray ?? [] as $governorate) {
            $fixData = [
                "default_name" => $governorate["name"],
                "country_id" => $saudi_arabia_id
            ];
            $governorateAfterAdd = LocationsGovernoratesModel::query()->updateOrCreate(['country_id' => $saudi_arabia_id, 'default_name' => $governorate["name"]], $fixData);
            $governorateAfterAdd->setLocalized(column: "name", value: $governorate["name"], locale: "en");
        }
    }
}
