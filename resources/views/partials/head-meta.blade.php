@php
    $pageTitle = trim($__env->yieldContent('title'));
    $metaTitle = $pageTitle ?: ($seo['seo_meta_title'] ?? ($seo['website_name'] ?? 'Sahaj Aarogyam'));

    $pageDescription = trim($__env->yieldContent('meta_description'));
    $metaDescription = $pageDescription ?: ($seo['seo_meta_description'] ?? '');

    $metaKeywords = $seo['seo_meta_keywords'] ?? '';
    $metaAuthor = $seo['seo_meta_author'] ?? ($seo['website_name'] ?? 'Sahaj Aarogyam');
    $metaRobots = $seo['seo_robots'] ?? 'index, follow';

    $ogTitle = trim($__env->yieldContent('og_title')) ?: ($seo['seo_og_title'] ?? $metaTitle);
    $ogDescription = trim($__env->yieldContent('og_description')) ?: ($seo['seo_og_description'] ?? $metaDescription);
    $ogImageSetting = $seo['seo_og_image'] ?? '';
    $ogImage = trim($__env->yieldContent('og_image'));

    if (! $ogImage && $ogImageSetting) {
        $ogImage = \App\Models\Setting::imageUrl($ogImageSetting, '');
    }

    $twitterCard = $seo['seo_twitter_card'] ?? 'summary_large_image';
    $twitterSite = $seo['seo_twitter_site'] ?? '';
    $googleVerification = $seo['seo_google_site_verification'] ?? '';
    $canonicalUrl = url()->current();
@endphp

<title>{{ $metaTitle }}</title>
<meta name="description" content="{{ $metaDescription }}">
@if ($metaKeywords)
    <meta name="keywords" content="{{ $metaKeywords }}">
@endif
@if ($metaAuthor)
    <meta name="author" content="{{ $metaAuthor }}">
@endif
@if ($metaRobots)
    <meta name="robots" content="{{ $metaRobots }}">
@endif
@if ($googleVerification)
    <meta name="google-site-verification" content="{{ $googleVerification }}">
@endif
<link rel="canonical" href="{{ $canonicalUrl }}">

<meta property="og:type" content="website">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:title" content="{{ $ogTitle }}">
@if ($ogDescription)
    <meta property="og:description" content="{{ $ogDescription }}">
@endif
@if ($ogImage)
    <meta property="og:image" content="{{ $ogImage }}">
@endif
<meta property="og:site_name" content="{{ $seo['website_name'] ?? 'Sahaj Aarogyam' }}">

<meta name="twitter:card" content="{{ $twitterCard }}">
@if ($twitterSite)
    <meta name="twitter:site" content="{{ $twitterSite }}">
@endif
<meta name="twitter:title" content="{{ $ogTitle }}">
@if ($ogDescription)
    <meta name="twitter:description" content="{{ $ogDescription }}">
@endif
@if ($ogImage)
    <meta name="twitter:image" content="{{ $ogImage }}">
@endif
