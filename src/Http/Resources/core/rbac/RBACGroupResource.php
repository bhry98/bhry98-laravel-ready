<?php

namespace Bhry98\Bhry98LaravelReady\Http\Resources\core\rbac;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RBACGroupResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "code" => $this->code,
            "name" => $this->name ?? $this->default_name,
            "description" => $this->description,
            "total_permissions" => $this->permissions_count,
            "total_users" => $this->users_count,
            "is_default" => $this->is_default,
            "active" => $this->active
        ];
    }
}
