<?php

namespace Bhry98\Helpers\models;

use Bhry98\Helpers\enums\LogsLevelsEnums;
use Bhry98\Helpers\enums\SystemActionEnums;
use Bhry98\Helpers\extends\BaseModel;

class LogsSystemModel extends BaseModel
{
    protected $table = "logs_system";
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
        "action" => SystemActionEnums::class,
        "log_level" => LogsLevelsEnums::class
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
