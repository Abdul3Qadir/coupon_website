<?php

namespace App\Http\Requests;

use App\Enums\DiscountType;
use App\Enums\OfferType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('brand')->check() || auth('admin')->check();
    }

    public function rules(): array
    {
        $type = $this->input('type', 'coupon');

        return [
            'type' => ['required', Rule::enum(OfferType::class)],
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'discount_type' => ['required', Rule::enum(DiscountType::class)],
            'discount_value' => ['nullable', 'numeric', 'min:0'],
            'code' => [$type === 'coupon' ? 'required' : 'nullable', 'string', 'max:100'],
            'redirect_url' => ['required', 'url', 'max:500'],
            'description' => ['nullable', 'string', 'max:1000'],
            'terms_conditions' => ['nullable', 'string', 'max:2000'],
            'starts_at' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->input('type') === 'deal') {
            $this->merge(['code' => null]);
        }

        if ($this->input('discount_type') === 'free_shipping') {
            $this->merge(['discount_value' => null]);
        }
    }
}