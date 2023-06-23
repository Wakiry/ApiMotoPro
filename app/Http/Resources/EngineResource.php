<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EngineResource extends JsonResource
{
    private int $idEngine;
    private int $idEngineType;
    private string $capacity;

    /**
     * Transform the resource into an array.
     *
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id_engine' => $this->idEngine,
            'id_engine_type' => $this->idEngineType,
            'capacity' => $this->capacity
        ];
    }
}
