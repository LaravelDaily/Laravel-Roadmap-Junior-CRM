<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UsersPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'delete']);

        Role::create(['name' => 'admin'])->givePermissionTo(['manage users', 'delete']);
        Role::create(['name' => 'user']);
    }

    public function test_user_with_admin_role_can_view_users_index_page(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'terms_accepted_at' => now()
        ]);

        $user->assignRole('admin');

        $response = $this->actingAs($user)->get('/users');

        $response->assertStatus(200);
    }

    public function test_user_with_user_role_cannot_view_users_index_page(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/users');

        $response->assertStatus(403);
    }
}
