<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExperienceRequest extends FormRequest
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
            'company' => ['required', 'string', 'max:150'],
            'position' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:3000'],
            'location' => ['nullable', 'string', 'max:150'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date', 'required_if:is_current,false'],
            'is_current' => ['nullable', 'boolean'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    /**
     * Prépare les données avant validation (checkbox is_current).
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_current' => $this->boolean('is_current'),
            'end_date' => $this->boolean('is_current') ? null : $this->end_date,
        ]);
    }

    /**
     * Messages d'erreur personnalisés en français.
     */
    public function messages(): array
    {
        return [
            'company.required' => "L'entreprise est obligatoire.",
            'position.required' => 'Le poste est obligatoire.',
            'start_date.required' => 'La date de début est obligatoire.',
            'end_date.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
        ];
    }
}
