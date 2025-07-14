<?php

namespace Bhry98\GP\Models;

use Bhry98\Helpers\extends\BaseModel;
use Bhry98\Helpers\traits\HasLocalization;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GPPermissionsModel extends BaseModel
{
    use HasLocalization;

    protected array $localizable = ['name', 'description'];
    const RELATIONS = [];
    const FILTER_COLUMNS = ["code", "name", "default_name"];
    protected $table = "gp_permissions";
    protected $fillable = [
        "id",
        "code",
        "default_name",
        "default_description",
        "is_default",
    ];

    protected function casts(): array
    {
        return [
            "is_default" => "boolean"
        ];
    }

    public function groups(): HasMany
    {
        return $this->hasMany(GPGroupsPermissionsModel::class, "permission_id", "id");
    }
}
