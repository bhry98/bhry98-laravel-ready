<?php

namespace Bhry98\Users\Http\Requests\authentication;

use Bhry98\Helpers\extends\BaseRequest;
use Bhry98\Locations\Models\LocationsCitiesModel;
use Bhry98\Locations\Models\LocationsCountriesModel;
use Bhry98\Locations\Models\LocationsGovernoratesModel;
use Bhry98\Settings\Models\SettingsEnumsModel;
use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Validation\Rule;

class UserAuthRegistrationRequest extends BaseRequest
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
            config("bhry98.registration.require_username") ? "required" : "nullable",
            "string",
            Rule::unique(UsersCoreModel::class, 'username'),
        ];
        $roles["email"] = [
            config("bhry98.registration.require_email") ? "required" : "nullable",
            "email",
            Rule::unique(UsersCoreModel::class, 'email'),
        ];
        $roles["phone_number"] = [
            config("bhry98.registration.require_phone_number") ? "required" : "nullable",
            "phone",
            Rule::unique(UsersCoreModel::class, 'phone_number'),
        ];
        $roles["national_id"] = [
            config("bhry98.registration.require_national_id") ? "required" : "nullable",
            "numeric",
            "digits_between:8,20",
            Rule::unique(UsersCoreModel::class, 'national_id'),
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
        $roles["password"] = [
            "required",
            "string",
            "between:8,50",
            "confirmed",
        ];
        $roles["type"] = [
            "nullable",
            "string",
            "exists:" . (new SettingsEnumsModel)->getTable() . ",code",
        ];
        $roles["birthdate"] = [
            "sometimes",
            "nullable",
            "date",
            "before:" . date('Y') - 10,
        ];
        $roles["country"] = [
            "nullable",
            "string",
            "exists:" . (new LocationsCountriesModel)->getTable() . ",code",
        ];
        $roles["governorate"] = [
            "nullable",
            "string",
            "exists:" . (new LocationsGovernoratesModel)->getTable() . ",code",
        ];
        $roles["city"] = [
            "nullable",
            "string",
            "exists:" . (new LocationsCitiesModel)->getTable() . ",code",
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
}
