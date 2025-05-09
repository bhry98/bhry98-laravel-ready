<?php

namespace Bhry98\Bhry98LaravelReady\Models\logs;

use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class LogsSystemModel extends BaseModel
{
    // start env
    const TABLE_NAME = "logs_system";
    // start table
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        'user_id',
        'log_level',
        'message',
        'app_profile',
        'context',
    ];
    protected $casts = [
        'context' => 'array',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->user_id = auth()->id();
            $model->app_profile = app()->isProduction() ? 'production' : 'development';
        });
    }
}
