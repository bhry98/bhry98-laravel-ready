<?php

namespace Bhry98\Bhry98LaravelReady\Models\identities;

use Bhry98\Bhry98LaravelReady\Enums\identities\IdentitiesCoreTypes;
use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class IdentitiesCoreModel extends BaseModel
{
    const TABLE_NAME = 'identities_core';
    use SoftDeletes;
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "code",
        "type",
        "name",
        "module",
        "relation",
        "relation_id",
        "parent_id",
        "metadata",
        "active",
        "created_at",
        "updated_at",
    ];

    protected $casts = [
        'type' => IdentitiesCoreTypes::class,
        'metadata' => 'array',
        'active' => 'boolean',
        "updated_at" => "datetime",
        "created_at" => "datetime",
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            // create new unique code
            $model->code = self::generateNewCode();
        });
    }

    static function generateNewCode(): string
    {
        $code = Str::uuid();
        if (static::query()->where('code', $code)->exists()) {
            return self::generateNewCode();
        }
        return $code;
    }
}
