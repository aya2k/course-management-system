<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursesResource extends JsonResource
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
            'name'        => $this->name,
            'desc'        => $this->desc,
            'duration'    => $this->duration,
            'price'       => $this->price,
            'is_avaliable'=> $this->is_avaliable,
            'num_students'=> $this->num_students,
            'image'       => $this->image ? asset('storage/' . $this->image) : null,
            'trainer'     => [
                'id'    => $this->trainer->id ?? null,
                'name'  => $this->trainer->name ?? null,
                'email' => $this->trainer->email ?? null,
            ],
        ];
    }
}
