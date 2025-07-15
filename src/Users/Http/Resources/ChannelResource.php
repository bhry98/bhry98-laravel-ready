<?php

namespace Bhry98\Users\Http\Resources;

use Bhry98\Locations\Http\Resources\CityResource;
use Bhry98\Locations\Http\Resources\CountryResource;
use Bhry98\Locations\Http\Resources\GovernorateResource;
use Bhry98\Settings\Http\Resources\EnumsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChannelResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            "code" => $this->code,
            "type" => $this->type,
            "active" => $this->active,
        ];
    }
}
