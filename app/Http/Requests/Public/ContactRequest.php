<?php

namespace App\Http\Requests\Public;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Formulaire public, accessible à tout visiteur.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:200'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }

    /**
     * Messages d'erreur personnalisés en français.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => "L'email est obligatoire.",
            'email.email' => "L'adresse email n'est pas valide.",
            'subject.required' => 'Le sujet est obligatoire.',
            'message.required' => 'Le message est obligatoire.',
            'message.max' => 'Le message ne doit pas dépasser 5000 caractères.',
        ];
    }
}
