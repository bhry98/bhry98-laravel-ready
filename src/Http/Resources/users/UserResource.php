<?php

namespace Bhry98\Bhry98LaravelReady\Http\Resources\users;

use Bhry98\Bhry98LaravelReady\Http\Resources\core\enums\EnumsResource;
use Bhry98\Bhry98LaravelReady\Http\Resources\locations\{
    CityResource,
    CountryResource,
    GovernorateResource,
};
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            "code" => $this->identity_code,
            "type" => $this->type ? EnumsResource::make($this->type) : null,
            "gender" => $this->gender ? EnumsResource::make($this->gender) : null,
            "timezone" => $this->timezone ? EnumsResource::make($this->timezone) : null,
            "display_name" => $this->display_name,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "phone_number" => $this->phone_number,
            "national_id" => $this->national_id,
            "birthdate" => $this->birthdate,
            "username" => $this->username,
            "email" => $this->email,
            "must_change_password" => $this->must_change_password,
            "active" => $this->active,
            "country" => CountryResource::make($this->whenLoaded(relationship: 'country')),
            "governorate" => GovernorateResource::make($this->whenLoaded(relationship: 'governorate')),
            "city" => CityResource::make($this->whenLoaded(relationship: 'city')),
            "avatar" => $this->avatar_url,
        ];
    }
}
