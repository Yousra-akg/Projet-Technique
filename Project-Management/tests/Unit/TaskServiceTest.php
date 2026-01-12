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
        Storage::fake('public');
        $file = UploadedFile::fake()->image('task.jpg');
        $project = Project::create(['title' => 'Test Project']);

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
        $task = Task::create([
            'title' => 'Old Title', 
            'user_id' => 1
        ]);
        $newProject = Project::create(['title' => 'New Project']);

        $data = [
            'title' => 'Updated Title',
            'project_id' => [$newProject->id]
        ];

        $this->taskService->update($task, $data);

        $this->assertDatabaseHas('tasks', ['title' => 'Updated Title']);
        $this->assertTrue($task->fresh()->projects->contains($newProject));
    }

    public function test_it_can_delete_a_task()
    {
        $task = Task::create(['title' => 'To Delete', 'user_id' => 1]);

        $this->taskService->delete($task);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_it_can_filter_tasks_by_title()
    {
        Task::create(['title' => 'Apple Task', 'user_id' => 1]);
        Task::create(['title' => 'Banana Task', 'user_id' => 1]);

        $request = new Request(['search' => 'Apple']);

        $results = $this->taskService->getTasks($request);

        $this->assertCount(1, $results);
        $this->assertEquals('Apple Task', $results->first()->title);
    }
}
