<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@local.test',
            'password' => '$2y$10$Xy6OezcoT0pOXDw9QSDjEu1RXQWnZlZXdJLgcJY0E665zO.nyTS8G',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@local.test',
            'password' => '$2y$10$Xy6OezcoT0pOXDw9QSDjEu1RXQWnZlZXdJLgcJY0E665zO.nyTS8G',
        ]);
        
        \App\Models\User::factory()->create([
            'name' => 'Web Developer',
            'email' => 'webdev@local.test',
            'password' => '$2y$10$Xy6OezcoT0pOXDw9QSDjEu1RXQWnZlZXdJLgcJY0E665zO.nyTS8G',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Web Designer',
            'email' => 'webdesigner@local.test',
            'password' => '$2y$10$Xy6OezcoT0pOXDw9QSDjEu1RXQWnZlZXdJLgcJY0E665zO.nyTS8G',
        ]);

        Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'Manager',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'Web Developer',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'Web Designer',
            'guard_name' => 'web',
        ]);

        Permission::create([
            'name' => 'Insert User',
            'guard_name' => 'web',
        ]);

        Permission::create([
            'name' => 'Delete User',
            'guard_name' => 'web',
        ]);

        Permission::create([
            'name' => 'Update User',
            'guard_name' => 'web',
        ]);

        foreach (Role::all() as $role)
        {
            $role->givePermissionTo(Permission::all());
        }

        \App\Models\User::find(1)->assignRole('Super Admin');
        \App\Models\User::find(2)->assignRole('Manager');
        \App\Models\User::find(3)->assignRole('Web Developer');
        \App\Models\User::find(4)->assignRole('Web Designer');

    }
}
