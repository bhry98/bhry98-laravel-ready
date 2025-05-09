<?php

namespace Bhry98\Bhry98LaravelReady\Http\Resources\users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ADManagerUserResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            "user" => UserResource::make($this->whenLoaded("user")),
            "avatar_base64" => $this->avatar_base64,
            "distinguished_name" => $this->distinguished_name,
            "domain_name" => $this->domain_name,
            "ou_name" => $this->ou_name,
            "sid_string" => $this->sid_string,
            "object_guid" => $this->object_guid,
            "sam_account_name" => $this->sam_account_name,
            "logon_name" => $this->logon_name,
            "employee_id" => $this->employee_id,
            "initial" => $this->initial,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "display_name" => $this->display_name,
            "city" => $this->city,
            "country" => $this->country,
            "email_address" => $this->email_address,
            "street_address" => $this->street_address,
            "mobile" => $this->mobile,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
//            "code" => $this->code,
//            "type" => $this->type ? EnumsResource::make($this->Type) : null,
//            "display_name" => $this->display_name,
//            "avatar_base64" => $this->avatar_base64,
//            "first_name" => $this->first_name,
//            "last_name" => $this->last_name,
//            "username" => $this->username,
//            "email" => $this->email,
//            "national_id" => $this->national_id,
//            "birthdate" => $this->birthdate ? bhry98_date_formatted($this->birthdate) : null,
//            "phone_number" => $this->phone_number,
//            "must_change_password" => $this->must_change_password,
//            "country" => CountryResource::make($this->whenLoaded(relationship: 'country')),
//            "governorate" => GovernorateResource::make($this->whenLoaded(relationship: 'governorate')),
//            "city" => CityResource::make($this->whenLoaded(relationship: 'city')),
        ];
    }
}
