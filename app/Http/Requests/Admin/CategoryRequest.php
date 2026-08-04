<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoryId = $this->route('category')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'string'],
            'is_trending' => ['sometimes', 'boolean'],
            'parent_id' => [
                'nullable',
                Rule::exists('categories', 'id'),
                Rule::notIn([$categoryId]),
            ],
        ];
    }
}