<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::firstOrCreate(['name' => 'view applications', 'guard_name' => 'web']); //arizalarni ko'rish
        Permission::firstOrCreate(['name' => 'application details', 'guard_name' => 'web']); //ariza detallari
        Permission::firstOrCreate(['name' => 'application status', 'guard_name' => 'web']); //ariza statusini o'zgartirish

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $manager = Role::firstOrCreate(['name' => 'manager', 'guard_name' => 'web']);

        $admin->givePermissionTo([
            'view applications',
            'application details',
            'application status',
        ]);

        $manager->givePermissionTo([
            'application status'
        ]);
    }
}
