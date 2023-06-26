<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EngineTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id_engine_type' => $this->id_engine_type,
            'name' => $this->name
        ];
    }
}
