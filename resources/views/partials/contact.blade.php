<section id="contact" class="section contact-section">
    <div class="container">
        <p class="terminal-eyebrow" data-reveal>contact </p>
        <h2 class="section-title" data-reveal>Contact</h2>

        <div class="row g-5">
            <div class="col-lg-5" data-reveal>
                <p class="contact-intro">
                    Une idée de projet, une opportunité, ou simplement envie d'échanger ? N'hésitez pas à m'écrire.
                </p>

                <ul class="contact-info-list">
                    @if ($profile->email)
                        <li><i class="bi bi-envelope"></i> <a href="mailto:{{ $profile->email }}">{{ $profile->email }}</a></li>
                    @endif
                    @if ($profile->phone)
                        <li><i class="bi bi-telephone"></i> <a href="tel:{{ $profile->phone }}">{{ $profile->phone }}</a></li>
                    @endif
                    @if ($profile->city)
                        <li><i class="bi bi-geo-alt"></i> {{ $profile->address ? $profile->address . ', ' : '' }}{{ $profile->city }}</li>
                    @endif
                </ul>

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

            <div class="col-lg-7" data-reveal>
                <form id="contactForm" class="contact-form" novalidate>
                    @csrf

                    <div id="contactFormAlert" class="contact-form-alert" role="alert" hidden></div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="contact_name" class="form-label">Nom *</label>
                            <input type="text" id="contact_name" name="name" class="form-control" required>
                            <div class="invalid-feedback" data-error-for="name"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="contact_email" class="form-label">Email *</label>
                            <input type="email" id="contact_email" name="email" class="form-control" required>
                            <div class="invalid-feedback" data-error-for="email"></div>
                        </div>

                        <div class="col-12">
                            <label for="contact_subject" class="form-label">Sujet *</label>
                            <input type="text" id="contact_subject" name="subject" class="form-control" required>
                            <div class="invalid-feedback" data-error-for="subject"></div>
                        </div>

                        <div class="col-12">
                            <label for="contact_message" class="form-label">Message *</label>
                            <textarea id="contact_message" name="message" rows="5" class="form-control" required></textarea>
                            <div class="invalid-feedback" data-error-for="message"></div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-hero-primary" id="contactSubmitBtn">
                                <span class="btn-label">Envoyer le message</span>
                                <span class="btn-spinner" hidden><span class="spinner-border spinner-border-sm"></span></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
