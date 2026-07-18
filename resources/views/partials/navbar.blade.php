<nav class="navbar navbar-expand-lg fixed-top site-navbar" id="siteNavbar">
    <div class="container">
        <a class="navbar-brand" href="#accueil">
            <span class="terminal-eyebrow-inline"></span>{{ Str::of($profile->first_name)->lower() }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#siteNavbarNav" aria-controls="siteNavbarNav" aria-expanded="false" aria-label="Ouvrir la navigation">
            <i class="bi bi-list"></i>
        </button>

        <div class="collapse navbar-collapse" id="siteNavbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="#accueil">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="#a-propos">À propos</a></li>
                <li class="nav-item"><a class="nav-link" href="#competences">Compétences</a></li>
                <li class="nav-item"><a class="nav-link" href="#experiences">Expériences</a></li>
                <li class="nav-item"><a class="nav-link" href="#projets">Projets</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                <li class="nav-item">
                    <button type="button" id="themeToggle" class="theme-toggle" aria-label="Changer de thème">
                        <i class="bi bi-sun-fill theme-icon-light"></i>
                        <i class="bi bi-moon-stars-fill theme-icon-dark"></i>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>
