<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create roles safely with 'web' guard
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $healthWorker = Role::firstOrCreate(['name' => 'health_worker', 'guard_name' => 'web']);
        $mother = Role::firstOrCreate(['name' => 'mother', 'guard_name' => 'web']);

        // Create permissions safely with 'web' guard
        $permissions = [
            'send_sms',
            'create_tip',
            'view_tip',
            'manage_users',
            'create_maternal_record',
            'create_child_record',
            'upload_ultrasound',
            'refer_patient',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // Assign permissions to roles
        $admin->syncPermissions(Permission::all()); // Admin has all permissions
        $healthWorker->syncPermissions([
            'create_maternal_record',
            'create_child_record',
            'upload_ultrasound',
            'refer_patient',
            'create_tip',
            'view_tip',
            'send_sms',
        ]);
        $mother->syncPermissions([
            'view_tip',
            'create_maternal_record',
            'create_child_record',
        ]);
    }
}
