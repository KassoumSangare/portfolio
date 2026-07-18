@php
    $project = $project ?? null;
    $tagsString = old('tags_string', $project && $project->tags ? implode(', ', $project->tags) : '');
@endphp

<div class="admin-card mb-4">
    <div class="row g-3">
        <div class="col-md-8">
            <label for="title" class="form-label">Titre du projet *</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $project->title ?? '') }}" required>
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
            <label for="client_company" class="form-label">Entreprise / Client</label>
            <input type="text" name="client_company" id="client_company" class="form-control @error('client_company') is-invalid @enderror" value="{{ old('client_company', $project->client_company ?? '') }}">
            @error('client_company') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-12">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $project->description ?? '') }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-8">
            <label for="project_url" class="form-label">URL du projet</label>
            <input type="url" name="project_url" id="project_url" class="form-control @error('project_url') is-invalid @enderror" value="{{ old('project_url', $project->project_url ?? '') }}" placeholder="https://...">
            @error('project_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_featured">
                    <i class="bi bi-star-fill"></i> Projet phare
                </label>
            </div>
        </div>

        <div class="col-12">
            <label for="tags_string" class="form-label">Technologies</label>
            <input type="text" name="tags_string" id="tags_string" class="form-control" value="{{ $tagsString }}" placeholder="Laravel, Bootstrap 5, JavaScript, MySQL">
            <small class="text-muted">Séparez chaque technologie par une virgule.</small>
            <div id="tagsHiddenContainer"></div>
        </div>

        <div class="col-12">
            <label for="image" class="form-label">
                Image du projet {{ $project ? '' : '*' }}
            </label>
            <div class="admin-upload-preview admin-upload-preview-wide mb-2">
                <img id="projectImagePreview"
                     src="{{ $project?->image_url ?? 'https://via.placeholder.com/400x200?text=Image+du+projet' }}"
                     alt="Aperçu du projet">
            </div>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" {{ $project ? '' : 'required' }}>
            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            <small class="text-muted">JPG, PNG ou WEBP — 2 Mo maximum.</small>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Prévisualisation de l'image sélectionnée
    document.getElementById('image')?.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            document.getElementById('projectImagePreview').src = URL.createObjectURL(file);
        }
    });

    // Convertit le champ "tags_string" (séparé par virgules) en tableau tags[]
    // au moment de la soumission, pour correspondre à la validation 'tags' => array.
    document.querySelector('.admin-form')?.addEventListener('submit', function () {
        const container = document.getElementById('tagsHiddenContainer');
        container.innerHTML = '';

        const raw = document.getElementById('tags_string').value;
        const tags = raw.split(',').map(t => t.trim()).filter(t => t.length > 0);

        tags.forEach(tag => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'tags[]';
            input.value = tag;
            container.appendChild(input);
        });
    });
</script>
@endpush
