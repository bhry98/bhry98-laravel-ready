<?php

namespace Bhry98\Bhry98LaravelReady\Models\locations;

use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Traits\HasLocalization;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocationsGovernoratesModel extends BaseModel
{
    use SoftDeletes, HasLocalization;

    protected array $localizable = ['name'];

    const TABLE_NAME = "locations_governorates";
    const FILTER_COLUMNS = ["name"];
    const RELATIONS = [
        "country",
    ];
    protected $table = self::TABLE_NAME;
    public $timestamps = true;
    protected $fillable = [
        "id",
        "code",
        "default_name",
        "country_id",
        "active",
    ];
    protected $casts = [
        "name" => "string",
        "active" => "boolean"
    ];

    public function country(): HasOne
    {
        return $this->hasOne(
            related: LocationsCountriesModel::class,
            foreignKey: "id",
            localKey: "country_id");
    }

    public function users(): HasMany
    {
        return $this->hasMany(
            related: UsersCoreUsersModel::class,
            foreignKey: "governorate_id",
            localKey: "id");
    }

    public function cities(): HasMany
    {
        return $this->hasMany(
            related: LocationsCitiesModel::class,
            foreignKey: "governorate_id",
            localKey: "id");
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
        $abilities = auth()->user()?->can('Locations.Governorates.Update');
        return $notDeleted && $abilities;
    }

    public function canDelete($relationsCount): bool
    {
        $notDeleted = is_null($this->deleted_at);
        $abilities = auth()->user()?->can('Locations.Governorates.Delete');
        return $notDeleted && $abilities && $relationsCount <= 0;
    }

    public function canForceDelete($relationsCount): bool
    {
        $notDeleted = !is_null($this->deleted_at);
        $abilities = auth()->user()?->can('Locations.Governorates.ForceDelete');
        return $notDeleted && $abilities && $relationsCount <= 0;
    }

    public function canRestore(): bool
    {
        $notDeleted = !is_null($this->deleted_at);
        $abilities = auth()->user()?->can('Locations.Governorates.Restore');
        return $notDeleted && $abilities;
    }
}
