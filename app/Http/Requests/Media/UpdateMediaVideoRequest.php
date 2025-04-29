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
            'name'          => 'required|string|max:255',
            'description'   => 'required|string|max:255',
            'status'        => 'required|string|in:draft,published',
            'video_file'    => 'nullable|file|mimes:mp4,webm,ogg|max:102400',
            'thumbnail_file'=> 'nullable|file|mimes:jpg,jpeg,png|max:5120',
            'questions'     => 'required|string'
        ];
    }
}

