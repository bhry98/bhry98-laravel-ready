<?php

namespace Bhry98\Bhry98LaravelReady\Models\cache;

use Bhry98\Bhry98LaravelReady\Models\BaseModel;

class CacheLocksModel extends BaseModel
{
    // start env
    const TABLE_NAME = "cache_locks";
    // start table
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "key",
        "owner",
        "expiration",
    ];
}
