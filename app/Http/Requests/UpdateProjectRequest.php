<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
     *
     * L'image est optionnelle à la mise à jour (conserve l'ancienne si absente).
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:3000'],
            'client_company' => ['nullable', 'string', 'max:150'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string', 'max:50'],
            'project_url' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_featured' => ['nullable', 'boolean'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    /**
     * Prépare les données avant validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured' => $this->boolean('is_featured'),
        ]);
    }

    /**
     * Messages d'erreur personnalisés en français.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Le titre du projet est obligatoire.',
            'project_url.url' => "L'URL du projet n'est pas valide.",
            'image.image' => 'Le fichier doit être une image valide.',
            'image.max' => "L'image ne doit pas dépasser 2 Mo.",
        ];
    }
}
