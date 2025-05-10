<?php

namespace Bhry98\Bhry98LaravelReady\Models\locations;

use Bhry98\Bhry98LaravelReady\Enums\identities\IdentitiesCoreTypes;
use Bhry98\Bhry98LaravelReady\Enums\Modules;
use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Bhry98\Bhry98LaravelReady\Models\identities\IdentitiesCoreModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Traits\HasLocalization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocationsCountriesModel extends BaseModel
{
    use SoftDeletes, HasLocalization;

    protected array $localizable= ['name'];
    const TABLE_NAME = "locations_countries";
    const RELATIONS = [];
    protected $table = self::TABLE_NAME;
    public $timestamps = true;
    protected $fillable = [
        "id",
        "identity_code",
        "country_code",
        "default_name",
        "flag",
        "lang_key",
        "system_lang",
    ];
    protected $casts = [
        "code" => "string",
        "system_lang" => "boolean",
    ];

    public function governorates(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            related: LocationsGovernoratesModel::class,
            foreignKey: "country_id",
            localKey: "id");
    }

    public function cities(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            related: LocationsCitiesModel::class,
            foreignKey: "country_id",
            localKey: "id");
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            related: UsersCoreUsersModel::class,
            foreignKey: "country_id",
            localKey: "id");
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
//            dd($model->toArray());
            // create record in identity table
            $identityRecord = IdentitiesCoreModel::query()->create([
                "type" => IdentitiesCoreTypes::Country,
                "name" => $model->default_name,
                "module" => Modules::Core,
                "metadata" => $model->toArray(),
                "is_active" => $model->is_active ?? true,
            ]);
            $model->identity_code = $identityRecord->code;
        });
    }
}
