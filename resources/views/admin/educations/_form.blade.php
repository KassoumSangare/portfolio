@php
    $education = $education ?? null;
@endphp

<div class="admin-card mb-4">
    <div class="row g-3">
        <div class="col-md-6">
            <label for="school" class="form-label">Établissement *</label>
            <input type="text" name="school" id="school" class="form-control @error('school') is-invalid @enderror" value="{{ old('school', $education->school ?? '') }}" required>
            @error('school') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label for="degree" class="form-label">Diplôme *</label>
            <input type="text" name="degree" id="degree" class="form-control @error('degree') is-invalid @enderror" value="{{ old('degree', $education->degree ?? '') }}" required>
            @error('degree') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label for="field" class="form-label">Domaine / Filière</label>
            <input type="text" name="field" id="field" class="form-control @error('field') is-invalid @enderror" value="{{ old('field', $education->field ?? '') }}">
            @error('field') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-3">
            <label for="start_year" class="form-label">Année de début *</label>
            <input type="number" name="start_year" id="start_year" class="form-control @error('start_year') is-invalid @enderror" value="{{ old('start_year', $education->start_year ?? '') }}" min="1970" max="{{ date('Y') + 1 }}" required>
            @error('start_year') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-3">
            <label for="end_year" class="form-label">Année de fin</label>
            <input type="number" name="end_year" id="end_year" class="form-control @error('end_year') is-invalid @enderror" value="{{ old('end_year', $education->end_year ?? '') }}" min="1970" max="{{ date('Y') + 1 }}">
            @error('end_year') <div class="invalid-feedback">{{ $message }}</div> @enderror
            <small class="text-muted">Laisser vide si en cours.</small>
        </div>

        <div class="col-12">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $education->description ?? '') }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>
