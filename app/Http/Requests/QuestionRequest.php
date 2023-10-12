<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
        $questionId = $this->route()->parameter('questionId') ?? null;
        return [
            'question_text' => 'required|string|max:255',
            'question_rank' => 'required|integer|unique:questions,question_rank,'.$questionId,
        ];
    }

    public function messages(): array
    {
        return [
            'question_text.required' => 'Question text is required.',
            'question_text.string' => 'Question text should be a string.',
            'question_text.max' => 'Question text should not exceed 255 characters.',
            'question_rank.required' => 'Question rank is required.',
            'question_rank.integer' => 'Question rank should be an integer.',
            'question_rank.unique' => 'This rank is already in use. Please choose a different rank.',
        ];
    }
}
