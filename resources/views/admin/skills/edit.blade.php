@extends('layouts.admin')

@section('title', 'Modifier la compétence')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.skills.index') }}">Compétences</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modifier</li>
@endsection

@section('content')

    <div class="admin-page-header">
        <h1>Modifier {{ $skill->name }}</h1>
    </div>

    <form action="{{ route('admin.skills.update', $skill) }}" method="POST" class="admin-form">
        @csrf
        @method('PUT')
        @include('admin.skills._form', ['skill' => $skill])

        <div class="admin-form-actions">
            <button type="submit" class="btn admin-btn-primary">
                <i class="bi bi-check-lg"></i> Enregistrer les modifications
            </button>
            <a href="{{ route('admin.skills.index') }}" class="btn admin-btn-outline">Annuler</a>
        </div>
    </form>

@endsection
