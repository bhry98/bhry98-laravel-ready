<?php

namespace Bhry98\Users\Http\Resources;

use Bhry98\Locations\Http\Resources\CityResource;
use Bhry98\Locations\Http\Resources\CountryResource;
use Bhry98\Locations\Http\Resources\GovernorateResource;
use Bhry98\Settings\Http\Resources\EnumsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            "code" => $this->code,
            "type" => $this->type ? EnumsResource::make($this->type) : null,
            "gender" => $this->gender?->getLabel() ?? null,
            "timezone" => $this->timezone,
            "display_name" => $this->display_name,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "phone_number" => $this->phone_number,
            "national_id" => $this->national_id,
            "birthdate" => $this->birthdate,
            "username" => $this->username,
            "email" => $this->email,
            "must_change_password" => $this->must_change_password,
            "must_verify_email" => $this->must_verify_email,
            "must_verify_phone" => $this->must_verify_phone,
            "active" => $this->active,
            "country" => CountryResource::make($this->whenLoaded(relationship: 'country')),
            "governorate" => GovernorateResource::make($this->whenLoaded(relationship: 'governorate')),
            "city" => CityResource::make($this->whenLoaded(relationship: 'city')),
            "avatar" => $this->avatar_url,
        ];
    }
}
