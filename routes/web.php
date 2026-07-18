<?php

use App\Http\Controllers\Admin\AdminEducationController;
use App\Http\Controllers\Admin\AdminExperienceController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\Admin\AdminSkillController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\PortfolioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes publiques
|--------------------------------------------------------------------------
*/

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Routes d'authentification (générées par Laravel Breeze)
|--------------------------------------------------------------------------
| Fournit notamment les routes nommées 'login' et 'logout'.
| Si ce fichier n'existe pas, c'est que Breeze n'a pas été installé :
| exécutez composer require laravel/breeze --dev && php artisan breeze:install blade
*/

if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}

/*
|--------------------------------------------------------------------------
| Routes d'administration
|--------------------------------------------------------------------------
| IMPORTANT : protégées par le middleware 'auth'. Sans authentification,
| toute tentative d'accès redirige automatiquement vers la route 'login'
| (fournie par auth.php ci-dessus).
*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Profil unique : uniquement edit/update, jamais de create/destroy
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');

    // Compétences
    Route::resource('skills', AdminSkillController::class)->except(['show']);
    Route::patch('/skills/{skill}/move-up', [AdminSkillController::class, 'moveUp'])->name('skills.move-up');
    Route::patch('/skills/{skill}/move-down', [AdminSkillController::class, 'moveDown'])->name('skills.move-down');

    // Expériences
    Route::resource('experiences', AdminExperienceController::class)->except(['show']);
    Route::patch('/experiences/{experience}/move-up', [AdminExperienceController::class, 'moveUp'])->name('experiences.move-up');
    Route::patch('/experiences/{experience}/move-down', [AdminExperienceController::class, 'moveDown'])->name('experiences.move-down');

    // Formations
    Route::resource('educations', AdminEducationController::class)->except(['show']);
    Route::patch('/educations/{education}/move-up', [AdminEducationController::class, 'moveUp'])->name('educations.move-up');
    Route::patch('/educations/{education}/move-down', [AdminEducationController::class, 'moveDown'])->name('educations.move-down');

    // Projets
    Route::resource('projects', AdminProjectController::class)->except(['show']);
    Route::patch('/projects/{project}/move-up', [AdminProjectController::class, 'moveUp'])->name('projects.move-up');
    Route::patch('/projects/{project}/move-down', [AdminProjectController::class, 'moveDown'])->name('projects.move-down');
});
