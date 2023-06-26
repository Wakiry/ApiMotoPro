<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ModelBikeResource extends JsonResource
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
            'id_model_bike' => $this->id_model_bike,
            'id_manufacturer' => $this->id_manufacturer,
            'id_engine' => $this->id_engine,
            'name' => $this->name,
            'year_model' => $this->year_model
        ];
    }
}
