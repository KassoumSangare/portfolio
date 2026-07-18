<section id="competences" class="section skills-section">
    <div class="container">
        <p class="terminal-eyebrow" data-reveal>competences</p>
        <h2 class="section-title" data-reveal>Compétences</h2>

        <div class="row g-4">
            @forelse ($skills as $category => $items)
                <div class="col-md-4" data-reveal>
                    <div class="skill-category-card">
                        <h3 class="skill-category-title">{{ $category }}</h3>
                        <ul class="skill-list">
                            @foreach ($items as $skill)
                                <li class="skill-item">
                                    <div class="skill-item-head">
                                        @if ($skill->icon)
                                            <i class="{{ $skill->icon }}"></i>
                                        @endif
                                        <span>{{ $skill->name }}</span>
                                        <span class="skill-level-tag skill-level-{{ $skill->level }}">{{ ucfirst($skill->level) }}</span>
                                    </div>
                                    <div class="skill-bar">
                                        <div class="skill-bar-fill skill-bar-{{ $skill->level }}"></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @empty
                <p class="text-muted">Aucune compétence renseignée pour le moment.</p>
            @endforelse
        </div>
    </div>
</section>
