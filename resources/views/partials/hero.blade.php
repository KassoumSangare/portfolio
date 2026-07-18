<section id="accueil" class="hero-section">
    <div class="hero-glow"></div>
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7 hero-text" data-reveal>
                <p class="terminal-eyebrow"> portfolio</p>
                <h1 class="hero-name">{{ $profile->full_name }}</h1>
                <p class="hero-title">{{ $profile->title }}</p>

                @if ($profile->city)
                    <p class="hero-location">
                        <i class="bi bi-geo-alt"></i>
                        {{ $profile->address ? $profile->address . ', ' : '' }}{{ $profile->city }}@if ($profile->country), {{ $profile->country }}@endif
                    </p>
                @endif

                <div class="hero-actions">
                    @if ($profile->cv_url)
                        <a href="{{ $profile->cv_url }}" class="btn btn-hero-primary" target="_blank" download>
                            <i class="bi bi-download"></i> Télécharger le CV
                        </a>
                    @endif
                    <a href="#contact" class="btn btn-hero-outline">
                        <i class="bi bi-chat-dots"></i> Me contacter
                    </a>
                </div>

                <div class="hero-socials">
                    @if ($profile->github_url)
                        <a href="{{ $profile->github_url }}" target="_blank" aria-label="GitHub"><i class="bi bi-github"></i></a>
                    @endif
                    @if ($profile->linkedin_url)
                        <a href="{{ $profile->linkedin_url }}" target="_blank" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    @endif
                    @if ($profile->website_url)
                        <a href="{{ $profile->website_url }}" target="_blank" aria-label="Site web"><i class="bi bi-globe"></i></a>
                    @endif
                </div>
            </div>

            <div class="col-lg-5 text-center" data-reveal>
                <div class="hero-photo-frame">
                    @if ($profile->photo_url)
                        <img src="{{ $profile->photo_url }}" alt="{{ $profile->full_name }}" class="hero-photo">
                    @else
                        <div class="hero-photo hero-photo-placeholder">
                            <i class="bi bi-person"></i>
                        </div>
                    @endif
                    <span class="hero-photo-tag">&lt;/&gt; {{ $profile->current_position ?? $profile->title }}</span>
                </div>
            </div>
        </div>
    </div>
</section>
