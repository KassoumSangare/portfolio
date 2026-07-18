<section id="formations" class="section timeline-section timeline-section-alt">
    <div class="container">
        <p class="terminal-eyebrow" data-reveal>formations </p>
        <h2 class="section-title" data-reveal>Formations</h2>

        <div class="timeline">
            @forelse ($educations as $education)
                <div class="timeline-item" data-reveal>
                    <div class="timeline-dot"></div>
                    <div class="timeline-card">
                        <span class="timeline-date">
                            {{ $education->start_year }}
                            —
                            {{ $education->end_year ?? 'En cours' }}
                        </span>
                        <h3 class="timeline-title">{{ $education->degree }}</h3>
                        <p class="timeline-subtitle">
                            {{ $education->school }}
                            @if ($education->field)
                                · {{ $education->field }}
                            @endif
                        </p>
                        @if ($education->description)
                            <p class="timeline-description">{{ $education->description }}</p>
                        @endif
                        @if (! $education->end_year)
                            <span class="timeline-badge">En cours</span>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-muted">Aucune formation renseignée pour le moment.</p>
            @endforelse
        </div>
    </div>
</section>
