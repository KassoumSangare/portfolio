<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Seul un utilisateur authentifié (middleware auth déjà appliqué
        // au niveau de la route) peut modifier le profil.
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:150'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'about' => ['nullable', 'string', 'max:5000'],
            'cv' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'years_experience' => ['nullable', 'integer', 'min:0', 'max:60'],
            'current_position' => ['nullable', 'string', 'max:150'],
            'current_company' => ['nullable', 'string', 'max:150'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }

    /**
     * Messages d'erreur personnalisés en français.
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'Le prénom est obligatoire.',
            'last_name.required' => 'Le nom est obligatoire.',
            'title.required' => 'Le titre professionnel est obligatoire.',
            'photo.image' => 'La photo doit être une image valide.',
            'photo.max' => 'La photo ne doit pas dépasser 2 Mo.',
            'cover_image.max' => "L'image de couverture ne doit pas dépasser 2 Mo.",
            'email.email' => "L'adresse email n'est pas valide.",
            'cv.mimes' => 'Le CV doit être un fichier PDF.',
            'cv.max' => 'Le CV ne doit pas dépasser 5 Mo.',
            'linkedin_url.url' => "L'URL LinkedIn n'est pas valide.",
            'github_url.url' => "L'URL GitHub n'est pas valide.",
            'website_url.url' => "L'URL du site web n'est pas valide.",
        ];
    }
}
