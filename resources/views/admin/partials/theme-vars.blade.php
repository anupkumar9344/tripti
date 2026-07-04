@php
    $adminTheme = $adminThemeColors ?? \App\Support\AdminThemeColors::resolve();
@endphp
<style id="admin-theme-vars">
    :root {
        --admin-primary: {{ $adminTheme['primary'] }};
        --admin-secondary: {{ $adminTheme['secondary'] }};
        --admin-primary-dark: {{ $adminTheme['primary_dark'] }};
        --admin-secondary-dark: {{ $adminTheme['secondary_dark'] }};
        --admin-primary-rgb: {{ $adminTheme['primary_rgb'] }};
        --admin-secondary-rgb: {{ $adminTheme['secondary_rgb'] }};
        --bs-primary: {{ $adminTheme['primary'] }};
        --bs-primary-rgb: {{ $adminTheme['primary_rgb'] }};
        --bs-secondary: {{ $adminTheme['secondary'] }};
        --bs-secondary-rgb: {{ $adminTheme['secondary_rgb'] }};
        --admin-auth-primary: {{ $adminTheme['primary'] }};
        --admin-auth-primary-soft: rgba({{ $adminTheme['primary_rgb'] }}, 0.08);
    }
</style>
