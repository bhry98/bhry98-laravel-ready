<?php

namespace Bhry98\Bhry98LaravelReady\Models\logs;

use Bhry98\Bhry98LaravelReady\Enums\system\SystemActionEnums;
use Bhry98\Bhry98LaravelReady\Models\BaseModel;

class LogsSystemModel extends BaseModel
{
    const TABLE_NAME = "logs_system";
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        'user_id',
        'log_level',
        'action',
        'message',
        'app_profile',
        'context',
    ];
    protected $casts = [
        'context' => 'array',
        "action" => SystemActionEnums::class
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->user_id = auth()->id();
            $model->app_profile = app()->isProduction() ? 'production' : 'development';
            $model->action = $model->context['action'] ?? SystemActionEnums::Other->name;
        });
    }
}
