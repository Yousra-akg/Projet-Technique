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
    ) {
        $this->middleware('auth');
    }
    
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
        $this->authorize('create-task');

        $data = $request->validated();
        $data['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image');
        }

        $task = $this->taskService->store($data);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Tâche créée avec succès',
                'task' => $task
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function edit(Task $task)
    {
        $this->authorize('manage-task', $task);
        
        return response()->json([
            'task' => $task,
            'project_ids' => $task->projects->pluck('id')
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('manage-task', $task);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image');
        }

        $updatedTask = $this->taskService->update($task, $data);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Tâche mise à jour avec succès',
                'task' => $updatedTask
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(Request $request, Task $task)
    {
        $this->authorize('manage-task', $task);
        $this->taskService->delete($task);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Tâche supprimée avec succès',
            ]);
        }

        return response()->json(['success' => true]);
    }
}
