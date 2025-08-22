<?php

namespace Bhry98\AccountCenter\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChannelResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            "code" => $this->code,
            "type" =>  $this->type->getLabel(),
            "active" => $this->active,
        ];
    }
}
