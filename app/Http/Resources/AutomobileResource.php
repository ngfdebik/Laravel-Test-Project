<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AutomobileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'auto_id' => $this->auto_id,
            'brand' => $this->brand,
            'model' => $this->model,
            'color' => $this->color,
            'stateNumberRF' => $this->stateNumberRF,
            'inTheParking' => (bool)$this->inTheParking,
        ];
    }
}
