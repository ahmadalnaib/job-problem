<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\JobApplicationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class InterviewResource extends JsonResource
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
            'job_application_id' => $this->job_application_id,
            'scheduled_at' => $this->scheduled_at,
            'slug' => $this->slug,
            'remind_me' => $this->remind_me,
            'location' => $this->location,
            'reminder_sent' => $this->reminder_sent,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // Optionally include related job application data:
            'job_application' => new JobApplicationResource($this->whenLoaded('jobApplication')),

        ];
    }
}
