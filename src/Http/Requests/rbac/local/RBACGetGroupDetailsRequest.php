<?php

namespace Bhry98\Bhry98LaravelReady\Http\Requests\rbac\local;

use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RBACGetGroupDetailsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can("Core.LocalRBAC.RetrieveGroup");
    }

    public function prepareForValidation()
    {
        $fixData = [];
        //        if ($this->with) $fixData["with"] = explode(separator: ',', string: $this->with);
        $fixData["groupCode"] = $this->route('groupCode');
        return $this->merge($fixData);
    }

    public function rules(): array
    {
        $rules = [];

        $rules['groupCode'] = [
            "required",
            "exists:" . RBACGroupsModel::TABLE_NAME . ",code"
        ];
        $rules['with'] = [
            "sometimes",
            "array",
        ];
        $rules['with.*'] = [
            "sometimes",
            "string",
            Rule::in(RBACGroupsModel::RELATIONS)
        ];
        return $rules;
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
}
