@extends('layouts.admin')

@section('title', 'Modifier la formation')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.educations.index') }}">Formations</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modifier</li>
@endsection

@section('content')

    <div class="admin-page-header">
        <h1>Modifier la formation</h1>
    </div>

    <form action="{{ route('admin.educations.update', $education) }}" method="POST" class="admin-form">
        @csrf
        @method('PUT')
        @include('admin.educations._form', ['education' => $education])

        <div class="admin-form-actions">
            <button type="submit" class="btn admin-btn-primary">
                <i class="bi bi-check-lg"></i> Enregistrer les modifications
            </button>
            <a href="{{ route('admin.educations.index') }}" class="btn admin-btn-outline">Annuler</a>
        </div>
    </form>

@endsection
