<?php

namespace Bhry98\Bhry98LaravelReady\Models\cache;

use Bhry98\Bhry98LaravelReady\Models\BaseModel;

class CacheCoreModel extends BaseModel
{
    // start env
    const TABLE_NAME = "cache_core";
    // start table
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "key",
        "value",
        "expiration",
    ];
}
