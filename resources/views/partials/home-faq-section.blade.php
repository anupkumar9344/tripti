@php
    use App\Models\Setting;

    $eyebrow = $faqHomeSettings['faq_home_eyebrow'] ?? 'FAQs';
    $title = $faqHomeSettings['faq_home_title'] ?? 'Frequently Asked Questions';
    $description = $faqHomeSettings['faq_home_description'] ?? '';
    $imageUrl = Setting::imageUrl($faqHomeSettings['faq_home_image'] ?? null, 'faqs-image.jpg');
    $contactLabel = $faqHomeSettings['faq_home_contact_label'] ?? 'Still Have Questions?';
    $contactPhone = $settings['phone_1'] ?? '+91 94259 63336';
@endphp

@include('partials.faq-content-section', [
    'faqs' => $homeFaqs,
    'eyebrow' => $eyebrow,
    'title' => $title,
    'description' => $description,
    'imageUrl' => $imageUrl,
    'contactLabel' => $contactLabel,
    'contactPhone' => $contactPhone,
    'accordionId' => 'homeFaqAccordion',
])
