<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Services\ProjectService;
use App\Services\TaskService;
=======
use App\Models\Task;
use App\Services\ProjectService;
use App\Services\TaskService;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
>>>>>>> gates
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        private TaskService $taskService,
<<<<<<< HEAD
        private ProjectService $projectService )
    {}
    
    public function index(Request $request){
        $tasks = $this->taskService->getTasks($request->all());
        $projects =$this->projectService->getAll();

        if($request->ajax()){
            return view('tasks.table', compact('tasks'))->render();
        };
=======
        private ProjectService $projectService 
    ) {}
    
    public function index(Request $request)
    {
        $tasks = $this->taskService->getTasks($request->all());
        $projects = $this->projectService->getAll();

        if ($request->ajax()) {
            return view('admin.table', compact('tasks'))->render();
        }
>>>>>>> gates

        return view('admin.index', compact('tasks', 'projects'));
    }

<<<<<<< HEAD
    public function store(Request $request){
        $this->taskService->store($request->all());
        return response()->json([
            "success"=>true,
            "message"=>__('tasksview.success_message')
        ]);
=======
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
>>>>>>> gates
    }
}
