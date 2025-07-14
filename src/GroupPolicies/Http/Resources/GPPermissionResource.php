<?php

namespace Bhry98\GP\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RBACPermissionResource
 *
 * Transforms a permission model into a structured JSON response.
 *
 * @package Bhry98\GP\Http\Resources
 */
class GPPermissionResource extends JsonResource
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
            'total_groups' => $this->groups_count ?? 0,
        ];
    }
}
