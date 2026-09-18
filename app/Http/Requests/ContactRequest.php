<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['nullable', 'string', 'max:30'],
            'company' => ['nullable', 'string', 'max:120'],
            'service' => ['nullable', 'string', 'max:100'],
            'budget' => ['nullable', 'string', 'max:60'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'website_url' => ['nullable', 'max:0'], // Honeypot spam trap
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'website_url.max' => 'Spam detected.',
            'name.required' => 'Please enter your full name.',
            'email.required' => 'Please provide a valid email address where we can reach you.',
            'email.email' => 'Please provide a valid email address.',
            'message.required' => 'Please describe your project requirements or question.',
            'message.min' => 'Please provide at least 10 characters describing your project.',
        ];
    }
}
