<?php

namespace Bhry98\Bhry98LaravelReady\Models\locations;

use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Traits\HasLocalization;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocationsCountriesModel extends BaseModel
{
    use SoftDeletes, HasLocalization;

    protected array $localizable = ['name'];
    const TABLE_NAME = "locations_countries";
    const RELATIONS = [];
    const FILTER_COLUMNS = ["name"];
    protected $table = self::TABLE_NAME;
    public $timestamps = true;
    protected $fillable = [
        "id",
        "code",
        "country_code",
        "default_name",
        "flag",
        "lang_key",
        "system_lang",
        "active",
    ];
    protected $casts = [
        "code" => "string",
        "system_lang" => "boolean",
        "active" => "boolean",
    ];

    public function governorates(): HasMany
    {
        return $this->hasMany(
            related: LocationsGovernoratesModel::class,
            foreignKey: "country_id",
            localKey: "id");
    }

    public function cities(): HasMany
    {
        return $this->hasMany(
            related: LocationsCitiesModel::class,
            foreignKey: "country_id",
            localKey: "id");
    }

    public function users(): HasMany
    {
        return $this->hasMany(
            related: UsersCoreUsersModel::class,
            foreignKey: "country_id",
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
        $abilities = auth()->user()?->can('Locations.Countries.Update');
        return $notDeleted && $abilities;
    }

    public function canDelete($relationsCount): bool
    {
        $notDeleted = is_null($this->deleted_at);
        $abilities = auth()->user()?->can('Locations.Countries.Delete');
        return $notDeleted && $abilities && $relationsCount <= 0;
    }

    public function canForceDelete($relationsCount): bool
    {
        $notDeleted = !is_null($this->deleted_at);
        $abilities = auth()->user()?->can('Locations.Countries.ForceDelete');
        return $notDeleted && $abilities && $relationsCount <= 0;
    }

    public function canRestore(): bool
    {
        $notDeleted = !is_null($this->deleted_at);
        $abilities = auth()->user()?->can('Locations.Countries.Restore');
        return $notDeleted && $abilities;
    }
}
