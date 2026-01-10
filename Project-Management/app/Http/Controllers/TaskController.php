<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        private TaskService $taskService,
        private ProjectService $projectService
    ) {}

    public function index(Request $request)
    {
        $tasks = $this->taskService->getTasks($request);
        $projects = $this->projectService->getAll();  
        
        if ($request->ajax()) {
            return view('tasks.partials.tasks-tbody', compact('tasks'))->render();
        }

        return view('tasks.index', compact('tasks', 'projects'));
    }

    public function show(Task $task, Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json($task->load('projects'));
        }
        return redirect()->route('tasks.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image',
            'project_id' => 'required'
        ]);

        $task = $this->taskService->store($request->all());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'task' => $task->load('projects')
            ]);
        }

        return redirect()->route('tasks.index')->with('success', 'Tâche ajoutée');
    }

    public function update(Request $request, Task $task)
    {
        // For PUT/PATCH requests with FormData including files, Laravel handles method spoofing but data comes in as normal request
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image',
            'project_id' => 'required'
        ]);

        $this->taskService->update($task, $request->all());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Tâche modifiée'
            ]);
        }

        return redirect()->back()->with('success', 'Tâche modifiée');
    }

    public function destroy(Task $task, Request $request)
    {
        $this->taskService->delete($task);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Tâche supprimée'
            ]);
        }

        return redirect()->back()->with('success', 'Tâche supprimée');
    }
}
