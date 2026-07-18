<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Experience extends Model
{
    use HasFactory;

    /**
     * Les attributs assignables en masse.
     */
    protected $fillable = [
        'profile_id',
        'company',
        'position',
        'description',
        'location',
        'start_date',
        'end_date',
        'is_current',
        'display_order',
    ];

    /**
     * Casts des attributs.
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_current' => 'boolean',
        ];
    }

    /**
     * Relation : une expérience appartient à un profil.
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    /**
     * Scope : trier les expériences par ordre d'affichage.
     */
    public function scopeOrderedByDisplay($query)
    {
        return $query->orderBy('display_order')->orderBy('id');
    }
}
