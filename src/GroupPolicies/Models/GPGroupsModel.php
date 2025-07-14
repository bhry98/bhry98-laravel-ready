<?php

namespace Bhry98\GP\Models;

use Bhry98\Helpers\extends\BaseModel;
use Bhry98\Helpers\traits\HasLocalization;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class GPGroupsModel extends BaseModel
{
    use SoftDeletes, HasLocalization;

    protected array $localizable = ['name', 'description'];
    const FILTER_COLUMNS = ['code', 'default_name', 'name'];
    const RELATIONS = [];
    protected $table = "gp_groups";
    protected $fillable = [
        "id",
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
        return $this->hasMany(GPGroupsPermissionsModel::class, "group_id", "id");
    }

    function users(): HasMany
    {
        return $this->hasMany(GPGroupsUsersModel::class, "group_id", "id");
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
}
