<?php

namespace App\Http\Requests\Api\Comment;

use App\Enums\CommentStatus;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'text' => 'required|string',
            'parent_id' => 'nullable|int',
            'status' => 'required|in:'.implode(',', CommentStatus::values()),
            'view' => 'required|int',
            'file_id' => 'nullable|int',
            'profile_id' => 'required|int',
            'post_id' => 'required|int',
        ];
    }
}
