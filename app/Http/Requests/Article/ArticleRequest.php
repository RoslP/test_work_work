<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:10',
            'content' => 'required|string|min:30',
            'category_id' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Заголовок обязателен.',
            'title.min' => 'Заголовок должен быть не короче :min символов.',

            'content.required' => 'Контент обязателен.',
            'content.min' => 'Контент должен быть не короче :min символов.',

            'category_id.required' => 'Категория обязательна.',
            'category_id.integer' => 'Категория должна быть числом.',
        ];
    }
}
