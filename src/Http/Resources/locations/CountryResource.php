<?php

namespace Bhry98\Bhry98LaravelReady\Http\Resources\locations;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $data = [];
        $data["code"] = $this->code;
        $data["country_code"] = $this->country_code;
        $data["name"] = $this->name ?? $this->default_name;
        $data["flag"] = $this->flag;
        $data["lang_key"] = $this->lang_key;
        $data["system_lang"] = $this->system_lang;
        $data["total_governorates"] = $this->when(!is_null($this->governorates_count), $this->governorates_count, 0);
        $data["total_cities"] = $this->when(!is_null($this->cities_count), $this->cities_count, 0);
        $data["total_users"] = $this->when(!is_null($this->users_count), $this->users_count, 0);
        return $data;
    }
}
