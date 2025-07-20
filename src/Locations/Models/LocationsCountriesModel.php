<?php

namespace Bhry98\Locations\Models;

use Bhry98\Helpers\extends\BaseModel;
use Bhry98\Helpers\traits\HasLocalization;
use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocationsCountriesModel extends BaseModel
{
    use SoftDeletes, HasLocalization;

    protected array $localizable = ['name'];
    const RELATIONS = [];
    const FILTER_COLUMNS = ["name"];
    protected $table = "locations_countries";
    public $timestamps = true;
    protected $fillable = [
        "id",
        "code",
        "country_code",
        "default_name",
        "flag",
        "lang_key",
        "dial_code",
        "currency",
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
        return $this->hasMany(LocationsGovernoratesModel::class, "country_id", "id");
    }

    public function cities(): HasMany
    {
        return $this->hasMany(LocationsCitiesModel::class, "country_id", "id");
    }

    public function users(): HasMany
    {
        return $this->hasMany(UsersCoreModel::class, "country_id", "id");
    }

    public function nameLabel(): Attribute
    {
        return new Attribute(
            get: fn() => "({$this->flag}) " . $this->name ?? $this->default_name ?? "---"
        );
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

    public function canEdit(): bool
    {
        $notDeleted = is_null($this->getAttribute('deleted_at'));
        $abilities = auth()->user()?->can('Locations.Countries.Update');
        return $notDeleted && $abilities;
    }

    public function canDelete($relationsCount): bool
    {
        $notDeleted = is_null($this->getAttribute('deleted_at'));
        $abilities = auth()->user()?->can('Locations.Countries.Delete');
        return $notDeleted && $abilities && $relationsCount <= 0;
    }

    public function canForceDelete($relationsCount): bool
    {
        $notDeleted = !is_null($this->getAttribute('deleted_at'));
        $abilities = auth()->user()?->can('Locations.Countries.ForceDelete');
        return $notDeleted && $abilities && $relationsCount <= 0;
    }

    public function canRestore(): bool
    {
        $notDeleted = !is_null($this->getAttribute('deleted_at'));
        $abilities = auth()->user()?->can('Locations.Countries.Restore');
        return $notDeleted && $abilities;
    }
}
