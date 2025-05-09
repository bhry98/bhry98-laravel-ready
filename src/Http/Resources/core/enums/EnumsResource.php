<?php

namespace Bhry98\Bhry98LaravelReady\Http\Resources\core\enums;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnumsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "code" => $this->code,
            "name" => $this->name ?? $this->default_name,
            "color" => $this->default_color,
            "parent" => EnumsResource::make($this->whenLoaded(relationship: 'parent')),
        ];
    }
}
