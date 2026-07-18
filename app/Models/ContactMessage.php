<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    /**
     * Les attributs assignables en masse.
     */
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'is_read',
    ];

    /**
     * Casts des attributs.
     */
    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }
}
