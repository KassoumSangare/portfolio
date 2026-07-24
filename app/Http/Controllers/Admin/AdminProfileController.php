<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminProfileController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageUploadService
    ) {
    }

    /**
     * Affiche le formulaire d'édition du profil unique.
     *
     * Le portfolio ne possède qu'un seul profil : on récupère toujours
     * le premier enregistrement, jamais de création possible.
     */
    public function edit(): View
    {
        $profile = Profile::firstOrFail();

        return view('admin.profile.edit', compact('profile'));
    }

    /**
     * Met à jour le profil unique.
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $profile = Profile::firstOrFail();

        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->imageUploadService->upload(
                $request->file('photo'),
                'profiles',
                $profile->photo
            );
        }

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $this->imageUploadService->upload(
                $request->file('cover_image'),
                'profiles',
                $profile->cover_image
            );
        }

        if ($request->hasFile('cv')) {
            $data['cv_path'] = $this->imageUploadService->upload(
                $request->file('cv'),
                'cv',
                $profile->cv_path
            );
        }

        $profile->update($data);

        return redirect()
            ->route('admin.profile.edit')
            ->with('success', 'Profil mis à jour avec succès.');
    }
}

