<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'subject' => 'required',
            'description' => 'required',
            'category' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ];
    }

    /**
     * Get the validation messages that accompanies the rule.
     *
     */
    public function messages()
    {
        return [
            'subject.required' => 'The ticket subject field is required.',
            'category.required' => 'The ticket category field is required.',
            'category.exists' => 'The selected ticket category is invalid.',
            'description.required' => 'The status field is required.',
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'phone.required' => 'The phone number field is required.',
        ];
    }
}
