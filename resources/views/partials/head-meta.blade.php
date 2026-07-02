@php
    $pageTitle = trim($__env->yieldContent('title'));
    $metaTitle = $pageTitle ?: ($seo['seo_meta_title'] ?? 'Tripti Hotel');
    $metaDescription = trim($__env->yieldContent('meta_description')) ?: ($seo['seo_meta_description'] ?? '');
    $metaKeywords = trim($__env->yieldContent('meta_keywords')) ?: ($seo['seo_meta_keywords'] ?? '');
    $metaRobots = trim($__env->yieldContent('meta_robots')) ?: ($seo['seo_robots'] ?? 'index, follow');
    $metaAuthor = $seo['seo_meta_author'] ?? 'Tripti Hotel';
    $ogTitle = trim($__env->yieldContent('og_title')) ?: ($seo['seo_og_title'] ?? $metaTitle);
    $ogDescription = trim($__env->yieldContent('og_description')) ?: ($seo['seo_og_description'] ?? $metaDescription);
    $faviconUrl = asset('assets/img/favicon/favicon.png');
    $ogImage = trim($__env->yieldContent('og_image')) ?: asset('assets/img/logo/logo.png');
    $canonicalUrl = url()->current();
@endphp

<title>{{ $metaTitle }}</title>
<link rel="shortcut icon" type="image/x-icon" href="{{ $faviconUrl }}">
<link rel="icon" href="{{ $faviconUrl }}">
<meta name="description" content="{{ $metaDescription }}">
@if ($metaKeywords)
    <meta name="keywords" content="{{ $metaKeywords }}">
@endif
<meta name="author" content="{{ $metaAuthor }}">
<meta name="robots" content="{{ $metaRobots }}">
<link rel="canonical" href="{{ $canonicalUrl }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:title" content="{{ $ogTitle }}">
@if ($ogDescription)
    <meta property="og:description" content="{{ $ogDescription }}">
@endif
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:site_name" content="{{ $seo['website_name'] ?? 'Tripti Hotel' }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $ogTitle }}">
@if ($ogDescription)
    <meta name="twitter:description" content="{{ $ogDescription }}">
@endif
<meta name="twitter:image" content="{{ $ogImage }}">
