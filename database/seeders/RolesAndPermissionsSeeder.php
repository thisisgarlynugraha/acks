<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $Administrator = Role::create(['name' => 'administrator', 'guard_name' => 'web']);
        $Student = Role::create(['name' => 'student', 'guard_name' => 'web']);
    }
}
