<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
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

        $skills = [
            // Backend
            ['name' => 'Laravel', 'category' => 'Backend', 'icon' => 'bi bi-server', 'level' => 'avance', 'display_order' => 1],
            ['name' => 'PHP 8', 'category' => 'Backend', 'icon' => 'bi bi-filetype-php', 'level' => 'avance', 'display_order' => 2],
            ['name' => 'MySQL', 'category' => 'Backend', 'icon' => 'bi bi-database', 'level' => 'intermediaire', 'display_order' => 3],

            // Frontend
            ['name' => 'Bootstrap 5', 'category' => 'Frontend', 'icon' => 'bi bi-bootstrap', 'level' => 'avance', 'display_order' => 1],
            ['name' => 'JavaScript Vanille', 'category' => 'Frontend', 'icon' => 'bi bi-filetype-js', 'level' => 'intermediaire', 'display_order' => 2],

            // Autres
            ['name' => 'Node.js', 'category' => 'Autres', 'icon' => 'bi bi-nodejs', 'level' => 'intermediaire', 'display_order' => 1],
            ['name' => 'Linux Ubuntu', 'category' => 'Autres', 'icon' => 'bi bi-ubuntu', 'level' => 'intermediaire', 'display_order' => 2],
            ['name' => 'Linux CentOS', 'category' => 'Autres', 'icon' => 'bi bi-terminal', 'level' => 'debutant', 'display_order' => 3],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                ['profile_id' => $profile->id, 'name' => $skill['name']],
                $skill + ['profile_id' => $profile->id]
            );
        }
    }
}
