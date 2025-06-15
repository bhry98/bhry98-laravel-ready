<?php

namespace Bhry98\Bhry98LaravelReady\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class BaseModel extends Model
{
    public static function createUniqueTextForColumn(string $column, ?string $str = null, int $length = 10): string
    {
        // if str not null makes it as a code format and returns
        if ($str) return Str::upper(Str::slug($str));
        $code = Str::upper(Str::random($length));
        if (static::query()->where($column, $code)->exists()) {
            return self::createUniqueTextForColumn($column,null, $length);
        }
        return $code;
    }
}