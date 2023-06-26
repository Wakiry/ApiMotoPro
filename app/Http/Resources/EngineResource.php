<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EngineResource extends JsonResource
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
            'id_engine' => $this->id_engine,
            'id_engine_type' => $this->id_engine_type,
            'capacity' => $this->capacity
        ];
    }
}
