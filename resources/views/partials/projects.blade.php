<section id="projets" class="section projects-section">
    <div class="container">
        <p class="terminal-eyebrow" data-reveal>projets</p>
        <h2 class="section-title" data-reveal>Projets</h2>

        <div class="row g-4">
            @forelse ($projects as $project)
                <div class="col-md-6 col-lg-4" data-reveal>
                    <article class="project-card">
                        <div class="project-card-image">
                            @if ($project->image_url)
                                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" loading="lazy">
                            @else
                                <div class="project-card-placeholder">
                                    <i class="bi bi-code-square"></i>
                                </div>
                            @endif
                            @if ($project->is_featured)
                                <span class="project-featured-badge">
                                    <i class="bi bi-star-fill"></i> Projet phare
                                </span>
                            @endif
                        </div>

                        <div class="project-card-body">
                            <h3 class="project-card-title">{{ $project->title }}</h3>
                            @if ($project->client_company)
                                <p class="project-card-client">{{ $project->client_company }}</p>
                            @endif
                            @if ($project->description)
                                <p class="project-card-description">{{ $project->description }}</p>
                            @endif

                            @if ($project->tags)
                                <div class="project-card-tags">
                                    @foreach ($project->tags as $tag)
                                        <span class="project-tag">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif

                            @if ($project->project_url)
                                <a href="{{ $project->project_url }}" target="_blank" rel="noopener" class="project-card-link">
                                    Voir le projet <i class="bi bi-arrow-up-right"></i>
                                </a>
                            @endif
                        </div>
                    </article>
                </div>
            @empty
                <p class="text-muted">Aucun projet renseigné pour le moment.</p>
            @endforelse
        </div>
    </div>
</section>
