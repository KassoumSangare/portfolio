<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEducationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'school' => ['required', 'string', 'max:150'],
            'degree' => ['required', 'string', 'max:150'],
            'field' => ['nullable', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:3000'],
            'start_year' => ['required', 'integer', 'digits:4', 'min:1970', 'max:' . (date('Y') + 1)],
            'end_year' => ['nullable', 'integer', 'digits:4', 'min:1970', 'gte:start_year'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    /**
     * Messages d'erreur personnalisés en français.
     */
    public function messages(): array
    {
        return [
            'school.required' => "L'établissement est obligatoire.",
            'degree.required' => 'Le diplôme est obligatoire.',
            'start_year.required' => 'L\'année de début est obligatoire.',
            'start_year.digits' => "L'année de début doit comporter 4 chiffres.",
            'end_year.digits' => "L'année de fin doit comporter 4 chiffres.",
            'end_year.gte' => "L'année de fin doit être postérieure ou égale à l'année de début.",
        ];
    }
}
