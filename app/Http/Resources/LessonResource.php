<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'video_url'   => $this->video_url,
            'is_avaliable'=> $this->is_avaliable,
        
            'course'     => [
                'id'    => $this->course->id ?? null,
                'name'  => $this->course->name ?? null,
            ],
        ];
    }
}
