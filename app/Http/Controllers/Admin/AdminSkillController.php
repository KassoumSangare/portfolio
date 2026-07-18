<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Models\Profile;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminSkillController extends Controller
{
    /**
     * Affiche la liste des compétences, triées par catégorie puis par ordre d'affichage.
     */
    public function index(): View
    {
        $skills = Skill::orderedByDisplay()->get()->groupBy('category');

        return view('admin.skills.index', compact('skills'));
    }

    /**
     * Affiche le formulaire de création d'une compétence.
     */
    public function create(): View
    {
        return view('admin.skills.create');
    }

    /**
     * Enregistre une nouvelle compétence, rattachée au profil unique.
     */
    public function store(StoreSkillRequest $request): RedirectResponse
    {
        $profile = Profile::firstOrFail();

        $data = $request->validated();
        $data['profile_id'] = $profile->id;
        $data['display_order'] = $data['display_order'] ?? (Skill::max('display_order') + 1);

        Skill::create($data);

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Compétence ajoutée avec succès.');
    }

    /**
     * Affiche le formulaire d'édition d'une compétence.
     */
    public function edit(Skill $skill): View
    {
        return view('admin.skills.edit', compact('skill'));
    }

    /**
     * Met à jour une compétence existante.
     */
    public function update(UpdateSkillRequest $request, Skill $skill): RedirectResponse
    {
        $skill->update($request->validated());

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Compétence mise à jour avec succès.');
    }

    /**
     * Supprime une compétence.
     */
    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Compétence supprimée avec succès.');
    }

    /**
     * Déplace une compétence vers le haut (dans sa catégorie).
     */
    public function moveUp(Skill $skill): RedirectResponse
    {
        $previous = Skill::where('category', $skill->category)
            ->where('display_order', '<', $skill->display_order)
            ->orderByDesc('display_order')
            ->first();

        $this->swapOrder($skill, $previous);

        return redirect()->route('admin.skills.index');
    }

    /**
     * Déplace une compétence vers le bas (dans sa catégorie).
     */
    public function moveDown(Skill $skill): RedirectResponse
    {
        $next = Skill::where('category', $skill->category)
            ->where('display_order', '>', $skill->display_order)
            ->orderBy('display_order')
            ->first();

        $this->swapOrder($skill, $next);

        return redirect()->route('admin.skills.index');
    }

    /**
     * Échange l'ordre d'affichage entre deux compétences.
     */
    protected function swapOrder(Skill $skill, ?Skill $sibling): void
    {
        if (! $sibling) {
            return;
        }

        [$orderA, $orderB] = [$skill->display_order, $sibling->display_order];

        $skill->update(['display_order' => $orderB]);
        $sibling->update(['display_order' => $orderA]);
    }
}
