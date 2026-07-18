<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEducationRequest;
use App\Http\Requests\UpdateEducationRequest;
use App\Models\Education;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminEducationController extends Controller
{
    /**
     * Affiche la liste des formations triées par ordre d'affichage.
     */
    public function index(): View
    {
        $educations = Education::orderedByDisplay()->get();

        return view('admin.educations.index', compact('educations'));
    }

    /**
     * Affiche le formulaire de création d'une formation.
     */
    public function create(): View
    {
        return view('admin.educations.create');
    }

    /**
     * Enregistre une nouvelle formation, rattachée au profil unique.
     */
    public function store(StoreEducationRequest $request): RedirectResponse
    {
        $profile = Profile::firstOrFail();

        $data = $request->validated();
        $data['profile_id'] = $profile->id;
        $data['display_order'] = $data['display_order'] ?? (Education::max('display_order') + 1);

        Education::create($data);

        return redirect()
            ->route('admin.educations.index')
            ->with('success', 'Formation ajoutée avec succès.');
    }

    /**
     * Affiche le formulaire d'édition d'une formation.
     */
    public function edit(Education $education): View
    {
        return view('admin.educations.edit', compact('education'));
    }

    /**
     * Met à jour une formation existante.
     */
    public function update(UpdateEducationRequest $request, Education $education): RedirectResponse
    {
        $education->update($request->validated());

        return redirect()
            ->route('admin.educations.index')
            ->with('success', 'Formation mise à jour avec succès.');
    }

    /**
     * Supprime une formation.
     */
    public function destroy(Education $education): RedirectResponse
    {
        $education->delete();

        return redirect()
            ->route('admin.educations.index')
            ->with('success', 'Formation supprimée avec succès.');
    }

    /**
     * Déplace une formation vers le haut.
     */
    public function moveUp(Education $education): RedirectResponse
    {
        $previous = Education::where('display_order', '<', $education->display_order)
            ->orderByDesc('display_order')
            ->first();

        $this->swapOrder($education, $previous);

        return redirect()->route('admin.educations.index');
    }

    /**
     * Déplace une formation vers le bas.
     */
    public function moveDown(Education $education): RedirectResponse
    {
        $next = Education::where('display_order', '>', $education->display_order)
            ->orderBy('display_order')
            ->first();

        $this->swapOrder($education, $next);

        return redirect()->route('admin.educations.index');
    }

    /**
     * Échange l'ordre d'affichage entre deux formations.
     */
    protected function swapOrder(Education $education, ?Education $sibling): void
    {
        if (! $sibling) {
            return;
        }

        [$orderA, $orderB] = [$education->display_order, $sibling->display_order];

        $education->update(['display_order' => $orderB]);
        $sibling->update(['display_order' => $orderA]);
    }
}
