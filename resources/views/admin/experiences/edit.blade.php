@extends('layouts.admin')

@section('title', 'Modifier l\'expérience')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.experiences.index') }}">Expériences</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modifier</li>
@endsection

@section('content')

    <div class="admin-page-header">
        <h1>Modifier l'expérience</h1>
    </div>

    <form action="{{ route('admin.experiences.update', $experience) }}" method="POST" class="admin-form">
        @csrf
        @method('PUT')
        @include('admin.experiences._form', ['experience' => $experience])

        <div class="admin-form-actions">
            <button type="submit" class="btn admin-btn-primary">
                <i class="bi bi-check-lg"></i> Enregistrer les modifications
            </button>
            <a href="{{ route('admin.experiences.index') }}" class="btn admin-btn-outline">Annuler</a>
        </div>
    </form>

@endsection
