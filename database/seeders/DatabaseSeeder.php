<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
         DB::table('users')->insert([
            [
                'name' => 'Admin 1',
                'email' => 'admin1@rri.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => null,
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
               [
                'name' => 'Admin 2',
                'email' => 'admin2@rri.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => null,
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
               [
                'name' => 'Admin 3',
                'email' => 'admin3@rri.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => null,
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
          
             [
        'name' => 'Saiful',
        'email' => 'saiful@rri.com',
        'email_verified_at' => null,
        'password' => Hash::make('password'),
        'remember_token' => null,
        'role' => 'user',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Holis',
        'email' => 'holis@rri.com',
        'email_verified_at' => null,
        'password' => Hash::make('password'),
        'remember_token' => null,
        'role' => 'user',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Ichal',
        'email' => 'ichal@rri.com',
        'email_verified_at' => null,
        'password' => Hash::make('password'),
        'remember_token' => null,
        'role' => 'user',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Imam',
        'email' => 'imam@rri.com',
        'email_verified_at' => null,
        'password' => Hash::make('password'),
        'remember_token' => null,
        'role' => 'user',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Latif',
        'email' => 'latif@rri.com',
        'email_verified_at' => null,
        'password' => Hash::make('password'),
        'remember_token' => null,
        'role' => 'user',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Ridwan',
        'email' => 'ridwan@rri.com',
        'email_verified_at' => null,
        'password' => Hash::make('password'),
        'remember_token' => null,
        'role' => 'user',
        'created_at' => now(),
        'updated_at' => now(),
    ],

     [
        'name' => 'Indah',
        'email' => 'indah@rri.com',
        'email_verified_at' => null,
        'password' => Hash::make('password'),
        'remember_token' => null,
        'role' => 'user',
        'created_at' => now(),
        'updated_at' => now(),
    ],
        ]);
    }
    
}
