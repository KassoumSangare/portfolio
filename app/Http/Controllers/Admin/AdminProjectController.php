<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminProjectController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageUploadService
    ) {
    }

    /**
     * Affiche la liste des projets triés par ordre d'affichage.
     */
    public function index(): View
    {
        $projects = Project::orderedByDisplay()->get();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Affiche le formulaire de création d'un projet.
     */
    public function create(): View
    {
        return view('admin.projects.create');
    }

    /**
     * Enregistre un nouveau projet avec son image.
     */
    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['display_order'] = $data['display_order'] ?? (Project::max('display_order') + 1);

        $data['image_path'] = $this->imageUploadService->upload(
            $request->file('image'),
            'projects'
        );

        Project::create($data);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Projet ajouté avec succès.');
    }

    /**
     * Affiche le formulaire d'édition d'un projet.
     */
    public function edit(Project $project): View
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Met à jour un projet existant, avec remplacement d'image optionnel.
     */
    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->imageUploadService->upload(
                $request->file('image'),
                'projects',
                $project->image_path
            );
        }

        $project->update($data);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Projet mis à jour avec succès.');
    }

    /**
     * Supprime un projet ainsi que son image associée.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $this->imageUploadService->delete($project->image_path);
        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Projet supprimé avec succès.');
    }

    /**
     * Déplace un projet vers le haut.
     */
    public function moveUp(Project $project): RedirectResponse
    {
        $previous = Project::where('display_order', '<', $project->display_order)
            ->orderByDesc('display_order')
            ->first();

        $this->swapOrder($project, $previous);

        return redirect()->route('admin.projects.index');
    }

    /**
     * Déplace un projet vers le bas.
     */
    public function moveDown(Project $project): RedirectResponse
    {
        $next = Project::where('display_order', '>', $project->display_order)
            ->orderBy('display_order')
            ->first();

        $this->swapOrder($project, $next);

        return redirect()->route('admin.projects.index');
    }

    /**
     * Échange l'ordre d'affichage entre deux projets.
     */
    protected function swapOrder(Project $project, ?Project $sibling): void
    {
        if (! $sibling) {
            return;
        }

        [$orderA, $orderB] = [$project->display_order, $sibling->display_order];

        $project->update(['display_order' => $orderB]);
        $sibling->update(['display_order' => $orderA]);
    }
}
