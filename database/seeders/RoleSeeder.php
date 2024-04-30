<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::truncate();
        // Seed roles with permissions
        Role::create([
            'name' => 'admin',
            'permissions' => ['create_user', 'read_user', 'update_user', 'delete_user', 'create_product', 'read_product', 'update_product', 'delete_product'],
        ]);

        Role::create([
            'name' => 'manager',
            'permissions' => ['create_product', 'read_product', 'update_product', 'delete_product'],
        ]);

        Role::create([
            'name' => 'user',
            'permissions' => ['read_product'],
        ]);
    }
}
