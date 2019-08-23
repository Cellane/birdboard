<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Project;
use App\Task;
use Facades\Tests\Setup\ProjectFactory;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_tasks_to_projects()
    {
        $project = factory(Project::class)->create();

        $this->post($project->path() . '/tasks')
            ->assertRedirect('login');
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();

        $project = factory(Project::class)->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test task'])
            ->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_update_a_task()
    {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();

        $this->patch($project->tasks->first()->path(), ['body' => 'Changed task'])
            ->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'Changed task']);
    }

    /** @test */
    public function a_project_can_have_tasks()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', ['body' => 'Test task']);

        $this->get($project->path())
            ->assertSee('Test task');
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $project = ProjectFactory::withTasks(1)
            ->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
                'body' => 'Changed task',
                'completed' => true
            ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'Changed task',
            'completed' => true
        ]);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $project = ProjectFactory::create();
        $attributes = factory(Task::class)->raw(['body' => '']);

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
