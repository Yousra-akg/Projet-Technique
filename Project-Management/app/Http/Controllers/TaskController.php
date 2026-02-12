<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\ProjectService;
use App\Services\TaskService;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        private TaskService $taskService,
        private ProjectService $projectService 
    ) {}
    
    public function index(Request $request)
    {
        $tasks = $this->taskService->getTasks($request->all());
        $projects = $this->projectService->getAll();

        if ($request->ajax()) {
            return view('admin.table', compact('tasks'))->render();
        }

        return view('admin.index', compact('tasks', 'projects'));
    }

    public function store(StoreTaskRequest $request)
    {
        \Illuminate\Support\Facades\Gate::authorize('manage-tasks');
        $this->taskService->store($request->validated());
        return response()->json(['success' => true]);
    }

    public function edit(Task $task)
    {
        \Illuminate\Support\Facades\Gate::authorize('manage-tasks');
        return response()->json([
            'task' => $task,
            'project_ids' => $task->projects->pluck('id')
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        \Illuminate\Support\Facades\Gate::authorize('manage-tasks');
        $this->taskService->update($task, $request->validated());
        return response()->json(['success' => true]);
    }

    public function destroy(Task $task)
    {
        \Illuminate\Support\Facades\Gate::authorize('delete-task');
        $this->taskService->delete($task);
        return response()->json(['success' => true]);
    }
}
