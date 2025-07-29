<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class CreateLessonRequest extends FormRequest
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
             'course_id' => ['required', 'exists:courses,id'],
           'name' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string', 'min:10'],
            'duration' => ['required', 'date_format:H:i'],
            'is_avaliable' => ['nullable', 'boolean'],
            'video_url'=> ['nullable',  'url'],
        ];
    }
}
