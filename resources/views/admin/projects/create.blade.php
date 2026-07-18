@extends('layouts.admin')

@section('title', 'Ajouter un projet')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projets</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
@endsection

@section('content')

    <div class="admin-page-header">
        <h1>Ajouter un projet</h1>
    </div>

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        @include('admin.projects._form')

        <div class="admin-form-actions">
            <button type="submit" class="btn admin-btn-primary">
                <i class="bi bi-check-lg"></i> Ajouter le projet
            </button>
            <a href="{{ route('admin.projects.index') }}" class="btn admin-btn-outline">Annuler</a>
        </div>
    </form>

@endsection
