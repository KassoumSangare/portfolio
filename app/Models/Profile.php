<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    use HasFactory;

    /**
     * Les attributs assignables en masse.
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'title',
        'photo',
        'cover_image',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'about',
        'cv_path',
        'linkedin_url',
        'github_url',
        'website_url',
        'years_experience',
        'current_position',
        'current_company',
        'status',
    ];

    /**
     * Casts des attributs.
     */
    protected function casts(): array
    {
        return [
            'years_experience' => 'integer',
        ];
    }

    /**
     * Relation : un profil possède plusieurs compétences.
     */
    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    /**
     * Relation : un profil possède plusieurs expériences.
     */
    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    /**
     * Relation : un profil possède plusieurs formations.
     */
    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    /**
     * Accessor : nom complet (Prénom + Nom).
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => trim("{$this->first_name} {$this->last_name}"),
        );
    }

    /**
     * Accessor : URL publique de la photo de profil.
     */
    protected function photoUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->photo ? Storage::url($this->photo) : null,
        );
    }

    /**
     * Accessor : URL publique de l'image de couverture.
     */
    protected function coverImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->cover_image ? Storage::url($this->cover_image) : null,
        );
    }

    /**
     * Accessor : URL publique du CV.
     */
    protected function cvUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->cv_path ? Storage::url($this->cv_path) : null,
        );
    }
}
