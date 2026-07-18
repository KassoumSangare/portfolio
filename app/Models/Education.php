<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Education extends Model
{
    use HasFactory;
    protected $table = 'educations';

    /**
     * Les attributs assignables en masse.
     */
    protected $fillable = [
        'profile_id',
        'school',
        'degree',
        'field',
        'description',
        'start_year',
        'end_year',
        'display_order',
    ];

    /**
     * Casts des attributs.
     */
    protected function casts(): array
    {
        return [
            'start_year' => 'integer',
            'end_year' => 'integer',
        ];
    }

    /**
     * Relation : une formation appartient à un profil.
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    /**
     * Scope : trier les formations par ordre d'affichage.
     */
    public function scopeOrderedByDisplay($query)
    {
        return $query->orderBy('display_order')->orderBy('id');
    }
}
