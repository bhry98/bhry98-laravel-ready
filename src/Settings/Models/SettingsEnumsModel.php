<?php

namespace Bhry98\Settings\Models;

use Bhry98\Helpers\extends\BaseModel;
use Bhry98\Helpers\traits\HasLocalization;
use Bhry98\Settings\Enums\EnumsTypes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingsEnumsModel extends BaseModel
{
    use SoftDeletes, HasLocalization;

    protected array $localizable = ['name', 'description'];
    const RELATIONS = ['parent'];
    const FILTER_COLUMNS = ['code', 'name'];
    protected $table = 'settings_enums';
    protected $fillable = [
        "id",
        "code",
        "type",
        "model",
        "column_name",
        "default_name",
        "default_description",
        "icon",
        "color",
        "ordering",
        "parent_id",
        "active",
        "note",
    ];
    protected $hidden = [];

    protected function casts(): array
    {
        return [
            'active' => "boolean",
            'ordering' => "integer",
            'type' => config("bhry98.enums_type_cast", EnumsTypes::class),
        ];
    }

    public function parent(): HasOne
    {
        return $this->hasOne(SettingsEnumsModel::class, "id", "parent_id");
    }

    public function children(): HasMany
    {
        return $this->hasMany(SettingsEnumsModel::class, "parent_id", "id");
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->code = self::createUniqueTextForColumn('code', $model->code);
            $model->icon = $model->icon ?? "heroicon-o-cursor-arrow-rays";
            $model->created_by = auth()->id();
        });
        static::updating(function ($model) {
            $model->icon = $model->icon ?? "heroicon-o-cursor-arrow-rays";
            $model->updated_by = auth()->id();
        });
    }

}
