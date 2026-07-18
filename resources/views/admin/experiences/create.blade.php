@extends('layouts.admin')

@section('title', 'Ajouter une expérience')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.experiences.index') }}">Expériences</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
@endsection

@section('content')

    <div class="admin-page-header">
        <h1>Ajouter une expérience</h1>
    </div>

    <form action="{{ route('admin.experiences.store') }}" method="POST" class="admin-form">
        @csrf
        @include('admin.experiences._form')

        <div class="admin-form-actions">
            <button type="submit" class="btn admin-btn-primary">
                <i class="bi bi-check-lg"></i> Ajouter l'expérience
            </button>
            <a href="{{ route('admin.experiences.index') }}" class="btn admin-btn-outline">Annuler</a>
        </div>
    </form>

@endsection
