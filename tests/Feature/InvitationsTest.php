<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Facades\Tests\Setup\ProjectFactory;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_invite_a_user() {
        $project = ProjectFactory::create();

        $project->invite($newUser = factory(User::class)->create());

        $this->signIn($newUser);
        $this->post(action('ProjectTasksController@store', $project), $task = [
            'body' => 'Foo task'
        ]);

        $this->assertDatabaseHas('tasks', $task);
    }
}
