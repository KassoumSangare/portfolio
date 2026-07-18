<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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

        return $file->store($directory, 'public');
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
