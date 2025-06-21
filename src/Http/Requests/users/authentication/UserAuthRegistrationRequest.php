<?php

namespace Bhry98\Bhry98LaravelReady\Http\Requests\users\authentication;

use Bhry98\Bhry98LaravelReady\Models\enums\EnumsCoreModel;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCitiesModel;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCountriesModel;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsGovernoratesModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

//use\HttpResponseException;


class UserAuthRegistrationRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $fixedData["redirect_link"] = is_null($this->redirect_link) ? session("redirect_link") : $this->redirect_link;
        $fixedData["must_change_password"] = $this->must_change_password ?? false;
        return $this->merge($fixedData);
    }

    public function rules(): array
    {
        $roles["username"] = [
            bhry98_app_settings(key: "validations.users_require_username", default: "required"),
            "string",
            "unique:" . UsersCoreUsersModel::TABLE_NAME . ",username",
        ];
        $roles["first_name"] = [
            "required",
            "string",
            "max:50",
        ];
        $roles["last_name"] = [
            "required",
            "string",
            "max:50",
        ];
        $roles["display_name"] = [
            "sometimes",
            "nullable",
            "string",
            "max:50",
        ];
        $roles["email"] = [
            bhry98_app_settings(key: "validations.users_require_email", default: "required"),
            "email",
            "unique:" . UsersCoreUsersModel::TABLE_NAME . ",email",
        ];
        $roles["phone_number"] = [
            bhry98_app_settings(key: "validations.users_require_phone_number", default: "required"),
            "numeric",
            "digits:11",
            "starts_with:010,011,012,015",
            "unique:" . UsersCoreUsersModel::TABLE_NAME . ",phone_number",
        ];
        $roles["password"] = [
            "required",
            "string",
            "between:8,50",
            "confirmed",
        ];
        $roles["type"] = [
            "sometimes",
            "nullable",
            "string",
            "exists:" . EnumsCoreModel::TABLE_NAME . ",code",
        ];
        $roles["birthdate"] = [
            "sometimes",
            "nullable",
            "date",
            "before:" . date('Y') - 10,
        ];
        $roles["national_id"] = [
            bhry98_app_settings(key: "validations.users_require_national_id", default: "required"),
            "numeric",
            "digits:14",
            "unique:" . UsersCoreUsersModel::TABLE_NAME . ",national_id",
        ];
        $roles["country"] = [
            "nullable",
            "string",
            "exists:" . LocationsCountriesModel::TABLE_NAME . ",code",
        ];
        $roles["governorate"] = [
            "nullable",
            "string",
            "exists:" . LocationsGovernoratesModel::TABLE_NAME . ",code",
        ];
        $roles["city"] = [
            "nullable",
            "string",
            "exists:" . LocationsCitiesModel::TABLE_NAME . ",code",
        ];
        $roles["redirect_link"] = [
            "nullable",
            "string"
        ];
        $roles["must_change_password"] = [
            "required",
            "boolean"
        ];
        return $roles;
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        if ($this->expectsJson()) {
            $errors = collect((new \Illuminate\Validation\ValidationException($validator))->errors())->mapWithKeys(function ($messages, $key) {
                return [self::attributes()[$key] ?? $key => $messages];
            })->toArray();

            throw new \Illuminate\Http\Exceptions\HttpResponseException(
                bhry98_response_validation_error(
                    data: $errors,
                    message: (new \Illuminate\Validation\ValidationException($validator))->getMessage()
                )
            );
        }
        parent::failedValidation($validator);
    }

    public function attributes(): array
    {
        return [
//            "username"=> __(key: "Bhry98::users.username"),
//            "first_name"=> __(key: "Bhry98::users.first_name"),
//            "last_name"=> __(key: "Bhry98::users.last_name"),
//            "display_name"=> __(key: "Bhry98::users.display_name"),
//            "email"=> __(key: "Bhry98::users.email"),
//            "phone_number"=> __(key: "Bhry98::users.phone_number"),
//            "password"=> __(key: "Bhry98::users.password"),
//            "type"=> __(key: "Bhry98::users.type"),
//            "country"=> __(key: "Bhry98::users.country"),
//            "governorate_id"=> __(key: "Bhry98::users.governorate_id"),
//            "city_id"=> __(key: "Bhry98::users.city_id"),
//            "birthdate"=> __(key: "Bhry98::users.birthdate"),
//            "national_id"=> __(key: "Bhry98::users.national_id"),
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
