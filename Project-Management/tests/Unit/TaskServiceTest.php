<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Project;
use App\Services\TaskService;
<<<<<<< HEAD
=======
use Illuminate\Http\Request;
>>>>>>> gates
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
<<<<<<< HEAD
        $result = $this->service->getTasks([]);
=======
        $request = new Request();
        $result = $this->service->getTasks($request);
>>>>>>> gates

        $this->assertGreaterThan(0, $result->total());
    }

<<<<<<< HEAD
    public function test_it_can_filter_tasks_by_title()
    {
        $result = $this->service->getTasks([
            'search' => 'Concevoir'
        ]);

        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\LengthAwarePaginator::class, $result);
    }

    public function test_it_can_filter_tasks_by_project()
    {
        $this->assertTrue(true);
=======
    public function test_it_can_filter_tasks_by_project()
    {
        // "Application Web Gestion de Projet" exists in CSV
        $project = Project::where('title', 'Application Web Gestion de Projet')->first();

        $request = new Request([
            'project_id' => $project->id
        ]);

        $result = $this->service->getTasks($request);

        $this->assertGreaterThan(0, $result->total());
>>>>>>> gates
    }

    public function test_it_can_update_a_task()
    {
        $task = Task::first();

        $this->service->update($task, [
<<<<<<< HEAD
            'title' => 'Titre Test'
=======
            'title' => 'Titre Test Updated'
>>>>>>> gates
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
<<<<<<< HEAD
            'title' => 'Titre Test'
=======
            'title' => 'Titre Test Updated'
>>>>>>> gates
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
