<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure Roles exist first
        $roles = ['Super Admin', 'Admin', 'Editor', 'User'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // 2. Define users
        $users = [
            [
                'email' => 'superadmin@example.com',
                'name' => 'Emoyo Super-Admin',
                'phone_number' => '0727464225',
                'role' => 'Super Admin'
            ],
            [
                'email' => 'admin@example.com',
                'name' => 'Admin User',
                'phone_number' => '0727464225',
                'role' => 'Admin'
            ],
            // ... add others
        ];

        // 3. Create and Assign
        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'phone_number' => $userData['phone_number'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
            
            $user->assignRole($userData['role']);
        }
    }
}