<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProjectControllerDestroyTest extends TestCase
{
    use RefreshDatabase;

    protected Permission $deletePermission;
    protected Role $adminRole;
    protected Role $userRole;

    protected function setUp(): void
    {
        parent::setUp();

        // Create permissions and roles
        $this->deletePermission = Permission::create(['name' => 'delete']);
        $this->adminRole = Role::create(['name' => 'admin']);
        $this->userRole = Role::create(['name' => 'user']);

        // Assign delete permission to admin role
        $this->adminRole->givePermissionTo($this->deletePermission);
    }

    public function test_user_without_delete_permission_cannot_delete_project(): void
    {
        // Create a user without delete permission
        $user = User::factory()->create();
        $user->assignRole($this->userRole);

        // Create a project
        $project = Project::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('projects.destroy', $project));

        $response->assertStatus(403);
        $response->assertSee('403 Forbidden');

        // Assert project still exists
        $this->assertDatabaseHas('projects', ['id' => $project->id]);
    }

    public function test_user_with_delete_permission_can_delete_project(): void
    {
        // Create a user with delete permission
        $user = User::factory()->create();
        $user->assignRole($this->adminRole);

        // Create a project
        $project = Project::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('projects.destroy', $project));

        $response->assertRedirect(route('projects.index'));

        // Assert project was deleted
        $this->assertSoftDeleted('projects', ['id' => $project->id]);
    }

    public function test_guest_cannot_delete_project(): void
    {
        // Create a project
        $project = Project::factory()->create();

        $response = $this->delete(route('projects.destroy', $project));

        $response->assertRedirect('/login');

        // Assert project still exists
        $this->assertDatabaseHas('projects', ['id' => $project->id]);
    }
}
