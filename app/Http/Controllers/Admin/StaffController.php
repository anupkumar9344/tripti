<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\AdminPermissions;
use App\Support\MediaPath;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

/**
 * Handles admin CRUD for staff accounts.
 */
class StaffController extends Controller
{
    /**
     * Display all staff accounts.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $staffMembers = User::query()
            ->where('is_admin', true)
            ->with('roles')
            ->orderBy('name')
            ->get();

        return view('admin.staff.index', compact('staffMembers'));
    }

    /**
     * Show the form to create a staff member.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        $roles = $this->assignableRoles();

        return view('admin.staff.create', compact('roles'));
    }

    /**
     * Store a newly created staff member.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateStaff($request);

        $staff = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'image' => MediaPath::normalize($validated['image'] ?? null),
            'is_admin' => true,
            'status' => (bool) $validated['status'],
        ]);

        $staff->syncRoles([$validated['role']]);

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Staff member created successfully.');
    }

    /**
     * Show the form to edit a staff member.
     *
     * @return \Illuminate\View\View
     */
    public function edit(User $staff): View
    {
        abort_unless($staff->is_admin, 404);

        $roles = $this->assignableRoles();

        return view('admin.staff.edit', compact('staff', 'roles'));
    }

    /**
     * Update the given staff member.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $staff): RedirectResponse
    {
        abort_unless($staff->is_admin, 404);

        $validated = $this->validateStaff($request, $staff);

        $staff->name = $validated['name'];
        $staff->email = $validated['email'];
        $staff->status = (bool) $validated['status'];
        $staff->image = MediaPath::normalize($validated['image'] ?? null);

        if (! empty($validated['password'])) {
            $staff->password = Hash::make($validated['password']);
        }

        $staff->save();

        if ($staff->isSuperAdmin() && $validated['role'] !== AdminPermissions::SUPER_ADMIN_ROLE) {
            return back()
                ->withInput()
                ->withErrors(['role' => 'The Super Admin role cannot be changed.']);
        }

        $staff->syncRoles([$validated['role']]);

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Staff member updated successfully.');
    }

    /**
     * Delete a staff member.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $staff): RedirectResponse
    {
        abort_unless($staff->is_admin, 404);

        if ($staff->id === Auth::id()) {
            return back()->withErrors(['staff' => 'You cannot delete your own account.']);
        }

        if ($staff->isSuperAdmin()) {
            return back()->withErrors(['staff' => 'The Super Admin account cannot be deleted.']);
        }

        $staff->delete();

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Staff member deleted successfully.');
    }

    /**
     * Validate staff form input.
     *
     * @return array<string, mixed>
     */
    private function validateStaff(Request $request, ?User $staff = null): array
    {
        $roleNames = $this->assignableRoles()->pluck('name')->all();

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($staff?->id),
            ],
            'password' => [$staff ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', Rule::in($roleNames)],
            'status' => ['required', 'boolean'],
            'image' => ['nullable', 'string', 'max:500'],
        ]);
    }

    /**
     * Get roles available for staff assignment.
     *
     * @return \Illuminate\Support\Collection<int, \Spatie\Permission\Models\Role>
     */
    private function assignableRoles()
    {
        return Role::query()->orderBy('name')->get();
    }
}
