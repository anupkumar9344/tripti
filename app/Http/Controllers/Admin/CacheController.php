<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;

/**
 * Clears application caches from the admin panel.
 */
class CacheController extends Controller
{
    /**
     * Clear Laravel caches (config, route, view, application).
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function clear(Request $request): RedirectResponse|Response
    {
        Artisan::call('optimize:clear');
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');

        $message = 'Application cache cleared successfully.';

        if ($request->expectsJson() || $request->query('format') === 'text') {
            return response($message, 200)->header('Content-Type', 'text/plain');
        }

        return redirect()
            ->to(url()->previous() !== url()->current() ? url()->previous() : route('admin.dashboard'))
            ->with('success', $message);
    }
}
