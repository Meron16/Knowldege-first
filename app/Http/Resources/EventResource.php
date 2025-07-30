<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'headline' => $this->headline,
            'description' => $this->description,
            'image' => $this->image,
            'video_link' => $this->video_link,
            'details' => $this->details,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

           ];
    }
}
