@extends('layouts.admin')

@section('title', 'Ajouter une formation')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.educations.index') }}">Formations</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
@endsection

@section('content')

    <div class="admin-page-header">
        <h1>Ajouter une formation</h1>
    </div>

    <form action="{{ route('admin.educations.store') }}" method="POST" class="admin-form">
        @csrf
        @include('admin.educations._form')

        <div class="admin-form-actions">
            <button type="submit" class="btn admin-btn-primary">
                <i class="bi bi-check-lg"></i> Ajouter la formation
            </button>
            <a href="{{ route('admin.educations.index') }}" class="btn admin-btn-outline">Annuler</a>
        </div>
    </form>

@endsection
