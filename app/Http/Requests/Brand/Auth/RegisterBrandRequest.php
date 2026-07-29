<?php

namespace App\Http\Requests\Brand\Auth;

use App\Rules\NotDisposableEmail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:brands,email', new NotDisposableEmail],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            'website_url' => ['required', 'url', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'short_description' => ['required', 'string', 'max:255'],
        ];
    }
}
