<?php

namespace Bhry98\Bhry98LaravelReady\Http\Resources\users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AzureUserResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            "user" => UserResource::make($this->whenLoaded(relationship: "user")),
            "identity_code" => $this->identity_code,
            "given_name" => $this->given_name,
            "surname" => $this->surname,
            "display_name" => $this->display_name,
            "account_enabled" => $this->account_enabled,
            "mail" => $this->mail,
            "user_type" => $this->user_type,
            "job_title" => $this->job_title,
            "department" => $this->department,
            "company_name" => $this->company_name,
            "employee_id" => $this->employee_id,
            "employee_type" => $this->employee_type,
            "employee_hire_date" => $this->employee_hire_date,
            "office_location" => $this->office_location,
            "street_address" => $this->street_address,
            "city" => $this->city,
            "state" => $this->state,
            "postal_code" => $this->postal_code,
            "country" => $this->country,
            "mobile_phone" => $this->mobile_phone,
            "fax_number" => $this->fax_number,
            "avatar_base64" => $this->avatar_base64,

//            "business_phones",
//            "other_mails",
        ];
    }
}
