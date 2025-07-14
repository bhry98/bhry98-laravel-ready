<?php

namespace Bhry98\Bhry98LaravelReady\Models\users;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\DatabaseNotification;

class UsersNotificationsModel extends DatabaseNotification
{

    const TABLE_NAME = "users_notifications";
    const RELATIONS = ["fromUser", "toUser"];
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "id",
        "from_user_id",
//        "title_key",
//        "message_key",
//        "title_replaced",
//        "message_replaced",
        "icon",
        "color",
        "relation",
        "relation_id",
        "type",
        "notifiable",
        "data",
        "read_at",
    ];
    protected $casts = [
        "data" => "array",
    ];

    public function getTitle(): string
    {
        return __($this->title_key, $this->title_replaced ?? [], app()->getLocale());
    }

    public function getMessage(): string
    {
        return __($this->message_key, $this->message_replaced ?? [], app()->getLocale());
    }

    public function delete()
    {
        // Override delete method to do nothing
        return true;
    }

    // Optionally override forceDelete too, just in case
    public function forceDelete()
    {
        return true;
    }
//////////////////////
    public function fromUser(): HasOne
    {
        return $this->hasOne(
            related: UsersCoreModel::class,
            foreignKey: "id",
            localKey: "from_user_id");
    }

    public function toUser(): HasOne
    {
        return $this->hasOne(
            related: UsersCoreModel::class,
            foreignKey: "id",
            localKey: "to_user_id");
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
//            dd($model, $model->data['title_key']);
            $model->from_user_id = auth()->id();
//            $model->title_key = $model->data['title_key'] ?? null;
//            $model->message_key = $model->data['message_key'] ?? null;
//            $model->title_replaced = $model->data['title_replaced'] ?? null;
//            $model->message_replaced = $model->data['message_replaced'] ?? null;
            $model->icon = $model->data['icon'] ?? null;
            $model->color = $model->data['color'] ?? null;
            $model->relation = $model->data['relation'] ?? null;
            $model->relation_id = $model->data['relation_id'] ?? null;
        });
        static::updating(function ($model) {
//            $model->code = self::createUniqueTextForColumn('code', $model->code);
//            $model->updated_by = auth()->id();
        });
        static::deleting(function ($model) {
            dd($model);
        });
    }
}
