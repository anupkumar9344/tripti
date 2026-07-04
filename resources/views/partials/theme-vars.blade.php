@php
    $theme = $themeColors ?? \App\Support\ThemeColors::resolve();
@endphp
<style id="site-theme-vars">
    :root {
        --theme-primary: {{ $theme['primary'] }};
        --theme-secondary: {{ $theme['secondary'] }};
        --theme-primary-dark: {{ $theme['primary_dark'] }};
        --theme-primary-light: {{ $theme['primary_light'] }};
        --theme-primary-rgb: {{ $theme['primary_rgb'] }};
        --theme-secondary-rgb: {{ $theme['secondary_rgb'] }};
    }
</style>
