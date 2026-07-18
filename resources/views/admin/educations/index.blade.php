@extends('layouts.admin')

@section('title', 'Formations')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Formations</li>
@endsection

@section('content')

    <div class="admin-page-header admin-page-header-flex">
        <div>
            <h1>Formations</h1>
            <p class="text-muted">Gérez votre parcours académique.</p>
        </div>
        <a href="{{ route('admin.educations.create') }}" class="btn admin-btn-primary">
            <i class="bi bi-plus-lg"></i> Ajouter une formation
        </a>
    </div>

    @forelse ($educations as $education)
        <div class="admin-card mb-3 admin-list-item">
            <div class="admin-reorder-buttons">
                <form action="{{ route('admin.educations.move-up', $education) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-sm admin-btn-icon" title="Monter"><i class="bi bi-arrow-up"></i></button>
                </form>
                <form action="{{ route('admin.educations.move-down', $education) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-sm admin-btn-icon" title="Descendre"><i class="bi bi-arrow-down"></i></button>
                </form>
            </div>

            <div class="admin-list-item-body">
                <h3>{{ $education->degree }} <span class="text-muted">— {{ $education->school }}</span></h3>
                <p class="admin-list-item-meta">
                    {{ $education->start_year }} — {{ $education->end_year ?? 'En cours' }}
                    @if ($education->field)
                        · {{ $education->field }}
                    @endif
                </p>
                @if ($education->description)
                    <p class="text-muted mb-0">{{ Str::limit($education->description, 150) }}</p>
                @endif
            </div>

            <div class="admin-list-item-actions">
                <a href="{{ route('admin.educations.edit', $education) }}" class="btn btn-sm admin-btn-outline">
                    <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('admin.educations.destroy', $education) }}" method="POST" onsubmit="return confirm('Supprimer cette formation ?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm admin-btn-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="admin-empty-state">
            <i class="bi bi-mortarboard"></i>
            <p>Aucune formation enregistrée pour le moment.</p>
            <a href="{{ route('admin.educations.create') }}" class="btn admin-btn-primary">Ajouter la première formation</a>
        </div>
    @endforelse

@endsection
