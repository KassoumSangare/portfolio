<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Models\Experience;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminExperienceController extends Controller
{
    /**
     * Affiche la liste des expériences triées par ordre d'affichage.
     */
    public function index(): View
    {
        $experiences = Experience::orderedByDisplay()->get();

        return view('admin.experiences.index', compact('experiences'));
    }

    /**
     * Affiche le formulaire de création d'une expérience.
     */
    public function create(): View
    {
        return view('admin.experiences.create');
    }

    /**
     * Enregistre une nouvelle expérience, rattachée au profil unique.
     */
    public function store(StoreExperienceRequest $request): RedirectResponse
    {
        $profile = Profile::firstOrFail();

        $data = $request->validated();
        $data['profile_id'] = $profile->id;
        $data['display_order'] = $data['display_order'] ?? (Experience::max('display_order') + 1);

        Experience::create($data);

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Expérience ajoutée avec succès.');
    }

    /**
     * Affiche le formulaire d'édition d'une expérience.
     */
    public function edit(Experience $experience): View
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    /**
     * Met à jour une expérience existante.
     */
    public function update(UpdateExperienceRequest $request, Experience $experience): RedirectResponse
    {
        $experience->update($request->validated());

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Expérience mise à jour avec succès.');
    }

    /**
     * Supprime une expérience.
     */
    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Expérience supprimée avec succès.');
    }

    /**
     * Déplace une expérience vers le haut.
     */
    public function moveUp(Experience $experience): RedirectResponse
    {
        $previous = Experience::where('display_order', '<', $experience->display_order)
            ->orderByDesc('display_order')
            ->first();

        $this->swapOrder($experience, $previous);

        return redirect()->route('admin.experiences.index');
    }

    /**
     * Déplace une expérience vers le bas.
     */
    public function moveDown(Experience $experience): RedirectResponse
    {
        $next = Experience::where('display_order', '>', $experience->display_order)
            ->orderBy('display_order')
            ->first();

        $this->swapOrder($experience, $next);

        return redirect()->route('admin.experiences.index');
    }

    /**
     * Échange l'ordre d'affichage entre deux expériences.
     */
    protected function swapOrder(Experience $experience, ?Experience $sibling): void
    {
        if (! $sibling) {
            return;
        }

        [$orderA, $orderB] = [$experience->display_order, $sibling->display_order];

        $experience->update(['display_order' => $orderB]);
        $sibling->update(['display_order' => $orderA]);
    }
}
