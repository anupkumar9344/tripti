<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

/**
 * Handles the admin Font Awesome icon reference page.
 */
class IconReferenceController extends Controller
{
    /**
     * Display the searchable icon reference browser.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.icons.index', [
            'iconCount' => count($this->solidIcons()),
        ]);
    }

    /**
     * Return the solid icon class list for the browser UI.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function icons(): JsonResponse
    {
        return response()->json([
            'icons' => $this->solidIcons(),
        ]);
    }

    /**
     * Load the cached Font Awesome solid icon names.
     *
     * @return array<int, string>
     */
    private function solidIcons(): array
    {
        $path = public_path('admin/assets/data/fontawesome-solid-icons.json');

        if (! File::exists($path)) {
            return [];
        }

        $icons = json_decode(File::get($path), true);

        return is_array($icons) ? $icons : [];
    }
}
