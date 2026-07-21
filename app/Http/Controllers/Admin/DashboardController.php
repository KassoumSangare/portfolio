<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord administrateur avec un résumé du contenu.
     */
    public function index(): View
    {
        $stats = [
            'profile' => Profile::first(),
            'skills_count' => Skill::count(),
            'experiences_count' => Experience::count(),
            'educations_count' => Education::count(),
            'projects_count' => Project::count(),
            'featured_projects_count' => Project::featured()->count(),
            'messages_count' => ContactMessage::count(),
            'unread_messages_count' => ContactMessage::where('is_read', false)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}