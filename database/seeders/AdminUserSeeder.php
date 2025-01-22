<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch the ID of the Admin role
        $adminRole = Role::where('name', 'Admin')->first();

        // Create the admin user
        User::create([
            'name' => 'Sara Shums',
            'email' => 'admin@Zaytun.com', // Replace with your desired admin email
            'password' => Hash::make('AdminZaytun'), // Replace with your desired admin password
            
            'phone_number' => '1234567890',
            'address' => '108, Panadura',
            'RoleID' => $adminRole->id, // Set the RoleID to the ID of the Admin role
        ]);
    }
}
