<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    /**
     * Les attributs assignables en masse.
     */
    protected $fillable = [
        'title',
        'description',
        'client_company',
        'tags',
        'project_url',
        'image_path',
        'is_featured',
        'display_order',
    ];

    /**
     * Casts des attributs.
     */
    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'is_featured' => 'boolean',
        ];
    }

    /**
     * Accessor : URL publique de l'image du projet.
     */
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image_path ? Storage::url($this->image_path) : null,
        );
    }

    /**
     * Scope : ne retourner que les projets phares.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope : trier les projets par ordre d'affichage.
     */
    public function scopeOrderedByDisplay($query)
    {
        return $query->orderBy('display_order')->orderBy('id');
    }
}
