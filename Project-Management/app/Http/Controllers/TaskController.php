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

    // 📄 Liste + Recherche + Filtre
    public function index(Request $request)
    {
        $tasks = $this->taskService->getTasks($request);
        $projects = $this->projectService->getAll();

        return view('tasks.index', compact('tasks', 'projects'));
    }

    // ➕ Ajouter tâche
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image',
            'project_id' => 'required'
        ]);

        $this->taskService->store($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tâche ajoutée');
    }

    // ✏️ Modifier tâche
    public function update(Request $request, Task $task)
    {
        $this->taskService->update($task, $request->all());

        return redirect()->back()->with('success', 'Tâche modifiée');
    }

    // 🗑️ Supprimer tâche
    public function destroy(Task $task)
    {
        $this->taskService->delete($task);

        return redirect()->back()->with('success', 'Tâche supprimée');
    }
}
