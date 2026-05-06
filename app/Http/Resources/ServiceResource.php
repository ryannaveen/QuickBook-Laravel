<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->service_name,
            'description' => $this->description,
            'price'       => number_format($this->price, 2),
            'duration'    => ($this->duration_minutes ?? 60) . ' mins',
            'provider'    => $this->owner?->name,
            'created_at'  => $this->created_at->toDateString(),
        ];
    }
}
