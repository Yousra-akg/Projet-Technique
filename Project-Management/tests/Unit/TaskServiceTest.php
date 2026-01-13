<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Project;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskServiceTest extends TestCase
{
    use DatabaseTransactions;

    protected TaskService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new TaskService();
    }

    public function test_it_can_get_all_tasks()
    {
        $request = new Request();
        $result = $this->service->getTasks($request);

        $this->assertGreaterThan(0, $result->total());
    }

    public function test_it_can_filter_tasks_by_title()
    {
        // "Concevoir" exists in the CSV data
        $request = new Request([
            'search' => 'Concevoir'
        ]);

        $result = $this->service->getTasks($request);

        // Should find "Concevoir la base de données"
        $this->assertEquals(1, $result->total());
    }

    public function test_it_can_filter_tasks_by_project()
    {
        // "Application Web Gestion de Projet" exists in CSV
        $project = Project::where('title', 'Application Web Gestion de Projet')->first();

        $request = new Request([
            'project_id' => $project->id
        ]);

        $result = $this->service->getTasks($request);

        $this->assertGreaterThan(0, $result->total());
    }

    public function test_it_can_update_a_task()
    {
        $task = Task::first();

        $this->service->update($task, [
            'title' => 'Titre Test Updated'
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Titre Test Updated'
        ]);
    }

    public function test_it_can_delete_a_task()
    {
        $task = Task::first();

        $this->service->delete($task);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id
        ]);
    }
}
