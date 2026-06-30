<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\MediaPath;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

/**
 * Handles admin profile and password updates.
 */
class ProfileController extends Controller
{
    /**
     * Show the admin profile settings page.
     *
     * @return \Illuminate\View\View
     */
    public function edit(): View
    {
        return view('admin.profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the logged-in admin's profile details.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'image' => ['nullable', 'file', 'image', 'max:2048'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->hasFile('image')) {
            $this->deleteProfileImage($user->image);
            $user->image = $this->storeProfileImage($request->file('image'));
        }

        $user->save();

        return redirect()
            ->route('admin.profile.edit')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Update the logged-in admin's password.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('admin.profile.edit')
            ->with('success', 'Password changed successfully.');
    }

    /**
     * Store a profile image in the public media directory.
     */
    private function storeProfileImage(UploadedFile $file): string
    {
        $extension = strtolower($file->getClientOriginalExtension() ?: $file->guessExtension() ?: 'jpg');
        $directory = 'media-management/users/'.now()->format('Y/m');
        $absoluteDirectory = public_path($directory);

        if (! File::isDirectory($absoluteDirectory)) {
            File::makeDirectory($absoluteDirectory, 0755, true);
        }

        $storedName = Str::uuid()->toString().'.'.$extension;
        $file->move($absoluteDirectory, $storedName);

        return $directory.'/'.$storedName;
    }

    /**
     * Remove a previously stored profile image from disk.
     */
    private function deleteProfileImage(?string $path): void
    {
        if (! filled($path)) {
            return;
        }

        if (str_starts_with($path, 'media-management/')) {
            $absolutePath = public_path($path);

            if (File::exists($absolutePath)) {
                File::delete($absolutePath);
            }

            return;
        }

        MediaPath::deleteLegacyFile($path);
    }
}
