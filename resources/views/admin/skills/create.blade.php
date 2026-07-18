@extends('layouts.admin')

@section('title', 'Ajouter une compétence')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.skills.index') }}">Compétences</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
@endsection

@section('content')

    <div class="admin-page-header">
        <h1>Ajouter une compétence</h1>
    </div>

    <form action="{{ route('admin.skills.store') }}" method="POST" class="admin-form">
        @csrf
        @include('admin.skills._form')

        <div class="admin-form-actions">
            <button type="submit" class="btn admin-btn-primary">
                <i class="bi bi-check-lg"></i> Ajouter la compétence
            </button>
            <a href="{{ route('admin.skills.index') }}" class="btn admin-btn-outline">Annuler</a>
        </div>
    </form>

@endsection
