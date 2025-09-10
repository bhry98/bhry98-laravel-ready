<?php

namespace Bhry98\Users\Http\Requests\profile;


use Bhry98\Helpers\extends\BaseRequest;
use Bhry98\Locations\Models\LocationsCitiesModel;
use Bhry98\Locations\Models\LocationsCountriesModel;
use Bhry98\Locations\Models\LocationsGovernoratesModel;
use Bhry98\Settings\Models\SettingsEnumsModel;
use Bhry98\Users\Enums\UsersGenders;
use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Validation\Rule;

class UserUpdateProfileRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function prepareForValidation()
    {
        $fixedData = [];
        return $this->merge($fixedData);
    }

    public function rules(): array
    {
        $userTable = (new UsersCoreModel)->getTable();
        $authId = auth()->id();
        $roles["username"] = [
            "sometimes",
            "string",
            "unique:$userTable,username," . $authId,
        ];
        $roles["first_name"] = [
            "sometimes",
            "string",
            "max:50",
        ];
        $roles["last_name"] = [
            "sometimes",
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
            "sometimes",
            "email",
            "unique:$userTable,email," . $authId,
        ];
        $roles["phone_number"] = [
            "sometimes",
            "phone",
            "unique:$userTable,phone_number," . $authId,
        ];
        $roles["birthdate"] = [
            "sometimes",
            "nullable",
            "date",
            "before:" . date('Y') - 10,
        ];
        $roles["national_id"] = [
            "sometimes",
            "numeric",
            "digits:14",
            "unique:$userTable,national_id," . $authId,
        ];
        $roles["country"] = [
            "sometimes",
            "nullable",
            "string",
            "exists:" . (new LocationsCountriesModel)->getTable() . ",code",
        ];
        $roles["governorate"] = [
            "sometimes",
            "nullable",
            "string",
            "exists:" . (new LocationsGovernoratesModel)->getTable() . ",code",
        ];
        $roles["city"] = [
            "sometimes",
            "nullable",
            "string",
            "exists:" . (new LocationsCitiesModel)->getTable() . ",code",
        ];
        $roles["type"] = [
            "sometimes",
            "nullable",
            "string",
            "exists:" . (new SettingsEnumsModel)->getTable() . ",code",
        ];
        $roles["gender"] = [
            "sometimes",
            "string",
            Rule::in(array_map(fn($case) => $case->name, UsersGenders::cases())),
        ];
        return $roles;
    }

}
