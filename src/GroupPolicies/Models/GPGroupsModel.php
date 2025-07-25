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

    public function getRouteKeyName(): string
    {
        return "code";
    }

    const RELATIONS = [];
    protected $table = "gp_groups";
    protected $fillable = [
        "id",
        "code",
        "default_name",
        "default_description",
        "can_delete",
        "is_default",
        "active",
        "deleted_by",
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

    public function permissions(): HasMany
    {
        return $this->hasMany(GPGroupsPermissionsModel::class, "group_id", "id");
    }

    public function users(): HasMany
    {
        return $this->hasMany(GPGroupsUsersModel::class, "group_id", "id");
    }

    public function canEdit(): bool
    {
        $notDeleted = is_null($this->getAttribute('deleted_at'));
        $hasAbilities = auth()->user()->can('GP.Update');
        return $notDeleted && $hasAbilities;
    }

    public function canDelete(): bool
    {
        $notDeleted = is_null($this->getAttribute('deleted_at'));
        $hasAbilities = auth()->user()->can('GP.Delete');
        return $notDeleted && $hasAbilities;
    }

    public function canRestore(): bool
    {
        $isDeleted = !is_null($this->getAttribute('deleted_at'));
        $hasAbilities = auth()->user()->can('GP.Restore');
        return $isDeleted && $hasAbilities;
    }

    public function canForceDelete(int $relationsCount = 0): bool
    {
        $isDeleted = !is_null($this->getAttribute('deleted_at'));
        $hasAbilities = auth()->user()->can('GP.ForceDelete');
        return $isDeleted && $hasAbilities && $relationsCount <= 0;
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
        static::deleting(function ($model) {
            $model->deleted_by = auth()->id();
            $model->save();
        });
        static::restoring(function ($model) {
            $model->deleted_by = null;
        });
    }
}
