<?php

namespace App\Http\Requests;

use App\Models\Skill;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSkillRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', 'max:100'],
            'icon' => ['nullable', 'string', 'max:100'],
            'level' => ['required', Rule::in(Skill::LEVELS)],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    /**
     * Messages d'erreur personnalisés en français.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de la compétence est obligatoire.',
            'category.required' => 'La catégorie est obligatoire.',
            'level.required' => 'Le niveau est obligatoire.',
            'level.in' => 'Le niveau sélectionné est invalide.',
        ];
    }
}
