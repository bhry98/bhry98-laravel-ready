<?php

namespace Bhry98\Bhry98LaravelReady\Models\rbac;

use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Bhry98\Bhry98LaravelReady\Traits\HasLocalization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class RBACGroupsModel extends BaseModel
{
    use SoftDeletes, HasLocalization;

    protected array $localizable= ['name']; // Columns that should be localized
    const TABLE_NAME = 'rbac_groups';
    const FILTER_COLUMNS = ['code', 'default_name', 'name'];
    const RELATIONS = [];
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "code",
        "default_name",
        "description",
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

    function permissions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            related: RBACGroupsPermissionsModel::class,
            foreignKey: "group_id",
            localKey: "id");
    }

    function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            related: RBACGroupsUsersModel::class,
            foreignKey: "group_id",
            localKey: "id");
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->code)) {
                $model->code = self::generateNewCode();
            }
        });
    }

    static function generateNewCode(): string
    {
        $code = Str::random(length: 10);
        if (static::query()->where('code', $code)->exists()) {
            return self::generateNewCode();
        }
        return $code;
    }
}
