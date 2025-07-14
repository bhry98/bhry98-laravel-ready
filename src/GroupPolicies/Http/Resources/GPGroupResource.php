<?php

namespace Bhry98\GP\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RBACGroupResource
 *
 * Transforms an RBAC group model into a JSON response for API output.
 *
 * @package Bhry98\GP\Http\Resources
 */
class GPGroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name ?? $this->default_name,
            'description' => $this->description,
            'total_permissions' => $this->permissions_count ?? 0,
            'total_users' => $this->users_count ?? 0,
            'is_default' => (bool) $this->is_default,
            'active' => (bool) $this->active,
        ];
    }
}
