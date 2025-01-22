<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;
class RoleSeeder extends Seeder

{
    public function run()
    {
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Employee'],
            ['name' => 'Employee-Delivery'],
            ['name' => 'Customer'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}