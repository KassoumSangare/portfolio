<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration') — Portfolio</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body class="admin-body">

    <div class="admin-layout">

        <!-- Sidebar (desktop) -->
        <aside class="admin-sidebar d-none d-lg-flex flex-column">
            <div class="admin-sidebar-brand">
                <i class="bi bi-code-square"></i>
                <span>Portfolio Admin</span>
            </div>

            <nav class="admin-nav flex-grow-1">
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Tableau de bord
                </a>
                <a href="{{ route('admin.profile.edit') }}" class="admin-nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                    <i class="bi bi-person-circle"></i> Profil
                </a>
                <a href="{{ route('admin.skills.index') }}" class="admin-nav-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                    <i class="bi bi-cpu"></i> Compétences
                </a>
                <a href="{{ route('admin.experiences.index') }}" class="admin-nav-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
                    <i class="bi bi-briefcase"></i> Expériences
                </a>
                <a href="{{ route('admin.educations.index') }}" class="admin-nav-link {{ request()->routeIs('admin.educations.*') ? 'active' : '' }}">
                    <i class="bi bi-mortarboard"></i> Formations
                </a>
                <a href="{{ route('admin.projects.index') }}" class="admin-nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <i class="bi bi-kanban"></i> Projets
                </a>
            </nav>

            <div class="admin-sidebar-footer">
                <a href="{{ route('portfolio.index') }}" target="_blank" class="admin-nav-link">
                    <i class="bi bi-box-arrow-up-right"></i> Voir le site
                </a>
                @if (Route::has('logout'))
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="admin-nav-link admin-logout-btn">
                            <i class="bi bi-box-arrow-right"></i> Déconnexion
                        </button>
                    </form>
                @else
                    <span class="admin-nav-link text-danger" title="Route 'logout' introuvable — vérifiez l'installation de Breeze">
                        <i class="bi bi-exclamation-triangle"></i> Déconnexion indisponible
                    </span>
                @endif
            </div>
        </aside>

        <!-- Sidebar mobile (offcanvas) -->
        <div class="offcanvas offcanvas-start admin-offcanvas d-lg-none" tabindex="-1" id="adminSidebarOffcanvas">
            <div class="offcanvas-header">
                <span class="admin-sidebar-brand mb-0">
                    <i class="bi bi-code-square"></i> Portfolio Admin
                </span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column p-0">
                <nav class="admin-nav flex-grow-1">
                    <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Tableau de bord
                    </a>
                    <a href="{{ route('admin.profile.edit') }}" class="admin-nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                        <i class="bi bi-person-circle"></i> Profil
                    </a>
                    <a href="{{ route('admin.skills.index') }}" class="admin-nav-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                        <i class="bi bi-cpu"></i> Compétences
                    </a>
                    <a href="{{ route('admin.experiences.index') }}" class="admin-nav-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
                        <i class="bi bi-briefcase"></i> Expériences
                    </a>
                    <a href="{{ route('admin.educations.index') }}" class="admin-nav-link {{ request()->routeIs('admin.educations.*') ? 'active' : '' }}">
                        <i class="bi bi-mortarboard"></i> Formations
                    </a>
                    <a href="{{ route('admin.projects.index') }}" class="admin-nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                        <i class="bi bi-kanban"></i> Projets
                    </a>
                </nav>
                <div class="admin-sidebar-footer">
                    <a href="{{ route('portfolio.index') }}" target="_blank" class="admin-nav-link">
                        <i class="bi bi-box-arrow-up-right"></i> Voir le site
                    </a>
                    @if (Route::has('logout'))
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="admin-nav-link admin-logout-btn">
                                <i class="bi bi-box-arrow-right"></i> Déconnexion
                            </button>
                        </form>
                    @else
                        <span class="admin-nav-link text-danger">
                            <i class="bi bi-exclamation-triangle"></i> Déconnexion indisponible
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="admin-main">

            <!-- Navbar top -->
            <header class="admin-topbar">
                <button class="btn admin-burger d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebarOffcanvas">
                    <i class="bi bi-list"></i>
                </button>

                <nav aria-label="breadcrumb" class="admin-breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                        @yield('breadcrumb')
                    </ol>
                </nav>

                <div class="admin-topbar-user">
                    <i class="bi bi-person-fill"></i>
                    <span>{{ auth()->user()?->name }}</span>
                </div>
            </header>

            <main class="admin-content">
                @if (session('success'))
                    <div class="alert admin-alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert admin-alert-error alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle"></i>
                        <strong>Veuillez corriger les erreurs suivantes :</strong>
                        <ul class="mb-0 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
