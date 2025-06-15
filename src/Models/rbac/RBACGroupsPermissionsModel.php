<?php

namespace Bhry98\Bhry98LaravelReady\Models\rbac;

use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RBACGroupsPermissionsModel extends BaseModel
{
    const TABLE_NAME = 'rbac_groups_permissions';
    const RELATIONS = [];
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "group_id",
        "permission_id"
    ];
    protected $hidden = [];

    protected function casts(): array
    {
        return [];
    }

    function permission(): HasOne
    {
        return $this->hasOne(
            related: RBACPermissionsModel::class,
            foreignKey: "id",
            localKey: "permission_id");
    }

    function group(): HasOne
    {
        return $this->hasOne(
            related: RBACGroupsModel::class,
            foreignKey: "id",
            localKey: "group_id");
    }
}
