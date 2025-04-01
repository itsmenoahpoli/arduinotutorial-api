<?php

namespace App\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMediaVideoRequest extends FormRequest
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
            'name'          => 'sometimes|required|string|max:255',
            'description'   => 'nullable|string',
            'video_file'    => 'sometimes|required|file|mimetypes:video/mp4,video/x-msvideo,video/x-ms-wmv,video/quicktime,video/x-flv,video/webm',
            'thumbnail_file' => 'nullable|file|mimetypes:image/png,image/jpeg,image/jpg',
            'status'        => 'nullable|in:draft,published',
            'question1'     => 'sometimes|required|string|max:255',
            'answer1'       => 'sometimes|required|string|max:255',
            'question2'     => 'sometimes|required|string|max:255',
            'answer2'       => 'sometimes|required|string|max:255',
            'question3'     => 'sometimes|required|string|max:255',
            'answer3'       => 'sometimes|required|string|max:255',
            'question4'     => 'sometimes|required|string|max:255',
            'answer4'       => 'sometimes|required|string|max:255',
            'question5'     => 'sometimes|required|string|max:255',
            'answer5'       => 'sometimes|required|string|max:255',
        ];
    }
}

