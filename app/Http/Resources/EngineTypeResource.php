<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EngineTypeResource extends JsonResource
{
    private int $idEngineType;
    private string $name;

    /**
     * Transform the resource into an array.
     *
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id_engine_type' => $this->idEngineType,
            'name' => $this->name
        ];
    }
}
