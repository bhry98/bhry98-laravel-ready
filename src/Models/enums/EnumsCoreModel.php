<?php

namespace Bhry98\Bhry98LaravelReady\Models\enums;

use Bhry98\Bhry98LaravelReady\Enums\enums\EnumsCoreTypes;
use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Traits\HasLocalization;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class EnumsCoreModel extends BaseModel
{
    use SoftDeletes, HasLocalization;

    protected array $localizable = ['name'];
    const TABLE_NAME = 'enums_core';
    const RELATIONS = [];
    const FILTER_COLUMNS = ['code', 'name', 'default_name'];
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "code",
        "type",
        "default_name",
        "default_color",
        "api_access",
        "ordering",
        "can_delete",
        "parent_id",
        "default",
        "active",
    ];
    protected $hidden = [];

    protected function casts(): array
    {
        return [
            'api_access' => "boolean",
            'can_delete' => "boolean",
            'default' => "boolean",
            'ordering' => "integer",
        ];
    }

    public function parent(): HasOne
    {
        return $this->hasOne(
            related: EnumsCoreModel::class,
            foreignKey: "parent_id",
            localKey: "id");
    }

    public function children(): HasMany
    {
        return $this->hasMany(
            related: EnumsCoreModel::class,
            foreignKey: "parent_id",
            localKey: "id"
        );
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
