<?php

namespace Bhry98\Bhry98LaravelReady\Models\identities;

use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreCountriesModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreExtraValuesModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreGovernoratesModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreTypesModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class IdentitiesCoreModel extends Authenticatable
{
    use HasApiTokens, SoftDeletes;

    // start env
    const TABLE_NAME = "bhry98_identities_core";
    const RELATIONS = ["country", "governorate", "city"];
    const FILTERS = ["display_name", "first_name", "last_name", "phone_number", "national_id", "username", "email"];
    // start table
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "identity_code",
        "type_id",
        "country_id",
        "governorate_id",
        "city_id",
        "display_name",
        "first_name",
        "last_name",
        "phone_number",
        "national_id",
        "birthdate",
        "username",
        "email",
        "email_verified_at",
        "password",
    ];
    protected $casts = [
        "email_verified_at" => "datetime",
        "password" => "hashed",
        "remember_token" => "string",
        "birthdate" => "date:Y-m-d",
        "national_id" => "integer",
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "deleted_at" => "datetime",
    ];

    public function extraColumns(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(
            related: UsersCoreExtraValuesModel::class,
            foreignKey: "core_user_id",
            localKey: "id");
    }

    public function Type(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(
            related: UsersCoreTypesModel::class,
            foreignKey: "id",
            localKey: "type_id");
    }

    public function country(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(
            related: UsersCoreCountriesModel::class,
            foreignKey: "id",
            localKey: "country_id");
    }

    public function governorate(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(
            related: UsersCoreGovernoratesModel::class,
            foreignKey: "id",
            localKey: "governorate_id");
    }

    public function city(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(
            related: UsersCoreGovernoratesModel::class,
            foreignKey: "id",
            localKey: "city_id");
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            // create new unique code
            $model->code = self::generateNewCode();
        });
    }



    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

}
