<footer class="site-footer">
    <div class="container">
        <p class="mb-0">
            &copy; {{ now()->year }} {{ $profile->full_name }}. Tous droits réservés.
        </p>
        <p class="site-footer-signature">
            <span class="terminal-eyebrow-inline"></span> "Conçu &amp; développé avec ❤️ par <a href="{{ $profile->website_url }}" target="_blank">{{ $profile->full_name }}</a>"
        </p>
    </div>
</footer>
