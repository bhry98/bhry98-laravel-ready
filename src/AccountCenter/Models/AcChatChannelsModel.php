<?php

namespace Bhry98\AccountCenter\Models;

use Bhry98\AccountCenter\Enums\AcChatChannelsTypes;
use Bhry98\Helpers\extends\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcChatChannelsModel extends BaseModel
{
    use SoftDeletes;

    const RELATIONS = ["user"];
    protected $table = "ac_chat_channels";
    protected $fillable = [
        "id",
        "code",
        "type",
        "active",
    ];
    protected $casts = [
        "created_at" => "datetime",
        "active" => "boolean",
        "type" => AcChatChannelsTypes::class,
    ];

    public function users(): HasMany
    {
        return $this->hasMany(AcChatChannelsUsersModel::class, "channel_id", "id");
    }

    public function messages(): HasMany
    {
        return $this->hasMany(AcChatMessagesModel::class, "channel_id", "id");
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->code = self::createUniqueTextForColumn('code', $model->code, 50);
        });
    }

}
