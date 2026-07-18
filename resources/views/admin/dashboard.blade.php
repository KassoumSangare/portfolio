@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Tableau de bord</li>
@endsection

@section('content')

    <div class="admin-page-header">
        <h1>Tableau de bord</h1>
        <p class="text-muted">Vue d'ensemble du contenu de votre portfolio.</p>
    </div>

    @if ($stats['profile'])
        <div class="admin-welcome-card">
            <div class="admin-welcome-avatar">
                @if ($stats['profile']->photo_url)
                    <img src="{{ $stats['profile']->photo_url }}" alt="{{ $stats['profile']->full_name }}">
                @else
                    <i class="bi bi-person-fill"></i>
                @endif
            </div>
            <div>
                <h2>{{ $stats['profile']->full_name }}</h2>
                <p class="text-muted mb-0">{{ $stats['profile']->title }}</p>
            </div>
            <a href="{{ route('admin.profile.edit') }}" class="btn admin-btn-outline ms-auto">
                <i class="bi bi-pencil"></i> Modifier le profil
            </a>
        </div>
    @else
        <div class="alert admin-alert-error">
            Aucun profil n'a été trouvé. Vérifiez que le seeder <code>ProfileSeeder</code> a bien été exécuté.
        </div>
    @endif

    <div class="admin-stats-grid">
        <a href="{{ route('admin.skills.index') }}" class="admin-stat-card">
            <i class="bi bi-cpu"></i>
            <div>
                <span class="admin-stat-value">{{ $stats['skills_count'] }}</span>
                <span class="admin-stat-label">Compétences</span>
            </div>
        </a>

        <a href="{{ route('admin.experiences.index') }}" class="admin-stat-card">
            <i class="bi bi-briefcase"></i>
            <div>
                <span class="admin-stat-value">{{ $stats['experiences_count'] }}</span>
                <span class="admin-stat-label">Expériences</span>
            </div>
        </a>

        <a href="{{ route('admin.educations.index') }}" class="admin-stat-card">
            <i class="bi bi-mortarboard"></i>
            <div>
                <span class="admin-stat-value">{{ $stats['educations_count'] }}</span>
                <span class="admin-stat-label">Formations</span>
            </div>
        </a>

        <a href="{{ route('admin.projects.index') }}" class="admin-stat-card">
            <i class="bi bi-kanban"></i>
            <div>
                <span class="admin-stat-value">{{ $stats['projects_count'] }}</span>
                <span class="admin-stat-label">Projets ({{ $stats['featured_projects_count'] }} phares)</span>
            </div>
        </a>
    </div>

@endsection
