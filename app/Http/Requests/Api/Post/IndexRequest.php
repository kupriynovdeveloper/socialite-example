<?php

namespace App\Http\Requests\Api\Post;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'id' => 'nullable|integer',
            'title' => 'nullable|string',
            'view_to' => 'nullable|integer',
            'view_from' => 'nullable|integer',
            'published_at_to' => 'nullable|date_format:Y-m-d H:i:s',
            'published_at_from' => 'nullable|date_format:Y-m-d H:i:s',
            'category_title' => 'nullable|string',
            'likes_to' => 'nullable|integer',
            'likes_from' => 'nullable|integer',
        ];
    }
}
