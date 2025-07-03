<?php

namespace Bhry98\Bhry98LaravelReady\Models\logs;

use Bhry98\Bhry98LaravelReady\Models\BaseModel;

class LogsUsersLogonsModel extends BaseModel
{
    const TABLE_NAME = "logs_users_logons";
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        'id',
        'ip_address',
        'user_id',
        'city',
        'region',
        'country',
        'loc',
        'org',
        'timezone',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->user_id = $model->user_id ?? auth()->id();
        });
    }
}
