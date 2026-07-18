<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Auto-École Le Chemin',
                'description' => "Plateforme digitale complète d'apprentissage du code de la route.",
                'client_company' => 'SIGMA Performances / TicAfrique',
                'tags' => ['Laravel', 'Bootstrap 5', 'JavaScript', 'MySQL'],
                'project_url' => 'https://autoecolelechemin.com',
                'image_path' => null,
                'is_featured' => true,
                'display_order' => 1,
            ],
            [
                'title' => 'SCI SAGES',
                'description' => 'Site vitrine et catalogue immobilier.',
                'client_company' => 'SIGMA Performances / TicAfrique',
                'tags' => ['Laravel', 'Bootstrap 5', 'JavaScript', 'MySQL'],
                'project_url' => 'https://scisages.ci',
                'image_path' => null,
                'is_featured' => true,
                'display_order' => 2,
            ],
            [
                'title' => 'SchoolFoot',
                'description' => "Plateforme de préinscription et de gestion d'une émission de détection de talents.",
                'client_company' => 'SIGMA Performances / TicAfrique',
                'tags' => ['Laravel', 'Bootstrap 5', 'JavaScript', 'MySQL'],
                'project_url' => 'https://schoolfoot.ci',
                'image_path' => null,
                'is_featured' => true,
                'display_order' => 3,
            ],
            [
                'title' => 'FOANI & SERVICES',
                'description' => "Portail agro-industriel regroupant élevage, abattoir moderne et boutique en ligne.",
                'client_company' => 'SIGMA Performances / TicAfrique',
                'tags' => ['Laravel', 'Bootstrap 5', 'JavaScript', 'MySQL'],
                'project_url' => 'https://foani.ci/',
                'image_path' => null,
                'is_featured' => true,
                'display_order' => 4,
            ],
            [
                'title' => 'Portail TicAfrique',
                'description' => "Site vitrine de l'agence technologique.",
                'client_company' => 'SIGMA Performances / TicAfrique',
                'tags' => ['Laravel', 'Bootstrap 5', 'JavaScript', 'MySQL'],
                'project_url' => 'https://ticafrique.ci',
                'image_path' => null,
                'is_featured' => true,
                'display_order' => 5,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['title' => $project['title']],
                $project
            );
        }
    }
}
