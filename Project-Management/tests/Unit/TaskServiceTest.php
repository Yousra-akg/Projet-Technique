<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Project;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskServiceTest extends TestCase
{
    use RefreshDatabase;

    protected TaskService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new TaskService();
    }

    public function test_it_can_get_all_tasks()
    {
        // Arrange
        Task::factory()->count(5)->create();

        // Act
        $result = $this->service->getTasks([]);

        // Assert
        $this->assertEquals(5, $result->total());
    }

    public function test_it_can_filter_tasks_by_project()
    {
        // Arrange
        $project = Project::factory()->create();
        $task = Task::factory()->create();
        $task->projects()->attach($project);

        // Act
        $result = $this->service->getTasks([
            'project_id' => $project->id
        ]);

        // Assert
        $this->assertEquals(1, $result->total());
        $this->assertEquals($task->id, $result->first()->id);
    }

    public function test_it_can_update_a_task()
    {
        // Arrange
        $task = Task::factory()->create(['title' => 'Original Title']);

        // Act
        $this->service->update($task, [
            'title' => 'Titre Test Updated'
        ]);

        // Assert
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Titre Test Updated'
        ]);
    }

    public function test_it_can_delete_a_task()
    {
        // Arrange
        $task = Task::factory()->create();

        // Act
        $this->service->delete($task);

        // Assert
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id
        ]);
    }
}
