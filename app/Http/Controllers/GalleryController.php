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

        return view('gallery.index', compact('galleryItems'));
    }
}
