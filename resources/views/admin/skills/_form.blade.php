@php
    $skill = $skill ?? null;
@endphp

<div class="admin-card mb-4">
    <div class="row g-3">
        <div class="col-md-6">
            <label for="name" class="form-label">Nom de la compétence *</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $skill->name ?? '') }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label for="category" class="form-label">Catégorie *</label>
            <input type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category', $skill->category ?? '') }}" list="categoryOptions" required>
            <datalist id="categoryOptions">
                <option value="Backend">
                <option value="Frontend">
                <option value="Autres">
            </datalist>
            @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label for="level" class="form-label">Niveau *</label>
            <select name="level" id="level" class="form-select @error('level') is-invalid @enderror" required>
                @foreach (['debutant' => 'Débutant', 'intermediaire' => 'Intermédiaire', 'avance' => 'Avancé', 'expert' => 'Expert'] as $value => $label)
                    <option value="{{ $value }}" {{ old('level', $skill->level ?? 'intermediaire') === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @error('level') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label for="icon" class="form-label">Icône (classe Bootstrap Icons)</label>
            <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" value="{{ old('icon', $skill->icon ?? '') }}" placeholder="bi bi-code-slash">
            @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
            <small class="text-muted">Optionnel — voir <a href="https://icons.getbootstrap.com/" target="_blank">icons.getbootstrap.com</a></small>
        </div>
    </div>
</div>
