<?php

namespace Bhry98\AccountCenter\Http\Resources;

use Bhry98\Users\Http\Resources\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            "code" => $this->code,
            "channel" => $this->whenLoaded('channel', ChannelResource::make($this->channel)),
            "from" => $this->from ? UserResource::make($this->from) : config("bhry98.bot_name"),
            "body" => $this->body,
            "type" => $this->type->getLabel(),
            "read" => (bool)$this->read_at,
            "read_at" => (bool)$this->read_at ? Carbon::parse($this->read_at)->format(config("bhry98.date.format")) : null,
        ];
    }
}
