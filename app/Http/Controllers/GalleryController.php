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
        $galleryItems = GalleryItem::query()
            ->where('status', true)
            ->orderByRaw("CASE WHEN type = 'video' THEN 1 ELSE 0 END")
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('gallery.index', compact('galleryItems'));
    }
}
