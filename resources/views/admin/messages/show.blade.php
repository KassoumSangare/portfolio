@extends('layouts.admin')

@section('title', 'Message de ' . $message->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.messages.index') }}">Messages</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $message->subject }}</li>
@endsection

@section('content')

    <div class="admin-page-header">
        <h1> Email {{ $message->id }}</h1>
    </div>

    <div class="admin-card">
        <h2 class="admin-card-title"><i class="bi bi-envelope-open"></i> {{ $message->subject }}</h2>

        <p class="admin-list-item-meta mb-3">
            De <strong>{{ $message->name }}</strong> &lt;{{ $message->email }}&gt;
            · reçu le {{ $message->created_at->format('d/m/Y à H:i') }}
        </p>

        <div class="p-3 mb-3" style="background: var(--surface-2); border-radius: var(--radius-sm); white-space: pre-wrap;">{{ $message->message }}</div>

        <div class="admin-form-actions">
            <a href="mailto:{{ $message->email }}?subject=RE: {{ $message->subject }}" class="btn admin-btn-primary">
                <i class="bi bi-reply"></i> Répondre par email
            </a>
            <a href="{{ route('admin.messages.index') }}" class="btn admin-btn-outline">
                <i class="bi bi-arrow-left"></i> Retour à la liste
            </a>
            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="ms-auto" onsubmit="return confirm('Supprimer ce message ?');">
                @csrf @method('DELETE')
                <button type="submit" class="btn admin-btn-danger">
                    <i class="bi bi-trash"></i> Supprimer
                </button>
            </form>
        </div>
    </div>

@endsection