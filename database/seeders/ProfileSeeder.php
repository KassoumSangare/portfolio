<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Le portfolio ne possède qu'un seul profil : on utilise updateOrCreate
     * avec un critère fixe (id: 1) pour garantir qu'il n'existe jamais
     * plusieurs enregistrements, même si le seeder est relancé.
     */
    public function run(): void
    {
        Profile::updateOrCreate(
            ['id' => 1],
            [
                'first_name' => 'Kassoum',
                'last_name' => 'SANGARE',
                'title' => 'Développeur Informatique Fullstack Junior',
                'photo' => null,
                'cover_image' => null,
                'email' => 'sangarekassouminfo@gmail.com',
                'phone' => null,
                'address' => 'Angré Château',
                'city' => 'Abidjan',
                'country' => "Côte d'Ivoire",
                'about' => "Développeur Fullstack Junior basé à Abidjan, passionné par la conception d'applications web modernes, performantes et maintenables. Formé aux technologies Laravel, PHP 8 et JavaScript, j'interviens sur l'ensemble du cycle de développement, du backend à l'interface utilisateur.",
                'cv_path' => null,
                'linkedin_url' => null,
                'github_url' => null,
                'website_url' => null,
                'years_experience' => 1,
                'current_position' => 'Développeur Web',
                'current_company' => 'SIGMA Performances',
                'status' => 'active',
            ]
        );
    }
}
