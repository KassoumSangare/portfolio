@extends('layouts.admin')

@section('title', 'Modifier le projet')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projets</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modifier</li>
@endsection

@section('content')

    <div class="admin-page-header">
        <h1>Modifier  {{ $project->title }}</h1>
    </div>

    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')
        @include('admin.projects._form', ['project' => $project])

        <div class="admin-form-actions">
            <button type="submit" class="btn admin-btn-primary">
                <i class="bi bi-check-lg"></i> Enregistrer les modifications
            </button>
            <a href="{{ route('admin.projects.index') }}" class="btn admin-btn-outline">Annuler</a>
        </div>
    </form>

@endsection
