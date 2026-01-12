<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Services\TaskService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $taskService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->taskService = new TaskService();
    }

    public function test_it_can_store_a_task()
    {
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
        
        Storage::fake('public');
        $file = UploadedFile::fake()->image('task.jpg');
        
        $project = Project::find(1);

        $data = [
            'title' => 'New Task',
            'description' => 'Task Description',
            'image' => $file,
            'project_id' => [$project->id]
        ];

        $task = $this->taskService->store($data);

        $this->assertDatabaseHas('tasks', ['title' => 'New Task']);
        $this->assertTrue($task->projects->contains($project));
        Storage::disk('public')->assertExists($task->image);
    }

    public function test_it_can_update_a_task()
    {
        $this->seed(\Database\Seeders\DatabaseSeeder::class);

        $task = Task::find(1);
        $newProject = Project::find(2);

        $data = [
            'title' => 'Updated Title',
            'project_id' => [$newProject->id]
        ];

        $this->taskService->update($task, $data);

        $this->assertDatabaseHas('tasks', ['id' => 1, 'title' => 'Updated Title']);
        $this->assertTrue($task->fresh()->projects->contains($newProject));
    }

    public function test_it_can_delete_a_task()
    {
        $this->seed(\Database\Seeders\DatabaseSeeder::class);

        $task = Task::find(1);

        $this->taskService->delete($task);

        $this->assertDatabaseMissing('tasks', ['id' => 1]);
    }

    public function test_it_can_filter_tasks_by_title()
    {
        $this->seed(\Database\Seeders\DatabaseSeeder::class);

        $request = new Request(['search' => 'Concevoir']);

        $results = $this->taskService->getTasks($request);

        $this->assertCount(1, $results);
        $this->assertEquals('Concevoir la base de données', $results->first()->title);
    }
}
