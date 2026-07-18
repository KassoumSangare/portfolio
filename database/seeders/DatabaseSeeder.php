<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Ordre important : AdminUser et Profile en premier (Skills/Experiences/
     * Educations dépendent du profile_id), Project est indépendant.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            ProfileSeeder::class,
            SkillSeeder::class,
            ExperienceSeeder::class,
            EducationSeeder::class,
            ProjectSeeder::class,
        ]);
    }
}
