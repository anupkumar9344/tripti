<?php

namespace App\Support;

/**
 * Central registry of admin panel permissions grouped by section.
 */
class AdminPermissions
{
    public const SUPER_ADMIN_ROLE = 'Super Admin';

    /**
     * Permission groups for role assignment UI and seeding.
     *
     * @return array<string, array<string, string>>
     */
    public static function sections(): array
    {
        return [
            'Dashboard' => [
                'dashboard.view' => 'View dashboard',
            ],
            'Contact Messages' => [
                'contacts.view' => 'View messages',
                'contacts.delete' => 'Delete messages',
            ],
            'Bookings' => [
                'bookings.view' => 'View bookings',
                'bookings.update' => 'Update booking status',
                'bookings.delete' => 'Delete bookings',
            ],
            'Inquiries' => [
                'inquiries.view' => 'View inquiries',
                'inquiries.create' => 'Add inquiries',
                'inquiries.edit' => 'Edit inquiries',
                'inquiries.delete' => 'Delete inquiries',
                'inquiries.update-status' => 'Update inquiry status',
            ],
            'Hotel Amenities' => [
                'hotel-amenities.view' => 'View amenities',
                'hotel-amenities.create' => 'Add amenities',
                'hotel-amenities.edit' => 'Edit amenities',
                'hotel-amenities.delete' => 'Delete amenities',
                'hotel-amenities.toggle' => 'Enable / disable amenities',
            ],
            'Hotel Facilities' => [
                'hotel-facilities.view' => 'View facilities',
                'hotel-facilities.create' => 'Add facilities',
                'hotel-facilities.edit' => 'Edit facilities',
                'hotel-facilities.delete' => 'Delete facilities',
                'hotel-facilities.toggle' => 'Enable / disable facilities',
            ],
            'Bed Types' => [
                'bed-types.view' => 'View bed types',
                'bed-types.create' => 'Add bed types',
                'bed-types.edit' => 'Edit bed types',
                'bed-types.delete' => 'Delete bed types',
            ],
            'Room Types' => [
                'room-types.view' => 'View room types',
                'room-types.create' => 'Add room types',
                'room-types.edit' => 'Edit room types',
                'room-types.delete' => 'Delete room types',
                'room-types.toggle' => 'Enable / disable room types',
            ],
            'Rooms' => [
                'rooms.view' => 'View rooms',
                'rooms.create' => 'Add rooms',
                'rooms.edit' => 'Edit rooms',
                'rooms.delete' => 'Delete rooms',
                'rooms.toggle' => 'Enable / disable rooms',
            ],
            'Premium Services' => [
                'premium-services.view' => 'View premium services',
                'premium-services.create' => 'Add premium services',
                'premium-services.edit' => 'Edit premium services',
                'premium-services.delete' => 'Delete premium services',
                'premium-services.toggle' => 'Enable / disable premium services',
            ],
            'Hero Banners' => [
                'hero-banners.view' => 'View hero banners',
                'hero-banners.create' => 'Add hero banners',
                'hero-banners.edit' => 'Edit hero banners',
                'hero-banners.delete' => 'Delete hero banners',
            ],
            'About Us' => [
                'about.edit' => 'Edit about page',
            ],
            'Why Choose Us' => [
                'why-choose.view' => 'View items',
                'why-choose.create' => 'Add items',
                'why-choose.edit' => 'Edit items',
                'why-choose.delete' => 'Delete items',
            ],
            'Careers' => [
                'career-openings.view' => 'View job openings',
                'career-openings.create' => 'Add job openings',
                'career-openings.edit' => 'Edit job openings',
                'career-openings.delete' => 'Delete job openings',
                'careers.view' => 'View applications',
                'careers.update' => 'Update application status',
                'careers.delete' => 'Delete applications',
            ],
            'Feedback' => [
                'patient-reviews.view' => 'View feedback',
                'patient-reviews.create' => 'Add feedback',
                'patient-reviews.edit' => 'Edit feedback',
                'patient-reviews.delete' => 'Delete feedback',
                'patient-reviews.settings' => 'Manage feedback settings',
            ],
            'Shorts Video' => [
                'video-feedbacks.view' => 'View videos',
                'video-feedbacks.create' => 'Add videos',
                'video-feedbacks.edit' => 'Edit videos',
                'video-feedbacks.delete' => 'Delete videos',
            ],
            'Gallery' => [
                'gallery.view' => 'View gallery',
                'gallery.create' => 'Add gallery items',
                'gallery.edit' => 'Edit gallery items',
                'gallery.delete' => 'Delete gallery items',
            ],
            'Blog' => [
                'blog.view' => 'View blog posts',
                'blog.create' => 'Add blog posts',
                'blog.edit' => 'Edit blog posts',
                'blog.delete' => 'Delete blog posts',
            ],
            'FAQs' => [
                'faqs.view' => 'View FAQs',
                'faqs.create' => 'Add FAQs',
                'faqs.edit' => 'Edit FAQs',
                'faqs.delete' => 'Delete FAQs',
                'faqs.settings' => 'Manage FAQ settings',
            ],
            'Legal Pages' => [
                'legal-pages.edit' => 'Edit legal pages',
            ],
            'Media Library' => [
                'media.view' => 'View media library',
                'media.upload' => 'Upload files',
                'media.edit' => 'Rename files',
                'media.delete' => 'Delete files',
            ],
            'General Settings' => [
                'settings.general' => 'Manage general settings',
            ],
            'Staff' => [
                'staff.view' => 'View staff',
                'staff.create' => 'Add staff',
                'staff.edit' => 'Edit staff',
                'staff.delete' => 'Delete staff',
            ],
            'Roles & Permissions' => [
                'roles.view' => 'View roles',
                'roles.create' => 'Add roles',
                'roles.edit' => 'Edit roles',
                'roles.delete' => 'Delete roles',
            ],
            'System' => [
                'icons.view' => 'View icon reference',
                'cache.clear' => 'Clear cache',
            ],
        ];
    }

    /**
     * Flat list of all permission names.
     *
     * @return list<string>
     */
    public static function all(): array
    {
        $permissions = [];

        foreach (self::sections() as $items) {
            foreach ($items as $name => $label) {
                $permissions[] = $name;
            }
        }

        return $permissions;
    }

    /**
     * Map an admin route name to a required permission.
     */
    public static function permissionForRoute(?string $routeName): ?string
    {
        if ($routeName === null) {
            return null;
        }

        $map = [
            'admin.dashboard' => 'dashboard.view',
            'admin.profile.edit' => null,
            'admin.profile.update' => null,
            'admin.profile.password' => null,
            'admin.logout' => null,
            'admin.contacts.index' => 'contacts.view',
            'admin.contacts.show' => 'contacts.view',
            'admin.contacts.destroy' => 'contacts.delete',
            'admin.bookings.index' => 'bookings.view',
            'admin.bookings.show' => 'bookings.view',
            'admin.bookings.update-status' => 'bookings.update',
            'admin.bookings.destroy' => 'bookings.delete',
            'admin.hotel-inquiries.index' => 'inquiries.view',
            'admin.hotel-inquiries.create' => 'inquiries.create',
            'admin.hotel-inquiries.store' => 'inquiries.create',
            'admin.hotel-inquiries.show' => 'inquiries.view',
            'admin.hotel-inquiries.edit' => 'inquiries.edit',
            'admin.hotel-inquiries.update' => 'inquiries.edit',
            'admin.hotel-inquiries.destroy' => 'inquiries.delete',
            'admin.hotel-inquiries.update-status' => 'inquiries.update-status',
            'admin.hotel-amenities.index' => 'hotel-amenities.view',
            'admin.hotel-amenities.create' => 'hotel-amenities.create',
            'admin.hotel-amenities.store' => 'hotel-amenities.create',
            'admin.hotel-amenities.edit' => 'hotel-amenities.edit',
            'admin.hotel-amenities.update' => 'hotel-amenities.edit',
            'admin.hotel-amenities.destroy' => 'hotel-amenities.delete',
            'admin.hotel-amenities.toggle-status' => 'hotel-amenities.toggle',
            'admin.hotel-facilities.index' => 'hotel-facilities.view',
            'admin.hotel-facilities.create' => 'hotel-facilities.create',
            'admin.hotel-facilities.store' => 'hotel-facilities.create',
            'admin.hotel-facilities.edit' => 'hotel-facilities.edit',
            'admin.hotel-facilities.update' => 'hotel-facilities.edit',
            'admin.hotel-facilities.destroy' => 'hotel-facilities.delete',
            'admin.hotel-facilities.toggle-status' => 'hotel-facilities.toggle',
            'admin.bed-types.index' => 'bed-types.view',
            'admin.bed-types.create' => 'bed-types.create',
            'admin.bed-types.store' => 'bed-types.create',
            'admin.bed-types.edit' => 'bed-types.edit',
            'admin.bed-types.update' => 'bed-types.edit',
            'admin.bed-types.destroy' => 'bed-types.delete',
            'admin.room-types.index' => 'room-types.view',
            'admin.room-types.create' => 'room-types.create',
            'admin.room-types.store' => 'room-types.create',
            'admin.room-types.edit' => 'room-types.edit',
            'admin.room-types.update' => 'room-types.edit',
            'admin.room-types.destroy' => 'room-types.delete',
            'admin.room-types.toggle-status' => 'room-types.toggle',
            'admin.room-types.rooms.index' => 'rooms.view',
            'admin.room-types.rooms.create' => 'rooms.create',
            'admin.room-types.rooms.store' => 'rooms.create',
            'admin.room-types.rooms.edit' => 'rooms.edit',
            'admin.room-types.rooms.update' => 'rooms.edit',
            'admin.room-types.rooms.destroy' => 'rooms.delete',
            'admin.room-types.rooms.toggle-status' => 'rooms.toggle',
            'admin.premium-services.index' => 'premium-services.view',
            'admin.premium-services.create' => 'premium-services.create',
            'admin.premium-services.store' => 'premium-services.create',
            'admin.premium-services.edit' => 'premium-services.edit',
            'admin.premium-services.update' => 'premium-services.edit',
            'admin.premium-services.destroy' => 'premium-services.delete',
            'admin.premium-services.toggle-status' => 'premium-services.toggle',
            'admin.hero-banners.index' => 'hero-banners.view',
            'admin.hero-banners.create' => 'hero-banners.create',
            'admin.hero-banners.store' => 'hero-banners.create',
            'admin.hero-banners.edit' => 'hero-banners.edit',
            'admin.hero-banners.update' => 'hero-banners.edit',
            'admin.hero-banners.destroy' => 'hero-banners.delete',
            'admin.about.edit' => 'about.edit',
            'admin.about.update' => 'about.edit',
            'admin.why-choose-items.index' => 'why-choose.view',
            'admin.why-choose-items.create' => 'why-choose.create',
            'admin.why-choose-items.store' => 'why-choose.create',
            'admin.why-choose-items.edit' => 'why-choose.edit',
            'admin.why-choose-items.update' => 'why-choose.edit',
            'admin.why-choose-items.destroy' => 'why-choose.delete',
            'admin.career-openings.index' => 'career-openings.view',
            'admin.career-openings.create' => 'career-openings.create',
            'admin.career-openings.store' => 'career-openings.create',
            'admin.career-openings.edit' => 'career-openings.edit',
            'admin.career-openings.update' => 'career-openings.edit',
            'admin.career-openings.destroy' => 'career-openings.delete',
            'admin.career-applications.index' => 'careers.view',
            'admin.career-applications.show' => 'careers.view',
            'admin.career-applications.update-status' => 'careers.update',
            'admin.career-applications.destroy' => 'careers.delete',
            'admin.patient-reviews.index' => 'patient-reviews.view',
            'admin.patient-reviews.create' => 'patient-reviews.create',
            'admin.patient-reviews.store' => 'patient-reviews.create',
            'admin.patient-reviews.edit' => 'patient-reviews.edit',
            'admin.patient-reviews.update' => 'patient-reviews.edit',
            'admin.patient-reviews.destroy' => 'patient-reviews.delete',
            'admin.patient-reviews.settings.update' => 'patient-reviews.settings',
            'admin.video-feedbacks.index' => 'video-feedbacks.view',
            'admin.video-feedbacks.create' => 'video-feedbacks.create',
            'admin.video-feedbacks.store' => 'video-feedbacks.create',
            'admin.video-feedbacks.edit' => 'video-feedbacks.edit',
            'admin.video-feedbacks.update' => 'video-feedbacks.edit',
            'admin.video-feedbacks.destroy' => 'video-feedbacks.delete',
            'admin.gallery-items.index' => 'gallery.view',
            'admin.gallery-items.create' => 'gallery.create',
            'admin.gallery-items.store' => 'gallery.create',
            'admin.gallery-items.edit' => 'gallery.edit',
            'admin.gallery-items.update' => 'gallery.edit',
            'admin.gallery-items.destroy' => 'gallery.delete',
            'admin.blog-posts.index' => 'blog.view',
            'admin.blog-posts.create' => 'blog.create',
            'admin.blog-posts.store' => 'blog.create',
            'admin.blog-posts.edit' => 'blog.edit',
            'admin.blog-posts.update' => 'blog.edit',
            'admin.blog-posts.destroy' => 'blog.delete',
            'admin.faqs.index' => 'faqs.view',
            'admin.faqs.create' => 'faqs.create',
            'admin.faqs.store' => 'faqs.create',
            'admin.faqs.edit' => 'faqs.edit',
            'admin.faqs.update' => 'faqs.edit',
            'admin.faqs.destroy' => 'faqs.delete',
            'admin.faqs.settings.update' => 'faqs.settings',
            'admin.faqs.page-settings.update' => 'faqs.settings',
            'admin.legal-pages.edit' => 'legal-pages.edit',
            'admin.legal-pages.update' => 'legal-pages.edit',
            'admin.media.index' => 'media.view',
            'admin.media.browse' => 'media.view',
            'admin.media.store' => 'media.upload',
            'admin.media.update' => 'media.edit',
            'admin.media.destroy' => 'media.delete',
            'admin.media.download' => 'media.view',
            'admin.settings.general' => 'settings.general',
            'admin.settings.general.update' => 'settings.general',
            'admin.icons.index' => 'icons.view',
            'admin.icons.data' => 'icons.view',
            'admin.cache.clear' => 'cache.clear',
            'admin.staff.index' => 'staff.view',
            'admin.staff.create' => 'staff.create',
            'admin.staff.store' => 'staff.create',
            'admin.staff.edit' => 'staff.edit',
            'admin.staff.update' => 'staff.edit',
            'admin.staff.destroy' => 'staff.delete',
            'admin.roles.index' => 'roles.view',
            'admin.roles.create' => 'roles.create',
            'admin.roles.store' => 'roles.create',
            'admin.roles.edit' => 'roles.edit',
            'admin.roles.update' => 'roles.edit',
            'admin.roles.destroy' => 'roles.delete',
        ];

        return $map[$routeName] ?? null;
    }

    /**
     * Minimum permission needed to show a sidebar menu item.
     */
    public static function menuPermission(string $key): ?string
    {
        return match ($key) {
            'dashboard' => 'dashboard.view',
            'contacts' => 'contacts.view',
            'bookings' => 'bookings.view',
            'inquiries' => 'inquiries.view',
            'hotel-amenities' => 'hotel-amenities.view',
            'hotel-facilities' => 'hotel-facilities.view',
            'bed-types' => 'bed-types.view',
            'room-types' => 'room-types.view',
            'premium-services' => 'premium-services.view',
            'hero-banners' => 'hero-banners.view',
            'about' => 'about.edit',
            'why-choose' => 'why-choose.view',
            'career-openings' => 'career-openings.view',
            'careers' => 'careers.view',
            'patient-reviews' => 'patient-reviews.view',
            'video-feedbacks' => 'video-feedbacks.view',
            'gallery' => 'gallery.view',
            'blog' => 'blog.view',
            'faqs' => 'faqs.view',
            'legal-pages' => 'legal-pages.edit',
            'media' => 'media.view',
            'icons' => 'icons.view',
            'settings' => 'settings.general',
            'cache' => 'cache.clear',
            'staff' => 'staff.view',
            'roles' => 'roles.view',
            default => null,
        };
    }
}
