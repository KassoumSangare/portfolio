<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminContactMessageController extends Controller
{
    /**
     * Affiche la liste des messages reçus, les plus récents en premier.
     */
    public function index(): View
    {
        $messages = ContactMessage::orderByDesc('created_at')->paginate(15);

        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Affiche le détail d'un message et le marque automatiquement comme lu.
     */
    public function show(ContactMessage $message): View
    {
        if (! $message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Supprime un message de contact.
     */
    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('success', 'Message supprimé avec succès.');
    }
}