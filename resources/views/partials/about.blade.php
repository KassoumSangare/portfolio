<section id="a-propos" class="section about-section">
    <div class="container">
        <p class="terminal-eyebrow" data-reveal>profil </p>

        <div class="row align-items-center g-5">
            <div class="col-lg-7" data-reveal>
                @if ($profile->about)
                    <p class="about-text">{{ $profile->about }}</p>
                @endif

                <div class="about-meta-grid">
                    @if ($profile->years_experience)
                        <div class="about-meta-item">
                            <span class="about-meta-value">{{ $profile->years_experience }}+</span>
                            <span class="about-meta-label">An(s) d'expérience</span>
                        </div>
                    @endif
                    @if ($profile->current_position)
                        <div class="about-meta-item">
                            <span class="about-meta-value"><i class="bi bi-briefcase"></i></span>
                            <span class="about-meta-label">{{ $profile->current_position }}</span>
                        </div>
                    @endif
                    @if ($profile->city)
                        <div class="about-meta-item">
                            <span class="about-meta-value"><i class="bi bi-geo-alt"></i></span>
                            <span class="about-meta-label">{{ $profile->city }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-5" data-reveal>
                <div class="about-card">
                    <p class="about-card-line"><span class="about-card-key">nom</span> = "{{ $profile->full_name }}"</p>
                    <p class="about-card-line"><span class="about-card-key">titre</span> = "{{ $profile->title }}"</p>
                    @if ($profile->current_company)
                        <p class="about-card-line"><span class="about-card-key">entreprise</span> = "{{ $profile->current_company }}"</p>
                    @endif
                    @if ($profile->email)
                        <p class="about-card-line"><span class="about-card-key">email</span> = "{{ $profile->email }}"</p>
                    @endif
                    @if ($profile->phone)
                        <p class="about-card-line"><span class="about-card-key">tel</span> = "{{ $profile->phone }}"</p>
                    @endif
                    <p class="about-card-line about-card-status"><span class="about-card-key">statut</span> = "disponible"</p>
                </div>
            </div>
        </div>
    </div>
</section>
