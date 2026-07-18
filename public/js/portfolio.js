/**
 * portfolio.js
 * JavaScript vanille (aucune dépendance externe) pour la page publique du portfolio.
 * Modules : mode sombre/clair, navbar au scroll, révélation au scroll,
 * validation + soumission AJAX du formulaire de contact.
 */

(function () {
    'use strict';

    /* ------------------------------------------------------------------
     * 1. Mode sombre / clair — persistance via localStorage
     * ------------------------------------------------------------------ */
    function initThemeToggle() {
        const root = document.documentElement;
        const toggleBtn = document.getElementById('themeToggle');

        const storedTheme = localStorage.getItem('portfolio-theme');
        if (storedTheme === 'light' || storedTheme === 'dark') {
            root.setAttribute('data-theme', storedTheme);
        }

        toggleBtn?.addEventListener('click', function () {
            const current = root.getAttribute('data-theme') === 'light' ? 'light' : 'dark';
            const next = current === 'dark' ? 'light' : 'dark';
            root.setAttribute('data-theme', next);
            localStorage.setItem('portfolio-theme', next);
        });
    }

    /* ------------------------------------------------------------------
     * 2. Navbar : légère opacification au scroll
     * ------------------------------------------------------------------ */
    function initNavbarScroll() {
        const navbar = document.getElementById('siteNavbar');
        if (!navbar) return;

        window.addEventListener('scroll', function () {
            if (window.scrollY > 20) {
                navbar.style.boxShadow = '0 8px 24px -12px rgba(0,0,0,0.35)';
            } else {
                navbar.style.boxShadow = 'none';
            }
        });
    }

    /* ------------------------------------------------------------------
     * 3. Révélation des éléments au scroll (IntersectionObserver)
     * ------------------------------------------------------------------ */
    function initScrollReveal() {
        const elements = document.querySelectorAll('[data-reveal]');
        if (!elements.length) return;

        if (!('IntersectionObserver' in window)) {
            elements.forEach((el) => el.classList.add('is-visible'));
            return;
        }

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.15 }
        );

        elements.forEach((el) => observer.observe(el));
    }

    /* ------------------------------------------------------------------
     * 4. Fermeture automatique du menu mobile après clic sur un lien
     * ------------------------------------------------------------------ */
    function initMobileNavClose() {
        const navCollapse = document.getElementById('siteNavbarNav');
        if (!navCollapse) return;

        navCollapse.querySelectorAll('a.nav-link').forEach((link) => {
            link.addEventListener('click', function () {
                if (navCollapse.classList.contains('show') && window.bootstrap) {
                    const collapseInstance = window.bootstrap.Collapse.getOrCreateInstance(navCollapse);
                    collapseInstance.hide();
                }
            });
        });
    }

    /* ------------------------------------------------------------------
     * 5. Formulaire de contact : validation JS + soumission AJAX (fetch)
     *    sans rechargement de page, avec affichage des erreurs.
     * ------------------------------------------------------------------ */
    function initContactForm() {
        const form = document.getElementById('contactForm');
        if (!form) return;

        const alertBox = document.getElementById('contactFormAlert');
        const submitBtn = document.getElementById('contactSubmitBtn');
        const btnLabel = submitBtn?.querySelector('.btn-label');
        const btnSpinner = submitBtn?.querySelector('.btn-spinner');

        function clearErrors() {
            form.querySelectorAll('.invalid-feedback').forEach((el) => {
                el.textContent = '';
                el.classList.remove('is-visible');
            });
            form.querySelectorAll('.form-control').forEach((el) => {
                el.classList.remove('is-invalid');
            });
        }

        function showFieldError(fieldName, message) {
            const input = form.querySelector(`[name="${fieldName}"]`);
            const feedback = form.querySelector(`[data-error-for="${fieldName}"]`);
            input?.classList.add('is-invalid');
            if (feedback) {
                feedback.textContent = message;
                feedback.classList.add('is-visible');
            }
        }

        function showAlert(type, message) {
            if (!alertBox) return;
            alertBox.textContent = message;
            alertBox.className = 'contact-form-alert ' + (type === 'success' ? 'is-success' : 'is-error');
            alertBox.hidden = false;
        }

        function isValidEmail(value) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
        }

        function validateClientSide(data) {
            let isValid = true;

            if (!data.name.trim()) {
                showFieldError('name', 'Le nom est obligatoire.');
                isValid = false;
            }
            if (!data.email.trim()) {
                showFieldError('email', "L'email est obligatoire.");
                isValid = false;
            } else if (!isValidEmail(data.email)) {
                showFieldError('email', "L'adresse email n'est pas valide.");
                isValid = false;
            }
            if (!data.subject.trim()) {
                showFieldError('subject', 'Le sujet est obligatoire.');
                isValid = false;
            }
            if (!data.message.trim()) {
                showFieldError('message', 'Le message est obligatoire.');
                isValid = false;
            }

            return isValid;
        }

        function setLoading(isLoading) {
            if (!submitBtn) return;
            submitBtn.disabled = isLoading;
            btnLabel?.toggleAttribute('hidden', isLoading);
            btnSpinner?.toggleAttribute('hidden', !isLoading);
        }

        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            clearErrors();
            if (alertBox) alertBox.hidden = true;

            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            if (!validateClientSide(data)) {
                return;
            }

            setLoading(true);

            try {
                const csrfToken = form.querySelector('input[name="_token"]')?.value;

                const response = await fetch(form.dataset.action || '/contact', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': csrfToken || '',
                    },
                    body: JSON.stringify(data),
                });

                const result = await response.json();

                if (response.status === 422 && result.errors) {
                    Object.keys(result.errors).forEach((field) => {
                        showFieldError(field, result.errors[field][0]);
                    });
                    showAlert('error', 'Veuillez corriger les erreurs du formulaire.');
                    return;
                }

                if (!response.ok) {
                    showAlert('error', "Une erreur est survenue. Merci de réessayer plus tard.");
                    return;
                }

                showAlert('success', result.message || 'Votre message a bien été envoyé.');
                form.reset();
            } catch (error) {
                showAlert('error', "Impossible d'envoyer le message. Vérifiez votre connexion et réessayez.");
            } finally {
                setLoading(false);
            }
        });
    }

    /* ------------------------------------------------------------------
     * Initialisation au chargement du DOM
     * ------------------------------------------------------------------ */
    document.addEventListener('DOMContentLoaded', function () {
        initThemeToggle();
        initNavbarScroll();
        initScrollReveal();
        initMobileNavClose();
        initContactForm();
    });
})();
