<?php

namespace Bhry98\GP\Models;

use Bhry98\Helpers\extends\BaseModel;
use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GPGroupsUsersModel extends BaseModel
{

    const RELATIONS = [];
    protected $table = "gp_groups_users";
    protected $fillable = [
        "id",
        "group_id",
        "user_id"
    ];
    protected $hidden = [];

    protected function casts(): array
    {
        return [];
    }

    public function group(): HasOne
    {
        return $this->hasOne(GPGroupsModel::class, "id", "group_id");
    }

    public function user(): HasOne
    {
        return $this->hasOne(UsersCoreModel::class, "id", "user_id");
    }
}
