<?php

namespace Bhry98\Locations\Models;

use Bhry98\Helpers\extends\BaseModel;
use Bhry98\Helpers\traits\HasLocalization;
use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocationsCitiesModel extends BaseModel
{
    use SoftDeletes, HasLocalization;

    protected array $localizable = ['name'];

    const RELATIONS = ["country", "governorate"];
    const FILTER_COLUMNS = ["name"];
    protected $table = "locations_cities";
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
        return $this->hasOne(LocationsCountriesModel::class, "id", "country_id");
    }

    public function governorate(): HasOne
    {
        return $this->hasOne(LocationsGovernoratesModel::class, "id", "governorate_id");
    }

    public function users(): HasMany
    {
        return $this->hasMany(UsersCoreModel::class, "city_id", "id");
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->code = self::createUniqueTextForColumn('code', $model->code);
            $model->created_by = auth()->id();
        });
        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });
    }

//    public function canEdit(): bool
//    {
//        $notDeleted = is_null($this->deleted_at);
//        $abilities = auth()->user()?->can('Locations.Cities.Update');
//        return $notDeleted && $abilities;
//    }
//
//    public function canDelete($relationsCount): bool
//    {
//        $notDeleted = is_null($this->deleted_at);
//        $abilities = auth()->user()?->can('Locations.Cities.Delete');
//        return $notDeleted && $abilities && $relationsCount <= 0;
//    }
//
//    public function canForceDelete($relationsCount): bool
//    {
//        $notDeleted = !is_null($this->deleted_at);
//        $abilities = auth()->user()?->can('Locations.Cities.ForceDelete');
//        return $notDeleted && $abilities && $relationsCount <= 0;
//    }
//
//    public function canRestore(): bool
//    {
//        $notDeleted = !is_null($this->deleted_at);
//        $abilities = auth()->user()?->can('Locations.Cities.Restore');
//        return $notDeleted && $abilities;
//    }
}
