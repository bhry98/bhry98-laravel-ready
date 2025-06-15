<?php

namespace Bhry98\Bhry98LaravelReady\Models\rbac;

use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RBACGroupsUsersModel extends BaseModel
{

    const TABLE_NAME = 'rbac_groups_users';
    const RELATIONS = [];
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "group_id",
        "user_id"
    ];
    protected $hidden = [];

    protected function casts(): array
    {
        return [];
    }

    function group(): HasOne
    {
        return $this->hasOne(
            related: RBACGroupsModel::class,
            foreignKey: "id",
            localKey: "group_id");
    }

    function user(): HasOne
    {
        return $this->hasOne(
            related: UsersCoreUsersModel::class,
            foreignKey: "id",
            localKey: "user_id");
    }
}
