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
    const FILTER_COLUMNS = ["name"];
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

    public function canEdit(): bool
    {
        $notDeleted = is_null($this->deleted_at);
        $abilities = auth()->user()?->can('Locations.Cities.Update');
        return $notDeleted && $abilities;
    }

    public function canDelete($relationsCount): bool
    {
        $notDeleted = is_null($this->deleted_at);
        $abilities = auth()->user()?->can('Locations.Cities.Delete');
        return $notDeleted && $abilities && $relationsCount <= 0;
    }

    public function canForceDelete($relationsCount): bool
    {
        $notDeleted = !is_null($this->deleted_at);
        $abilities = auth()->user()?->can('Locations.Cities.ForceDelete');
        return $notDeleted && $abilities && $relationsCount <= 0;
    }

    public function canRestore(): bool
    {
        $notDeleted = !is_null($this->deleted_at);
        $abilities = auth()->user()?->can('Locations.Cities.Restore');
        return $notDeleted && $abilities;
    }
}
