<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Call PermissionSeeder to create permissions and roles
        $this->call(PermissionSeeder::class);

        // 2. Create Super Admin user
        $admin = User::firstOrCreate(
            ['email' => 'etenesh4good@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password')
            ]
        );
        $admin->assignRole('Super Admin');

        // 3. Create Employee user
        $employee = User::firstOrCreate(
            ['email' => 'addisetujeg@gmail.com'],
            [
                'name' => 'Employee User',
                'password' => Hash::make('password')
            ]
        );
        $employee->assignRole('Employee');

        // 4. Optionally create more users to reach a total of 5
        // if (User::count() < 5) {
        //     User::factory(5 - User::count())->create();
        // }
    }
}
