<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'driver' => $this->driver->name,
            'title' => $this->title,
            'car_number' => $this->car_number,
            'cover_image' => route('cars.image', $this->id),
            'model' => $this->model,
            'price' => $this->price,
            'created_at' => $this->when(request()->is('api/cars/*'), $this->created_at),
            'updated_at' => $this->when(request()->is('api/cars/*'), $this->updated_at),
        ];
    }
}
