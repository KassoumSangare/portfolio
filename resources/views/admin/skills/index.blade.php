@extends('layouts.admin')

@section('title', 'Compétences')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Compétences</li>
@endsection

@section('content')

    <div class="admin-page-header admin-page-header-flex">
        <div>
            <h1>Compétences</h1>
            <p class="text-muted">Gérez les compétences affichées sur la page publique.</p>
        </div>
        <a href="{{ route('admin.skills.create') }}" class="btn admin-btn-primary">
            <i class="bi bi-plus-lg"></i> Ajouter une compétence
        </a>
    </div>

    @forelse ($skills as $category => $categorySkills)
        <div class="admin-card mb-4">
            <h2 class="admin-card-title">{{ $category }}</h2>

            <div class="table-responsive">
                <table class="table admin-table align-middle">
                    <thead>
                        <tr>
                            <th style="width: 90px;">Ordre</th>
                            <th>Nom</th>
                            <th>Niveau</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorySkills as $skill)
                            <tr>
                                <td>
                                    <div class="admin-reorder-buttons">
                                        <form action="{{ route('admin.skills.move-up', $skill) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="btn btn-sm admin-btn-icon" title="Monter">
                                                <i class="bi bi-arrow-up"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.skills.move-down', $skill) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="btn btn-sm admin-btn-icon" title="Descendre">
                                                <i class="bi bi-arrow-down"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    @if ($skill->icon)
                                        <i class="{{ $skill->icon }}"></i>
                                    @endif
                                    {{ $skill->name }}
                                </td>
                                <td>
                                    <span class="admin-badge admin-badge-level-{{ $skill->level }}">
                                        {{ ucfirst($skill->level) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-sm admin-btn-outline">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette compétence ?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm admin-btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="admin-empty-state">
            <i class="bi bi-cpu"></i>
            <p>Aucune compétence enregistrée pour le moment.</p>
            <a href="{{ route('admin.skills.create') }}" class="btn admin-btn-primary">Ajouter la première compétence</a>
        </div>
    @endforelse

@endsection
