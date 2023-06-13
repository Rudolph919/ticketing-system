<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'johndoe@tickets.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'janesmith@tickets.com',
                'password' => Hash::make('password'),
                'role' => 'support agent',
            ],
            [
                'name' => 'Johnny Cash',
                'email' => 'johnnycash@tickets.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ],
            [
                'name' => 'Admin User 1',
                'email' => 'admin1@tickets.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Support Agent 1',
                'email' => 'supportagent1@tickets.com',
                'password' => Hash::make('password'),
                'role' => 'support agent',
            ],
            [
                'name' => 'Customer 1',
                'email' => 'customer1@tickets.com',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ],

        ];

        foreach ($users as $user) {
            $role = $user['role'];
            unset($user['role']);
            $newUser = User::create($user);
            $newUser->assignRole($role);
        }
    }
}
