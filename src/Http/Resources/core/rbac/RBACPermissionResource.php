<?php

namespace Bhry98\Bhry98LaravelReady\Http\Resources\core\rbac;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RBACPermissionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "code" => $this->code,
            "name" => $this->name ?? $this->default_name,
            "total_groups" => $this->groups_count
        ];
    }
}
