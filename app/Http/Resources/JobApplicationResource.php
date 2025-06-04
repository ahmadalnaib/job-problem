<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicationResource extends JsonResource
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
            'slug' => $this->slug,
            'company' => $this->company,
            'position' => $this->position,
            'applied_at' => $this->applied_at,
            'note' => $this->note,
            'job_link' => $this->job_link,
            'status' => $this->status,
        ];
    }
}
