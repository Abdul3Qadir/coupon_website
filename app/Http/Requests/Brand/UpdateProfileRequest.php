<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'website_url' => ['required', 'url', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'short_description' => ['required', 'string', 'max:255'],
            'about_description' => ['nullable', 'string', 'max:3000'],
            'small_logo' => ['nullable', 'image', 'max:1024'],
            'large_logo' => ['nullable', 'image', 'max:2048'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'twitter_url' => ['nullable', 'url', 'max:255'],
            'allow_admin_to_add_offers' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'allow_admin_to_add_offers' => $this->boolean('allow_admin_to_add_offers'),
        ]);
    }
}