<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       
         return auth('trainer_web')->check() || auth('api_trainer')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string', 'min:10'],
            'duration' => ['required', 'date_format:H:i'],
            'price' => ['required', 'numeric', 'min:0'],
            'is_avaliable' => ['nullable', 'boolean'],
        ];
    }
}
