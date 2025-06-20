<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'delete']);

        // create roles and assign permissions
        Role::create(['name' => 'admin'])->givePermissionTo(['manage users', 'delete']);
        Role::create(['name' => 'user']);

        $admin = User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'Admin',
            'email' => 'admin@example.com',
        ]);
        $admin->assignRole('admin');

        $user = User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'user@example.com',
        ]);
        $user->assignRole('user');

        Client::factory()->count(50)->create();
        Project::factory()->count(100)->create();
        Task::factory()->count(200)->create();
    }
}
