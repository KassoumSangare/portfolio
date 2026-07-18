<section id="experiences" class="section timeline-section">
    <div class="container">
        <p class="terminal-eyebrow" data-reveal>experiences </p>
        <h2 class="section-title" data-reveal>Expériences professionnelles</h2>

        <div class="timeline">
            @forelse ($experiences as $experience)
                <div class="timeline-item" data-reveal>
                    <div class="timeline-dot"></div>
                    <div class="timeline-card">
                        <span class="timeline-date">
                            {{ $experience->start_date->translatedFormat('M Y') }}
                            —
                            {{ $experience->is_current ? 'Aujourd\'hui' : $experience->end_date?->translatedFormat('M Y') }}
                        </span>
                        <h3 class="timeline-title">{{ $experience->position }}</h3>
                        <p class="timeline-subtitle">
                            {{ $experience->company }}
                            @if ($experience->location)
                                · {{ $experience->location }}
                            @endif
                        </p>
                        @if ($experience->description)
                            <p class="timeline-description">{{ $experience->description }}</p>
                        @endif
                        @if ($experience->is_current)
                            <span class="timeline-badge">Poste actuel</span>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-muted">Aucune expérience renseignée pour le moment.</p>
            @endforelse
        </div>
    </div>
</section>
