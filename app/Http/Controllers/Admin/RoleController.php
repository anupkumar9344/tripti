<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\AdminPermissions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

/**
 * Handles admin CRUD for staff roles and permissions.
 */
class RoleController extends Controller
{
    /**
     * Display all roles.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $roles = Role::query()
            ->withCount('permissions', 'users')
            ->orderBy('name')
            ->get();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form to create a role.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.roles.create', [
            'permissionSections' => AdminPermissions::sections(),
            'selectedPermissions' => old('permissions', []),
        ]);
    }

    /**
     * Store a newly created role.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRole($request);

        $role = Role::query()->create([
            'name' => $validated['name'],
            'guard_name' => 'web',
        ]);

        $role->syncPermissions($validated['permissions'] ?? []);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Show the form to edit a role.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Role $role): View
    {
        return view('admin.roles.edit', [
            'role' => $role,
            'permissionSections' => AdminPermissions::sections(),
            'selectedPermissions' => old('permissions', $role->permissions->pluck('name')->all()),
            'isProtected' => $role->name === AdminPermissions::SUPER_ADMIN_ROLE,
        ]);
    }

    /**
     * Update the given role.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        if ($role->name === AdminPermissions::SUPER_ADMIN_ROLE) {
            return back()->withErrors(['role' => 'The Super Admin role cannot be modified.']);
        }

        $validated = $this->validateRole($request, $role);

        $role->name = $validated['name'];
        $role->save();
        $role->syncPermissions($validated['permissions'] ?? []);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Delete a role.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role): RedirectResponse
    {
        if ($role->name === AdminPermissions::SUPER_ADMIN_ROLE) {
            return back()->withErrors(['role' => 'The Super Admin role cannot be deleted.']);
        }

        if ($role->users()->exists()) {
            return back()->withErrors(['role' => 'Remove staff from this role before deleting it.']);
        }

        $role->delete();

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role deleted successfully.');
    }

    /**
     * Validate role form input.
     *
     * @return array<string, mixed>
     */
    private function validateRole(Request $request, ?Role $role = null): array
    {
        $allowedPermissions = AdminPermissions::all();

        return $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('roles', 'name')->ignore($role?->id),
            ],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string', Rule::in($allowedPermissions)],
        ]);
    }
}
