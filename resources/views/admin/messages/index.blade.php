@extends('layouts.admin')

@section('title', 'Messages')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Messages</li>
@endsection

@section('content')

    <div class="admin-page-header">
        <h1>Messages</h1>
        <p class="text-muted">Messages reçus depuis le formulaire de contact public.</p>
    </div>

    <div class="admin-card">
        @forelse ($messages as $message)
            <div class="admin-list-item mb-3 pb-3 {{ ! $loop->last ? 'border-bottom' : '' }}" style="border-color: var(--border) !important;">
                <div class="admin-list-item-body">
                    <h3>
                        {{ $message->subject }}
                        @unless ($message->is_read)
                            <span class="admin-badge admin-badge-featured">Non lu</span>
                        @endunless
                    </h3>
                    <p class="admin-list-item-meta">
                        {{ $message->name }} · {{ $message->email }} · {{ $message->created_at->format('d/m/Y à H:i') }}
                    </p>
                    <p class="text-muted mb-0">{{ Str::limit($message->message, 120) }}</p>
                </div>

                <div class="admin-list-item-actions">
                    <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-sm admin-btn-outline">
                        <i class="bi bi-eye"></i> Voir
                    </a>
                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Supprimer ce message ?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm admin-btn-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="admin-empty-state">
                <i class="bi bi-envelope"></i>
                <p>Aucun message reçu pour le moment.</p>
            </div>
        @endforelse
    </div>

    @if ($messages->hasPages())
        <div class="mt-4">
            {{ $messages->links('pagination::bootstrap-5') }}
        </div>
    @endif

@endsection