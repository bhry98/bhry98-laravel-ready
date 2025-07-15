<?php

namespace Bhry98\Users\Http\Requests\notifications;


use Bhry98\Helpers\extends\BaseRequest;
use Bhry98\Users\Models\UsersChatChannelsUsersModel;
use Bhry98\Users\Models\UsersChatMessagesModel;
use Illuminate\Validation\Rule;

class UsersGetNotificationsByCodeRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }


    public function prepareForValidation()
    {
        $fixData['code'] = $this->route('notificationCode');
        return $this->merge($fixData);
    }

    public function rules(): array
    {
        $rules = [];
        $rules['code'] = [
            "required",
            Rule::exists((new UsersChatMessagesModel)->getTable(), 'code')->where(function ($query) {
                $query->whereIn('channel_id', function ($subquery) {
                    $subquery->select('channel_id')
                        ->from((new UsersChatChannelsUsersModel)->getTable())
                        ->where('user_id', auth()->id());
                });
            }),
        ];
        return $rules;
    }
}
