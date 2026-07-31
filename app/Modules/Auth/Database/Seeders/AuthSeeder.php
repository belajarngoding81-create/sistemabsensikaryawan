<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Models\Permission;
use Modules\Auth\Models\Role;
use Modules\Auth\Models\User;

class AuthSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $admin = Role::firstOrCreate(['slug' => 'admin'], ['name' => 'Admin']);
        $approver = Role::firstOrCreate(['slug' => 'approver'], ['name' => 'Approver']);
        $karyawan = Role::firstOrCreate(['slug' => 'karyawan'], ['name' => 'Karyawan']);

        // Optionally create default permissions (empty for now)
        Permission::firstOrCreate(['slug' => 'manage-users'], ['name' => 'Manage Users']);

        // Create or update initial admin user
        $user = User::updateOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'name' => 'Super Admin',
            'password' => Hash::make('12345678'),
        ]);

        // Attach admin role if not already attached
        if (! $user->roles()->where('role_id', $admin->id)->exists()) {
            $user->roles()->attach($admin->id);
        }
    }
}
