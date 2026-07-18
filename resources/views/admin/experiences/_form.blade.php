@php
    $experience = $experience ?? null;
@endphp

<div class="admin-card mb-4">
    <div class="row g-3">
        <div class="col-md-6">
            <label for="company" class="form-label">Entreprise *</label>
            <input type="text" name="company" id="company" class="form-control @error('company') is-invalid @enderror" value="{{ old('company', $experience->company ?? '') }}" required>
            @error('company') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label for="position" class="form-label">Poste *</label>
            <input type="text" name="position" id="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', $experience->position ?? '') }}" required>
            @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label for="location" class="form-label">Lieu</label>
            <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $experience->location ?? '') }}">
            @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-3">
            <label for="start_date" class="form-label">Date de début *</label>
            <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $experience->start_date?->format('Y-m-d')) }}" required>
            @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-3">
            <label for="end_date" class="form-label">Date de fin</label>
            <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $experience->end_date?->format('Y-m-d')) }}" {{ old('is_current', $experience->is_current ?? false) ? 'disabled' : '' }}>
            @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_current" id="is_current" value="1" {{ old('is_current', $experience->is_current ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_current">
                    Il s'agit de mon poste actuel
                </label>
            </div>
        </div>

        <div class="col-12">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $experience->description ?? '') }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Désactive/vide le champ date de fin si "poste actuel" est coché
    const isCurrentCheckbox = document.getElementById('is_current');
    const endDateInput = document.getElementById('end_date');

    isCurrentCheckbox?.addEventListener('change', function () {
        endDateInput.disabled = this.checked;
        if (this.checked) {
            endDateInput.value = '';
        }
    });
</script>
@endpush
