@extends('layouts.admin')

@section('title', 'Expériences')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Expériences</li>
@endsection

@section('content')

    <div class="admin-page-header admin-page-header-flex">
        <div>
            <h1>Expériences</h1>
            <p class="text-muted">Gérez votre parcours professionnel.</p>
        </div>
        <a href="{{ route('admin.experiences.create') }}" class="btn admin-btn-primary">
            <i class="bi bi-plus-lg"></i> Ajouter une expérience
        </a>
    </div>

    @forelse ($experiences as $experience)
        <div class="admin-card mb-3 admin-list-item">
            <div class="admin-reorder-buttons">
                <form action="{{ route('admin.experiences.move-up', $experience) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-sm admin-btn-icon" title="Monter"><i class="bi bi-arrow-up"></i></button>
                </form>
                <form action="{{ route('admin.experiences.move-down', $experience) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-sm admin-btn-icon" title="Descendre"><i class="bi bi-arrow-down"></i></button>
                </form>
            </div>

            <div class="admin-list-item-body">
                <h3>{{ $experience->position }} <span class="text-muted">— {{ $experience->company }}</span></h3>
                <p class="admin-list-item-meta">
                    {{ $experience->start_date->format('m/Y') }}
                    —
                    {{ $experience->is_current ? 'Aujourd\'hui' : $experience->end_date?->format('m/Y') }}
                    @if ($experience->location)
                        · {{ $experience->location }}
                    @endif
                </p>
                @if ($experience->description)
                    <p class="text-muted mb-0">{{ Str::limit($experience->description, 150) }}</p>
                @endif
            </div>

            <div class="admin-list-item-actions">
                <a href="{{ route('admin.experiences.edit', $experience) }}" class="btn btn-sm admin-btn-outline">
                    <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('admin.experiences.destroy', $experience) }}" method="POST" onsubmit="return confirm('Supprimer cette expérience ?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm admin-btn-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="admin-empty-state">
            <i class="bi bi-briefcase"></i>
            <p>Aucune expérience enregistrée pour le moment.</p>
            <a href="{{ route('admin.experiences.create') }}" class="btn admin-btn-primary">Ajouter la première expérience</a>
        </div>
    @endforelse

@endsection
