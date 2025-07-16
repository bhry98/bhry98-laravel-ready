<?php

namespace Bhry98\Users\Models;

use Bhry98\GP\Models\GPGroupsUsersModel;
use Bhry98\Helpers\extends\BaseModel;
use Bhry98\Locations\Models\LocationsCitiesModel;
use Bhry98\Locations\Models\LocationsCountriesModel;
use Bhry98\Locations\Models\LocationsGovernoratesModel;
use Bhry98\Settings\Models\SettingsEnumsModel;
use Bhry98\Users\Enums\UsersAccountTypes;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Laravolt\Avatar\Avatar;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;

class UsersCoreModel extends Authenticatable implements FilamentUser, HasAvatar, HasName
{
    use HasApiTokens, SoftDeletes, Notifiable, AuthenticationLoggable;

    const RELATIONS = ["country", "governorate", "city", "type", "gender"];
    const FILTER_COLUMNS = ["display_name", "phone_number", "national_id", "username", "email"];

    public function getTable(): ?string
    {
        return strtolower(config('bhry98.db_prefix') . "users_core");
    }

    public function getRouteKeyName(): string
    {
        return "code";
    }

    protected $casts = [
        "email_verified_at" => "datetime",
        "phone_number_verified_at" => "datetime",
        "password" => "hashed",
        "remember_token" => "string",
        "must_change_password" => "boolean",
        "must_verify_phone" => "boolean",
        "must_verify_email" => "boolean",
        "account_type" => UsersAccountTypes::class,
        "active" => "boolean",
        "birthdate" => "date:Y-m-d",
        "national_id" => "integer",
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "deleted_at" => "datetime",
    ];

    public function type(): HasOne
    {
        return $this->hasOne(SettingsEnumsModel::class, "id", "type_id");
    }

    protected $fillable = [
        "id",
        "code",
        "display_name",
        "first_name",
        "middle_name",
        "last_name",
        "title",
        "job_position",
        "work_email",
        "phone_number",
        "must_verify_phone",
        "phone_number_verified_at",
        "bio",
        "national_id",
        "birthdate",
        "language",
        "theme",
        "username",
        "email",
        "must_verify_email",
        "email_verified_at",
        "must_change_password",
        "password",
        "type_id",
        "timezone",
        "gender_id",
        "nationality_id",
        "country_id",
        "governorate_id",
        "city_id",
        "account_type",
        "active",
    ];

    public function gender(): HasOne
    {
        return $this->hasOne(SettingsEnumsModel::class, "id", "gender_id");
    }

    public function country(): HasOne
    {
        return $this->hasOne(LocationsCountriesModel::class, "id", "country_id");
    }

    public function nationality(): HasOne
    {
        return $this->hasOne(LocationsCountriesModel::class, "id", "nationality_id");
    }

    public function governorate(): HasOne
    {
        return $this->hasOne(LocationsGovernoratesModel::class, "id", "governorate_id");
    }

    public function city(): HasOne
    {
        return $this->hasOne(LocationsCitiesModel::class, "id", "city_id");
    }

    public function groups(): HasMany
    {
        return $this->hasMany(GPGroupsUsersModel::class, "user_id", "id")->with("group");
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

    public function canEdit(): bool
    {
        $notDeleted = is_null($this->getAttribute('deleted_at'));
        $abilities = auth()->user()?->can('Users.Update');
        return $notDeleted && $abilities;
    }

    public function canDelete($relationsCount): bool
    {
        $notDeleted = is_null($this->getAttribute('deleted_at'));
        $abilities = auth()->user()?->can('Users.Delete');
        $isNotAuthUser = auth()->id() != $this->id;
        return $notDeleted && $abilities && $isNotAuthUser && $relationsCount <= 0;
    }

    public function canForceDelete($relationsCount): bool
    {
        $notDeleted = !is_null($this->getAttribute('deleted_at'));
        $abilities = auth()->user()?->can('Users.ForceDelete');
        $isNotAuthUser = auth()->id() != $this->id;
        return $notDeleted && $abilities && $isNotAuthUser && $relationsCount <= 0;
    }

    public function canRestore(): bool
    {
        $notDeleted = !is_null($this->getAttribute('deleted_at'));
        $abilities = auth()->user()?->can('Users.Restore');
        return $notDeleted && $abilities;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    public function getFilamentName(): string
    {
        return "{$this->display_name}";
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->account_type == UsersAccountTypes::Administrator;
    }


    public static function booting(): void
    {
        static::creating(function ($model) {
            // Ensure the display name always exists
            $model->display_name = $model->display_name ?: trim("{$model->first_name} {$model->last_name}");

            // Unique username
            $model->username = self::createUniqueTextForColumn("username", $model->username, upperCase: false);

            // Unique code
            $model->code = self::createUniqueTextForColumn("code", $model->code);

            // Default values
            $model->must_change_password = $model->must_change_password ?? false;
            $model->work_email = $model->work_email ?? $model->email ?? null;
        });
    }

    public static function createUniqueTextForColumn(string $column, ?string $str = null, int $length = 10, bool $upperCase = true): string
    {
        if ($str) {
            $baseCode = $upperCase ? Str::upper(Str::slug($str)) : Str::lower(Str::slug($str));
            if (!static::query()->where($column, $baseCode)->exists()) {
                return $baseCode;
            }
        }
        do {
            $code = $upperCase ? Str::upper(Str::random($length)) : Str::lower(Str::random($length));
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

//    public function notifications(): MorphMany
//    {
//        return $this->morphMany(UsersNotificationsModel::class, 'notifiable')
//            ->orderBy('created_at', 'desc');
//    }
//
//    public function unreadNotifications(): MorphMany
//    {
//        return $this->morphMany(UsersNotificationsModel::class, 'notifiable')
//            ->whereNull('read_at')
//            ->orderBy('created_at', 'desc');
//    }
}
