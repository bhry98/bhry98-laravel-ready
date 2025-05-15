<?php

namespace Bhry98\Bhry98LaravelReady\Models\rbac;

use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Bhry98\Bhry98LaravelReady\Traits\HasLocalization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RBACPermissionsModel extends BaseModel
{
    use HasLocalization;
    protected array $localizable= ['name']; // Columns that should be localized
    const TABLE_NAME = 'rbac_permissions';
    const RELATIONS = [];
    const FILTER_COLUMNS = ["code", "name", "default_name"];
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "code",
        "default_name",
        "active",
    ];
    protected $hidden = [];
    protected function casts(): array
    {
        return [
            "active"=>"boolean"
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
