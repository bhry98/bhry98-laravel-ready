<?php

namespace Bhry98\Bhry98LaravelReady\Models\locations;

use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Traits\HasLocalization;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocationsCitiesModel extends BaseModel
{
    use SoftDeletes, HasLocalization;

    protected array $localizable = ['name'];
    const TABLE_NAME = "locations_cities";
    const RELATIONS = ["country", "governorate"];
    const FILTERS_COLUMNS = ["name"];
    protected $table = self::TABLE_NAME;
    public $timestamps = true;
    protected $fillable = [
        "id",
        "code",
        "default_name",
        "country_id",
        "governorate_id",
        "active",
    ];
    protected $casts = [
        "default_name" => "string",
        "active" => "boolean",
    ];

    public function country(): HasOne
    {
        return $this->hasOne(
            related: LocationsCountriesModel::class,
            foreignKey: "id",
            localKey: "country_id");
    }

    public function governorate(): HasOne
    {
        return $this->hasOne(
            related: LocationsGovernoratesModel::class,
            foreignKey: "id",
            localKey: "governorate_id");
    }

    public function users(): HasMany
    {
        return $this->hasMany(
            related: UsersCoreUsersModel::class,
            foreignKey: "governorate_id",
            localKey: "country_id");
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->code = self::createUniqueTextForColumn('code', $model->code);
            $model->created_by = auth()->id();
        });
        static::updating(function ($model) {
            $model->code = self::createUniqueTextForColumn('code', $model->code);
            $model->updated_by = auth()->id();
        });
    }
}
