<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BikeResource extends JsonResource
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
            'id_bike' => $this->id_bike,
            'id_user' => $this->id_user,
            'id_model_bike' => $this->id_model_bike,
            'hour' => $this->hour,
            'km' => $this->km,
            'date_add' => $this->date_add,
            'date_update' => $this->date_update
        ];
    }
}
