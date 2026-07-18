<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\ContactRequest;
use App\Mail\NewContactMessage;
use App\Models\ContactMessage;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Enregistre un message de contact en base et envoie une notification
     * par email à l'administrateur du portfolio.
     *
     * Retourne du JSON car le formulaire est soumis en AJAX (fetch),
     * sans rechargement de page, avec affichage des erreurs côté client.
     */
    public function store(ContactRequest $request): JsonResponse
    {
        $contactMessage = ContactMessage::create($request->validated());

        $profile = Profile::first();
        $recipient = $profile?->email ?? config('mail.from.address');

        if ($recipient) {
            try {
                Mail::to($recipient)->send(new NewContactMessage($contactMessage));
            } catch (\Throwable $e) {
                // L'échec de l'envoi d'email ne doit pas empêcher la confirmation
                // au visiteur : le message est déjà stocké en base et reste
                // consultable depuis l'administration.
                report($e);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Votre message a bien été envoyé. Merci de m\'avoir contacté !',
        ]);
    }
}
