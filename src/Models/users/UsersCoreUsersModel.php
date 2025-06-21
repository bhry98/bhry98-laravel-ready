<?php

namespace Bhry98\Bhry98LaravelReady\Models\users;

use Bhry98\Bhry98LaravelReady\Models\enums\EnumsCoreModel;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Bhry98\Bhry98LaravelReady\Models\locations\{
    LocationsCitiesModel,
    LocationsCountriesModel,
    LocationsGovernoratesModel
};
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsUsersModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authentication;
use Laravel\Sanctum\HasApiTokens;
use Laravolt\Avatar\Avatar;

class UsersCoreUsersModel extends Authentication
{
    use HasApiTokens, SoftDeletes, Notifiable;

    const TABLE_NAME = "users_core";
    const RELATIONS = ["country", "governorate", "city", "type", "gender", "azure", "adManager"];
    const FILTER_COLUMNS = ["display_name", "phone_number", "national_id", "username", "email"];
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "id",
        "type_id",
        "country_id",
        "governorate_id",
        "city_id",
        "gender_id",
        "timezone_id",
        "display_name",
        "first_name",
        "last_name",
        "phone_number",
        "national_id",
        "active",
        "birthdate",
        "username",
        "email",
        "email_verified_at",
        "must_change_password",
        "password",
    ];
    protected $casts = [
        "email_verified_at" => "datetime",
        "password" => "hashed",
        "remember_token" => "string",
        "must_change_password" => "boolean",
        "active" => "boolean",
        "birthdate" => "date:Y-m-d",
        "national_id" => "integer",
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "deleted_at" => "datetime",
    ];

    public function type(): HasOne
    {
        return $this->hasOne(
            related: EnumsCoreModel::class,
            foreignKey: "id",
            localKey: "type_id");
    }

    public function gender(): HasOne
    {
        return $this->hasOne(
            related: EnumsCoreModel::class,
            foreignKey: "id",
            localKey: "gender_id");
    }

    public function timezone(): HasOne
    {
        return $this->hasOne(
            related: EnumsCoreModel::class,
            foreignKey: "id",
            localKey: "timezone_id");
    }

    public function country(): HasOne
    {
        return $this->hasOne(
            related: LocationsCountriesModel::class,
            foreignKey: "id",
            localKey: "country_id");
    }

    public function governorate(): HasOne
    {
        return $this->hasOne(
            related: LocationsGovernoratesModel::class,
            foreignKey: "id",
            localKey: "governorate_id");
    }

    public function city(): HasOne
    {
        return $this->hasOne(
            related: LocationsCitiesModel::class,
            foreignKey: "id",
            localKey: "city_id");
    }

    public function groups(): HasMany
    {
        return $this->hasMany(
            related: RBACGroupsUsersModel::class,
            foreignKey: "user_id",
            localKey: "id")->with("group");
    }

    public function avatarBase64(): Attribute
    {
        return new Attribute(
            get: fn() => (new Avatar())->create($this->display_name ?? env(key: "APP_NAME"))->setBackground('#50aff7')->toBase64(),
        );
    }

    public function avatarUrl(): Attribute
    {
        return new Attribute(
            get: fn() => (new Avatar())->create($this->email ?? env(key: "APP_NAME"))->toGravatar(['d' => 'identicon', 'r' => 'pg', 's' => 300])
        );
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->username = self::createUniqueTextForColumn("username", $model->username);
            $model->code = self::createUniqueTextForColumn("code", $model->code);
            $model->display_name = $model->display_name ?: "$model->first_name $model->last_name";
            $model->must_change_password = $model->must_change_password ?? false;
        });
        static::updating(function ($model) {
            $model->display_name = $model->display_name ?: "$model->first_name $model->last_name";
        });
    }

    private static function createUniqueTextForColumn(string $column, ?string $str = null, int $length = 10): string
    {
        if ($str) {
            $baseCode = Str::upper(Str::slug($str));
            if (!static::query()->where($column, $baseCode)->exists()) {
                return $baseCode;
            }
        }
        do {
            $code = Str::upper(Str::random($length));
        } while (static::query()->where($column, $code)->exists());
        return $code;
    }


    public function hasPermission($permissionCode): bool
    {
        if (!Cache::has("user_permissions_" . auth()->id())) {
            $userGroups = $this->groups;
            if (!$userGroups || count($userGroups) <= 0) return false;
            $this->cachePermissions($userGroups);
        }
        $permissions = Cache::get("user_permissions_" . auth()->id());
        return in_array($permissionCode, $permissions ?? []);
    }

    function cachePermissions($userGroups): void
    {
        $allPermissions = collect();
        $userGroups->each(function ($userGroup) use ($allPermissions) {
            $permissionsFromGroup = $userGroup->group?->permissions;
            if ($permissionsFromGroup && count($permissionsFromGroup) > 0) {
                $permissionsFromGroup->each(function ($permission) use ($userGroup, $allPermissions) {
                    $allPermissions->push($permission->permission?->code ?? '');
                });
            }
        });
        Cache::remember("user_permissions_" . auth()->id(), now()->addDay(), function () use ($allPermissions) {
            return $allPermissions->toArray();
        });
    }

    public function notifications(): MorphMany
    {
        return $this->morphMany(UsersNotificationsModel::class, 'notifiable')
            ->orderBy('created_at', 'desc');
    }

    public function unreadNotifications(): MorphMany
    {
        return $this->morphMany(UsersNotificationsModel::class, 'notifiable')
            ->whereNull('read_at')
            ->orderBy('created_at', 'desc');
    }
}
