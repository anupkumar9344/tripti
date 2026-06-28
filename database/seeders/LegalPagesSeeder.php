<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Seeds default privacy policy and terms & conditions content.
 */
class LegalPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'privacy_policy_title' => 'Privacy Policy',
            'privacy_policy_content' => '<p>At Sahaj Aarogyam, we respect your privacy and are committed to protecting your personal information. This policy explains how we collect, use, and safeguard the details you share with us through our website, contact forms, appointments, and clinic visits.</p><p>We may collect information such as your name, phone number, email address, health-related details you choose to share, and communication records when you contact us or book a consultation.</p><p>Your information is used only to respond to inquiries, provide healthcare services, improve our website experience, and communicate important updates related to your care or our services.</p><p>We do not sell your personal data. Information is shared only when required by law or with trusted service providers who help us operate our website and communication systems.</p><p>If you have questions about this privacy policy or wish to update your information, please contact us through the details available on our website.</p>',
            'terms_conditions_title' => 'Terms & Conditions',
            'terms_conditions_content' => '<p>By accessing and using the Sahaj Aarogyam website, you agree to these terms and conditions. Please read them carefully before using our site or submitting any information.</p><p>The content on this website is provided for general information about our wellness services, treatments, programs, and clinic offerings. It does not replace professional medical advice, diagnosis, or treatment.</p><p>You agree to use the website lawfully and not to misuse contact forms, appointment requests, or any other feature of the site. Information submitted through the website must be accurate to the best of your knowledge.</p><p>All website content, branding, images, and materials remain the property of Sahaj Aarogyam unless otherwise stated. Unauthorized copying or redistribution is not permitted.</p><p>We may update these terms from time to time. Continued use of the website after changes are published means you accept the revised terms.</p><p>For any questions regarding these terms, please contact us using the information provided on our contact page.</p>',
        ];

        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }
    }
}
