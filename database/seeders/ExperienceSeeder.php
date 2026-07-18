<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profile = Profile::first();

        if (! $profile) {
            return;
        }

        $experiences = [
            [
                'company' => 'SIGMA Performances',
                'position' => 'Développeur Web',
                'description' => "Développement et maintenance d'applications web pour divers clients (plateformes vitrines, portails métiers, applications de gestion) en utilisant Laravel, PHP 8, Bootstrap 5 et JavaScript.",
                'location' => 'Abidjan, Côte d\'Ivoire',
                'start_date' => '2024-01-01',
                'end_date' => null,
                'is_current' => true,
                'display_order' => 1,
            ],
            [
                'company' => 'SOTRA',
                'position' => 'Stagiaire',
                'description' => "Stage en environnement informatique d'entreprise, découverte des processus de développement et de maintenance des systèmes internes.",
                'location' => 'Abidjan, Côte d\'Ivoire',
                'start_date' => '2023-01-01',
                'end_date' => '2023-06-30',
                'is_current' => false,
                'display_order' => 2,
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::updateOrCreate(
                ['profile_id' => $profile->id, 'company' => $experience['company'], 'position' => $experience['position']],
                $experience + ['profile_id' => $profile->id]
            );
        }
    }
}
