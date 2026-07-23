<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\View\View;

/**
 * Handles the public gallery page.
 */
class GalleryController extends Controller
{
    /**
     * Display the gallery page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $galleryItems = GalleryItem::query()->activeOrdered()->get();
        $galleryVideos = $galleryItems->filter(fn (GalleryItem $item) => $item->isVideo())->values();
        $galleryPhotos = $galleryItems->reject(fn (GalleryItem $item) => $item->isVideo())->values();

        return view('gallery.index', compact('galleryVideos', 'galleryPhotos'));
    }
}
