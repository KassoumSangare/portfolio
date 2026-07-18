<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * ATTENTION : le mot de passe défini ici est un mot de passe temporaire
     * à usage de développement uniquement. Changez-le impérativement après
     * la première connexion (ou avant toute mise en production) via
     * php artisan tinker : 
     * User::first()->update(['password' => Hash::make('nouveau_mot_de_passe')]);
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'sangarekassouminfo@gmail.com'],
            [
                'name' => 'Kassoum SANGARE',
                'email' => 'sangarekassouminfo@gmail.com',
                'password' => Hash::make('Portfolio@2026'),
                'email_verified_at' => now(),
            ]
        );
    }
}
