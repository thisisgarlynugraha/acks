<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'Dashboard',
            'Student - Read',
            'Student - Create',
            'Student - Update',
            'Student - Delete',
            'Student Photo - Read',
            'Student Photo - Create',
            'Student Photo - Delete',
            'Attendance - Read',
            'Attendance - Detail',
            'Health Monitoring - Read',
            'Health Monitoring - Detail',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $Administrator = Role::create(['name' => 'administrator', 'guard_name' => 'web']);
        $Administrator->givePermissionTo('Student - Read');
        $Administrator->givePermissionTo('Student - Create');
        $Administrator->givePermissionTo('Student - Update');
        $Administrator->givePermissionTo('Student - Delete');
        $Administrator->givePermissionTo('Student Photo - Read');
        $Administrator->givePermissionTo('Student Photo - Create');
        $Administrator->givePermissionTo('Student Photo - Delete');
        $Administrator->givePermissionTo('Attendance - Read');
        $Administrator->givePermissionTo('Attendance - Detail');
        $Administrator->givePermissionTo('Health Monitoring - Read');
        $Administrator->givePermissionTo('Health Monitoring - Detail');

        $Student = Role::create(['name' => 'student', 'guard_name' => 'web']);
        $Student->givePermissionTo('Attendance - Detail');
        $Student->givePermissionTo('Health Monitoring - Detail');

    }
}
