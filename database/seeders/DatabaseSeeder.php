<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Super Admin',
            'username' => env('ADMIN_USERNAME'),
            'is_reset_password' => false,
            'password_reset' => env('ADMIN_RESET_PASSWORD'),
            'role' => 'superAdmin',
            'password' => bcrypt(env('ADMIN_PASSWORD'))
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
