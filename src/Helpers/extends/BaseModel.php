<?php

namespace Bhry98\Helpers\extends;


use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

abstract class BaseModel extends Model
{

    public function getTable(): ?string
    {
        return strtolower(config('bhry98.db_prefix') . $this->table);
    }
    public static function createUniqueTextForColumn(string $column, ?string $str = null, int $length = 10, bool $upper = true): string
    {
        if ($str) return $upper ? Str::upper(Str::slug($str)) : Str::lower(Str::slug($str));
        $code = Str::upper(Str::random($length));
        if (static::query()->where($column, $code)->exists()) {
            return self::createUniqueTextForColumn($column, null, $length);
        }
        return $upper ? Str::upper(Str::slug($code)) : Str::lower(Str::slug($code));
    }

    public function createdBy(): HasOne
    {
        return $this->hasOne(UsersCoreModel::class, 'id', 'created_by');
    }

    public function updatedBy(): HasOne
    {
        return $this->hasOne(UsersCoreModel::class, 'id', 'updated_by');
    }

    public function deletedBy(): HasOne
    {
        return $this->hasOne(UsersCoreModel::class, 'id', 'deleted_by');
    }

    /**
     * Scope a query to only include active records.
     */
    protected function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }
}
