<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecommendationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'userOption' => 'required | integer |exists:options,id'
        ];
    }

    public function messages(): array
    {
        return [
            'userOption.required' => 'Please provide the user selected response.',
            'userOption.integer' => 'Option ID must be an integer.',
            'userOption.exists' => 'Selected option ID is invalid.'
        ];
    }
}
