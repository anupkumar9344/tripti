@php
    $modal = $welcomeModal ?? [];
    $shouldRender = ($modal['enabled'] ?? false) && ($modal['hasContent'] ?? false);
    $buttonUrl = trim((string) ($modal['buttonUrl'] ?? ''));

    if ($buttonUrl !== '' && ! str_starts_with($buttonUrl, 'http://') && ! str_starts_with($buttonUrl, 'https://')) {
        $buttonUrl = url($buttonUrl);
    }
@endphp

@if ($shouldRender)
<div class="modal fade site-welcome-modal" id="siteWelcomeModal" tabindex="-1" aria-labelledby="siteWelcomeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <button type="button" class="btn-close site-welcome-modal__close" data-bs-dismiss="modal" aria-label="Close"></button>

            @if (($modal['mediaType'] ?? 'none') === 'image')
                <div class="site-welcome-modal__media">
                    <img src="{{ $modal['imageUrl'] }}" alt="{{ $modal['title'] ?: 'Welcome' }}" class="site-welcome-modal__image">
                </div>
            @elseif (($modal['mediaType'] ?? 'none') === 'video' && filled($modal['videoEmbedUrl'] ?? ''))
                <div class="site-welcome-modal__media site-welcome-modal__media--video">
                    @if (str_contains($modal['videoEmbedUrl'], 'youtube.com') || str_contains($modal['videoEmbedUrl'], 'vimeo.com'))
                        <iframe
                            src="{{ $modal['videoEmbedUrl'] }}"
                            title="{{ $modal['title'] ?: 'Welcome video' }}"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                        ></iframe>
                    @else
                        <video class="site-welcome-modal__video" controls playsinline preload="metadata">
                            <source src="{{ $modal['videoEmbedUrl'] }}">
                        </video>
                    @endif
                </div>
            @endif

            <div class="site-welcome-modal__body">
                <span class="site-welcome-modal__eyebrow">Welcome</span>

                @if (filled($modal['title'] ?? ''))
                    <h3 class="site-welcome-modal__title" id="siteWelcomeModalLabel">{{ $modal['title'] }}</h3>
                @endif

                @if (filled($modal['message'] ?? ''))
                    <p class="site-welcome-modal__message">{{ $modal['message'] }}</p>
                @endif

                <div class="site-welcome-modal__actions">
                    @if (filled($modal['buttonText'] ?? '') && filled($buttonUrl))
                        <a href="{{ $buttonUrl }}" class="site-welcome-modal__cta js-welcome-dismiss">
                            {{ $modal['buttonText'] }}
                        </a>
                    @endif
                    <button type="button" class="site-welcome-modal__link js-welcome-dismiss" data-bs-dismiss="modal">
                        {{ filled($modal['buttonText'] ?? '') && filled($buttonUrl) ? 'Maybe Later' : 'Continue' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    (function () {
        var modalEl = document.getElementById('siteWelcomeModal');

        if (!modalEl || typeof bootstrap === 'undefined') {
            return;
        }

        var storageKey = 'tripti_welcome_modal';
        var dismissHours = 24;
        var revision = @json($modal['revision'] ?? '1');
        var now = Date.now();
        var stored = null;

        try {
            stored = JSON.parse(localStorage.getItem(storageKey) || 'null');
        } catch (error) {
            stored = null;
        }

        var isDismissed = false;

        if (stored && stored.revision === revision && stored.dismissedAt) {
            isDismissed = (now - stored.dismissedAt) < (dismissHours * 60 * 60 * 1000);
        }

        if (isDismissed) {
            return;
        }

        function rememberDismissal() {
            try {
                localStorage.setItem(storageKey, JSON.stringify({
                    revision: revision,
                    dismissedAt: Date.now()
                }));
            } catch (error) {
                // Ignore storage errors.
            }
        }

        var modal = new bootstrap.Modal(modalEl);

        modalEl.addEventListener('hidden.bs.modal', rememberDismissal);
        modalEl.querySelectorAll('.js-welcome-dismiss').forEach(function (button) {
            button.addEventListener('click', rememberDismissal);
        });

        window.addEventListener('load', function () {
            setTimeout(function () {
                modal.show();
            }, 800);
        });
    })();
</script>
@endpush
@endif
