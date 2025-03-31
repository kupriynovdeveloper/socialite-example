<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'text' => 'required|string',
            'published_at' => 'required|date_format:Y-m-d H:i',
            'category_id' => 'required|integer|exists:categories,id',
            'images' => 'nullable|array|max:5',
            'images.*' => 'nullable|file|image|mimes:jpg,jpeg,png|max:2048'
        ];
    }

    protected function passedValidation()
    {
        return $this->merge([
            'profile_id' => auth('web')->user()->profiles[0]->id
        ]);
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле должно быть заполнено',
            'title.string' => 'Поле должно быть в строковом формате',
            'text.required' => 'Поле обязательно для заполнения',
            'text.string' => 'Поле в строковом формате',
            'published_at.required' => 'Поле даты обязательно для заполнения',
            'published_at.date_format' => 'Поле даты в формате Y-m-d H:i',
            'category_id.required' => 'Поле должно быть заполнено',
            'category_id.exists' => 'Выбранной категории нет',
            'images.*.image' => 'Файл :attribute должен быть изображением.',
            'images.*.max' => 'Размер файла :attribute не должен превышать 2 МБ.',
        ];
    }
}
