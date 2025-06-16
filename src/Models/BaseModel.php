<?php

namespace Bhry98\Bhry98LaravelReady\Models;

use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

abstract class BaseModel extends Model
{
    public static function createUniqueTextForColumn(string $column, ?string $str = null, int $length = 10): string
    {
        // if str not null makes it as a code format and returns
        if ($str) return Str::upper(Str::slug($str));
        $code = Str::upper(Str::random($length));
        if (static::query()->where($column, $code)->exists()) {
            return self::createUniqueTextForColumn($column, null, $length);
        }
        return $code;
    }

    public function createdBy(): HasOne
    {
        return $this->hasOne(UsersCoreUsersModel::class, 'id', 'created_by');
    }

    public function updatedBy(): HasOne
    {
        return $this->hasOne(UsersCoreUsersModel::class, 'id', 'updated_by');
    }

    public function deletedBy(): HasOne
    {
        return $this->hasOne(UsersCoreUsersModel::class, 'id', 'deleted_by');
    }
}
