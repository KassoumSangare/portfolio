<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
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

        $educations = [
            [
                'school' => "Université (Réseaux & Génie Logiciel)",
                'degree' => 'Licence Réseaux & Génie Logiciel',
                'field' => 'Réseaux & Génie Logiciel',
                'description' => 'Formation en cours, axée sur les réseaux informatiques et le développement logiciel.',
                'start_year' => 2024,
                'end_year' => null,
                'display_order' => 1,
            ],
            [
                'school' => 'PIGIER Côte d\'Ivoire',
                'degree' => 'BTS IDA',
                'field' => 'Informatique Développeur d\'Applications',
                'description' => "Brevet de Technicien Supérieur en Informatique Développeur d'Applications, obtenu à PIGIER Côte d'Ivoire.",
                'start_year' => 2022,
                'end_year' => 2024,
                'display_order' => 2,
            ],
        ];

        foreach ($educations as $education) {
            Education::updateOrCreate(
                ['profile_id' => $profile->id, 'school' => $education['school'], 'degree' => $education['degree']],
                $education + ['profile_id' => $profile->id]
            );
        }
    }
}
