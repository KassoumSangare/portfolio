<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Affiche la page publique du portfolio avec toutes les données
     * issues de la base de données.
     */
    public function index(): View
    {
        $profile = Profile::where('status', 'active')->firstOrFail();

        $skills = Skill::orderedByDisplay()->get()->groupBy('category');
        $experiences = Experience::orderedByDisplay()->get();
        $educations = Education::orderedByDisplay()->get();
        $projects = Project::orderedByDisplay()->get();

        return view('portfolio', compact(
            'profile',
            'skills',
            'experiences',
            'educations',
            'projects'
        ));
    }
}
