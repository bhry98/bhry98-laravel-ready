<?php

namespace Bhry98\Bhry98LaravelReady\Models\rbac;

use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Bhry98\Bhry98LaravelReady\Traits\HasLocalization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class RBACGroupsModel extends BaseModel
{
    use SoftDeletes, HasLocalization;

    protected array $localizable = ['name', 'description'];
    const TABLE_NAME = 'rbac_groups';
    const FILTER_COLUMNS = ['code', 'default_name', 'name'];
    const RELATIONS = [];
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "code",
        "default_name",
        "default_description",
        "can_delete",
        "is_default",
        "active"
    ];
    protected $hidden = [];

    protected function casts(): array
    {
        return [
            "can_delete" => "boolean",
            "is_default" => "boolean",
            "active" => "boolean",
        ];
    }

    function permissions(): HasMany
    {
        return $this->hasMany(
            related: RBACGroupsPermissionsModel::class,
            foreignKey: "group_id",
            localKey: "id");
    }

    function users(): HasMany
    {
        return $this->hasMany(
            related: RBACGroupsUsersModel::class,
            foreignKey: "group_id",
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
}
