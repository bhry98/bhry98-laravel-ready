<?php

namespace Bhry98\Bhry98LaravelReady\Models\locations;

use Bhry98\Bhry98LaravelReady\Enums\identities\IdentitiesCoreTypes;
use Bhry98\Bhry98LaravelReady\Enums\Modules;
use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Bhry98\Bhry98LaravelReady\Models\identities\IdentitiesCoreModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Traits\HasLocalization;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocationsCitiesModel extends BaseModel
{
    use SoftDeletes, HasLocalization;

    protected array $localizable= ['name'];

    const TABLE_NAME = "locations_cities";
    const RELATIONS = ["country", "governorate"];
    // start table
    protected $table = self::TABLE_NAME;
    public $timestamps = true;
    protected $fillable = [
        "identity_code",
        "default_name",
        "country_id",
        "governorate_id",
    ];
    protected $casts = [
        "name" => "string",
    ];

    public function country(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(
            related: LocationsCountriesModel::class,
            foreignKey: "id",
            localKey: "country_id");
    }

    public function governorate(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(
            related: LocationsGovernoratesModel::class,
            foreignKey: "id",
            localKey: "governorate_id");
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            related: UsersCoreUsersModel::class,
            foreignKey: "governorate_id",
            localKey: "country_id");
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            // create record in identity table
            $parent_id = IdentitiesCoreModel::query()
                ->where("type", "=", IdentitiesCoreTypes::Governorate)
                ->where("code", "=", LocationsGovernoratesModel::query()
                    ->where("id", $model->governorate_id)
                    ->first()?->identity_code
                )->first()?->id ?? null;
            $identityRecord = IdentitiesCoreModel::query()->create([
                "type" => IdentitiesCoreTypes::City,
                "name" => $model->default_name,
                "module" => Modules::Core,
                "metadata" => $model->toArray(),
                "parent_id" => $parent_id,
                "is_active" => $model->is_active ?? true,
            ]);
            $model->identity_code = $identityRecord->code;
        });
    }
}
