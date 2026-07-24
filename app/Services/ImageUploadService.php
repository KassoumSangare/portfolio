<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    /**
     * Enregistre un fichier téléversé dans storage/app/public et retourne
     * son chemin relatif (à stocker en base). Supprime l'ancien fichier
     * s'il est fourni, pour éviter d'accumuler des fichiers orphelins.
     *
     * @param  UploadedFile  $file
     * @param  string  $directory  Sous-dossier de stockage (ex: 'profiles', 'projects')
     * @param  string|null  $oldPath  Ancien chemin à supprimer, le cas échéant
     */
    public function upload(UploadedFile $file, string $directory, ?string $oldPath = null): string
    {
        if ($oldPath) {
            $this->delete($oldPath);
        }

        $filename = $this->generateFilename($file);

        return $file->storeAs($directory, $filename, 'public');
    }

    /**
     * Génère un nom de fichier lisible basé sur le nom original,
     * suffixé par un identifiant unique pour éviter les collisions.
     */
    protected function generateFilename(UploadedFile $file): string
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();

        $slug = Str::slug($originalName);

        return $slug . '_' . time() . '.' . $extension;
    }

    /**
     * Supprime un fichier du disque public s'il existe.
     */
    public function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}