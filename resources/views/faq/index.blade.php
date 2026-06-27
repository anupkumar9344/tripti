@extends('layouts.app')

@section('title', 'FAQs | Sahaj Aarogyam')

@section('content')
    @php
        use App\Models\Setting;

        $headerImage = Setting::imageUrl($faqPageSettings['faq_page_image'] ?? null, 'faqs-image.jpg');
    @endphp

    @include('partials.page-header', [
        'title' => 'FAQs',
        'breadcrumb' => 'FAQs',
        'bgImage' => $headerImage,
    ])

    @include('partials.faq-content-section', [
        'faqs' => $faqPageItems,
        'eyebrow' => $faqPageSettings['faq_page_eyebrow'] ?? 'FAQs',
        'title' => $faqPageSettings['faq_page_title'] ?? 'Frequently Asked Questions',
        'description' => $faqPageSettings['faq_page_description'] ?? '',
        'imageUrl' => $headerImage,
        'contactLabel' => $faqPageSettings['faq_page_contact_label'] ?? 'Still Have Questions?',
        'contactPhone' => $faqPageSettings['phone_1'] ?? '+91 94259 63336',
        'accordionId' => 'faqPageAccordion',
    ])
@endsection
