<?php

namespace App\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;

class CreateMediaVideoRequest extends FormRequest
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
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'video_file'    => 'required|file|mimetypes:video/mp4,video/x-msvideo,video/x-ms-wmv,video/quicktime,video/x-flv,video/webm',
            'thumbnail_file' => 'nullable|file|mimetypes:image/png,image/jpeg,image/jpg',
            'status'        => 'nullable|in:draft,published',
        ];
    }
}
