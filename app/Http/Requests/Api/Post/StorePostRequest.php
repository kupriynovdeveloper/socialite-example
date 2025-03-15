<?php

namespace App\Http\Requests\Api\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|string|min:5|max:255',
            'text' => 'required|string|max:4000',
            'is_published' => 'nullable|bool',
            'profile_id' => 'required|int',
            'category_id' => 'required|int',
            'image_id' => 'nullable',
            'view' => 'nullable|int',
            'no_comments' => 'nullable|int',
            'published_at' => 'nullable',
        ];
    }
}
