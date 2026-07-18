@extends('layouts.admin')

@section('title', 'Projets')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Projets</li>
@endsection

@section('content')

    <div class="admin-page-header admin-page-header-flex">
        <div>
            <h1>Projets</h1>
            <p class="text-muted">Gérez les projets affichés dans votre vitrine.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="btn admin-btn-primary">
            <i class="bi bi-plus-lg"></i> Ajouter un projet
        </a>
    </div>

    @forelse ($projects as $project)
        <div class="admin-card mb-3 admin-list-item">
            <div class="admin-reorder-buttons">
                <form action="{{ route('admin.projects.move-up', $project) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-sm admin-btn-icon" title="Monter"><i class="bi bi-arrow-up"></i></button>
                </form>
                <form action="{{ route('admin.projects.move-down', $project) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-sm admin-btn-icon" title="Descendre"><i class="bi bi-arrow-down"></i></button>
                </form>
            </div>

            <div class="admin-list-item-thumb">
                <img src="{{ $project->image_url ?? 'https://via.placeholder.com/80x80?text=%20' }}" alt="{{ $project->title }}">
            </div>

            <div class="admin-list-item-body">
                <h3>
                    {{ $project->title }}
                    @if ($project->is_featured)
                        <span class="admin-badge admin-badge-featured"><i class="bi bi-star-fill"></i> Phare</span>
                    @endif
                </h3>
                <p class="admin-list-item-meta">
                    @if ($project->client_company)
                        {{ $project->client_company }}
                    @endif
                    @if ($project->project_url)
                        · <a href="{{ $project->project_url }}" target="_blank">{{ $project->project_url }}</a>
                    @endif
                </p>
                @if ($project->tags)
                    <div class="admin-tags">
                        @foreach ($project->tags as $tag)
                            <span class="admin-tag">{{ $tag }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="admin-list-item-actions">
                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm admin-btn-outline">
                    <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Supprimer ce projet ?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm admin-btn-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="admin-empty-state">
            <i class="bi bi-kanban"></i>
            <p>Aucun projet enregistré pour le moment.</p>
            <a href="{{ route('admin.projects.create') }}" class="btn admin-btn-primary">Ajouter le premier projet</a>
        </div>
    @endforelse

@endsection
