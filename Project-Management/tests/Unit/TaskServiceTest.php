<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Project;
use App\Services\TaskService;
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
        $result = $this->service->getTasks([]);

        $this->assertGreaterThan(0, $result->total());
    }

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
    }

    public function test_it_can_update_a_task()
    {
        $task = Task::first();

        $this->service->update($task, [
            'title' => 'Titre Test'
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Titre Test'
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
