@extends('layouts.admin')

@section('title', 'Profil')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Profil</li>
@endsection

@section('content')

    <div class="admin-page-header">
        <h1>Profil</h1>
        <p class="text-muted">Ces informations alimentent l'ensemble de la page publique.</p>
    </div>

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')

        <div class="admin-card mb-4">
            <h2 class="admin-card-title"><i class="bi bi-images"></i> Visuels</h2>

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">Photo de profil</label>
                    <div class="admin-upload-preview mb-2">
                        <img id="photoPreview"
                             src="{{ $profile->photo_url ?? 'https://via.placeholder.com/150x150?text=Photo' }}"
                             alt="Photo de profil">
                    </div>
                    <input type="file" name="photo" id="photoInput" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                    @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted">JPG, PNG ou WEBP — 2 Mo maximum.</small>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Image de couverture</label>
                    <div class="admin-upload-preview admin-upload-preview-wide mb-2">
                        <img id="coverPreview"
                             src="{{ $profile->cover_image_url ?? 'https://via.placeholder.com/400x150?text=Couverture' }}"
                             alt="Image de couverture">
                    </div>
                    <input type="file" name="cover_image" id="coverInput" class="form-control @error('cover_image') is-invalid @enderror" accept="image/*">
                    @error('cover_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted">JPG, PNG ou WEBP — 2 Mo maximum.</small>
                </div>
            </div>
        </div>

        <div class="admin-card mb-4">
            <h2 class="admin-card-title"><i class="bi bi-person-vcard"></i> Identité</h2>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="first_name" class="form-label">Prénom *</label>
                    <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $profile->first_name) }}" required>
                    @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label for="last_name" class="form-label">Nom *</label>
                    <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $profile->last_name) }}" required>
                    @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label for="title" class="form-label">Titre professionnel *</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $profile->title) }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label for="about" class="form-label">Présentation</label>
                    <textarea name="about" id="about" rows="5" class="form-control @error('about') is-invalid @enderror">{{ old('about', $profile->about) }}</textarea>
                    @error('about') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="admin-card mb-4">
            <h2 class="admin-card-title"><i class="bi bi-briefcase"></i> Situation actuelle</h2>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="current_position" class="form-label">Poste actuel</label>
                    <input type="text" name="current_position" id="current_position" class="form-control @error('current_position') is-invalid @enderror" value="{{ old('current_position', $profile->current_position) }}">
                    @error('current_position') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label for="current_company" class="form-label">Entreprise actuelle</label>
                    <input type="text" name="current_company" id="current_company" class="form-control @error('current_company') is-invalid @enderror" value="{{ old('current_company', $profile->current_company) }}">
                    @error('current_company') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label for="years_experience" class="form-label">Années d'expérience</label>
                    <input type="number" min="0" max="60" name="years_experience" id="years_experience" class="form-control @error('years_experience') is-invalid @enderror" value="{{ old('years_experience', $profile->years_experience) }}">
                    @error('years_experience') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label for="status" class="form-label">Statut *</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="active" {{ old('status', $profile->status) === 'active' ? 'selected' : '' }}>Actif</option>
                        <option value="inactive" {{ old('status', $profile->status) === 'inactive' ? 'selected' : '' }}>Inactif</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="admin-card mb-4">
            <h2 class="admin-card-title"><i class="bi bi-envelope"></i> Coordonnées</h2>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $profile->email) }}">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $profile->phone) }}">
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label for="address" class="form-label">Adresse / Commune</label>
                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $profile->address) }}">
                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label for="city" class="form-label">Ville</label>
                    <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $profile->city) }}">
                    @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label for="country" class="form-label">Pays</label>
                    <input type="text" name="country" id="country" class="form-control @error('country') is-invalid @enderror" value="{{ old('country', $profile->country) }}">
                    @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="admin-card mb-4">
            <h2 class="admin-card-title"><i class="bi bi-link-45deg"></i> Liens & CV</h2>

            <div class="row g-3">
                <div class="col-md-4">
                    <label for="linkedin_url" class="form-label">LinkedIn</label>
                    <input type="url" name="linkedin_url" id="linkedin_url" class="form-control @error('linkedin_url') is-invalid @enderror" value="{{ old('linkedin_url', $profile->linkedin_url) }}" placeholder="https://linkedin.com/in/...">
                    @error('linkedin_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label for="github_url" class="form-label">GitHub</label>
                    <input type="url" name="github_url" id="github_url" class="form-control @error('github_url') is-invalid @enderror" value="{{ old('github_url', $profile->github_url) }}" placeholder="https://github.com/...">
                    @error('github_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label for="website_url" class="form-label">Site web</label>
                    <input type="url" name="website_url" id="website_url" class="form-control @error('website_url') is-invalid @enderror" value="{{ old('website_url', $profile->website_url) }}" placeholder="https://...">
                    @error('website_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label for="cv" class="form-label">CV (PDF)</label>
                    <input type="file" name="cv" id="cv" class="form-control @error('cv') is-invalid @enderror" accept="application/pdf">
                    @error('cv') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @if ($profile->cv_url)
                        <small class="text-muted d-block mt-1">
                            CV actuel : <a href="{{ $profile->cv_url }}" target="_blank">voir le fichier <i class="bi bi-box-arrow-up-right"></i></a>
                        </small>
                    @endif
                </div>
            </div>
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="btn admin-btn-primary">
                <i class="bi bi-check-lg"></i> Enregistrer les modifications
            </button>
        </div>
    </form>

@endsection

@push('scripts')
<script>
    // Prévisualisation immédiate des images sélectionnées (photo & couverture)
    document.getElementById('photoInput')?.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            document.getElementById('photoPreview').src = URL.createObjectURL(file);
        }
    });

    document.getElementById('coverInput')?.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            document.getElementById('coverPreview').src = URL.createObjectURL(file);
        }
    });
</script>
@endpush
