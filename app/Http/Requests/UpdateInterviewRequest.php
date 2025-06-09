<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInterviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [
            'job_application_id' => 'required|exists:job_applications,id',
            'scheduled_at' => 'required|date',
            'remind_me' => 'date|nullable',
            'location' => 'string|max:255|nullable',
            'meeting_link' => 'nullable|string|max:255',
        ];
    }
}
