<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return [
                'title'       => 'sometimes|required|string|max:255',
                'description' => 'sometimes|nullable|string',
                'status'      => 'sometimes|required|in:pending,in_progress,completed',
                'Priority'    => 'sometimes|nullable|in:low,medium,high',
                'started_at'  => 'sometimes|nullable|date',
                'ended_at'    => 'sometimes|nullable|date|after:started_at',
            ];
        }

        return [
            'project_id'  => 'required|exists:projects,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'nullable|in:pending,in_progress,completed',
            'Priority'    => 'nullable|in:low,medium,high',
            'started_at'  => 'nullable|date',
            'ended_at'    => 'nullable|date|after:started_at',
        ];

    }
}
