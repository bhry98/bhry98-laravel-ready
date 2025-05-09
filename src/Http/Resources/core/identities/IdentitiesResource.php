<?php

namespace Bhry98\Bhry98LaravelReady\Http\Resources\core\identities;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IdentitiesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "code" => $this->code,
            "type" => $this->type,
            "name" => $this->name,
            "module" => $this->module,
            "metadata" => $this->metadata,
            "is_active" => $this->is_active,
            "parent" => IdentitiesResource::make($this->whenLoaded(relationship: 'parent')),
        ];
    }
}
