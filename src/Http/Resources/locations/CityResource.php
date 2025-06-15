<?php

namespace Bhry98\Bhry98LaravelReady\Http\Resources\locations;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data = [];
        $data["code"] = $this->code;
        $data["name"] = $this->name ?? $this->default_name;
        $data["total_cities"] = $this->when(!is_null($this->cities_count), $this->cities_count, 0);
        $data["total_users"] = $this->when(!is_null($this->users_count), $this->users_count, 0);
        $data["country"] = CountryResource::make($this->whenLoaded("country"));
        $data["governorate"] = GovernorateResource::make($this->whenLoaded("governorate"));
        return $data;
    }
}
