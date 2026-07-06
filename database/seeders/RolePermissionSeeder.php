<?php

namespace Database\Seeders;

use App\Models\User;
use App\Support\AdminPermissions;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

/**
 * Seeds admin roles and permissions.
 */
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (AdminPermissions::all() as $permission) {
            Permission::query()->firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $superAdmin = Role::query()->firstOrCreate([
            'name' => AdminPermissions::SUPER_ADMIN_ROLE,
            'guard_name' => 'web',
        ]);

        $superAdmin->syncPermissions(Permission::query()->pluck('name'));

        $admin = User::query()->where('email', 'admin@triptihotel.com')->first();

        if ($admin) {
            $admin->syncRoles([AdminPermissions::SUPER_ADMIN_ROLE]);
        }
    }
}
