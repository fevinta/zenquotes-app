<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FavoriteQuoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'author' => ['required', 'string', 'max:255'],
            'quote'  => ['required', 'string', 'max:255'],
        ];
    }
}
