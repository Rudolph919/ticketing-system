<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'subject' => 'required',
            'description' => 'required',
            'status' => 'required',
            'category' => 'required',
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
            'status.required' => 'The ticket status field is required.',
            'status.exists' => 'The selected ticket status is invalid.',
            'description.required' => 'The status field is required.',
        ];
    }
}
