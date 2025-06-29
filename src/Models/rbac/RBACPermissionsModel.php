<?php

namespace Bhry98\Bhry98LaravelReady\Models\rbac;

use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Bhry98\Bhry98LaravelReady\Traits\HasLocalization;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RBACPermissionsModel extends BaseModel
{
    use HasLocalization;

    protected array $localizable = ['name', 'description'];
    const TABLE_NAME = 'rbac_permissions';
    const RELATIONS = [];
    const FILTER_COLUMNS = ["code", "name", "default_name"];
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "code",
        "default_name",
        "default_description",
        "is_default",
    ];
    protected $hidden = [];

    protected function casts(): array
    {
        return [
            "is_default" => "boolean"
        ];
    }

    function groups(): HasMany
    {
        return $this->hasMany(
            related: RBACGroupsPermissionsModel::class,
            foreignKey: "permission_id",
            localKey: "id"
        );
    }
}
