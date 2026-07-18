<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model
{
    use HasFactory;

    /**
     * Les niveaux de compétence disponibles (échelle textuelle).
     */
    public const LEVELS = ['debutant', 'intermediaire', 'avance', 'expert'];

    /**
     * Les attributs assignables en masse.
     */
    protected $fillable = [
        'profile_id',
        'name',
        'category',
        'icon',
        'level',
        'display_order',
    ];

    /**
     * Relation : une compétence appartient à un profil.
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    /**
     * Scope : trier les compétences par ordre d'affichage.
     */
    public function scopeOrderedByDisplay($query)
    {
        return $query->orderBy('display_order')->orderBy('id');
    }
}
