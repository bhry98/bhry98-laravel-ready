<?php

namespace Bhry98\GP\Models;

use Bhry98\Helpers\extends\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GPGroupsPermissionsModel extends BaseModel
{
    const RELATIONS = [];
    protected $table = "gp_groups_permissions";
    protected $fillable = [
        "id",
        "group_id",
        "permission_id"
    ];

    protected function casts(): array
    {
        return [];
    }

    public function permission(): HasOne
    {
        return $this->hasOne(GPPermissionsModel::class, "id", "permission_id");
    }

    public function group(): HasOne
    {
        return $this->hasOne(GPGroupsModel::class, "id", "group_id");
    }
}
