<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ManufacturerResource extends JsonResource
{
    private int $idManufacturer;
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
            'id_manufacturer' => $this->idManufacturer,
            'name' => $this->name
        ];
    }
}
