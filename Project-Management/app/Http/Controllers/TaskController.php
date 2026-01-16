<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        private TaskService $taskService,
        private ProjectService $projectService )
    {}
    
    public function index(Request $request){
        $tasks = $this->taskService->getTasks($request);
        $projects =$this->projectService->getAll();

        if($request->ajax()){
            return view('tasks.table', compact('tasks'))->render();
        };

        return view('tasks.index', compact('tasks', 'projects'));
    }

    public function store(Request $request){
        $this->taskService->store($request->all());
        return response()->json([
            "success"=>true,
            "message"=>__('tasksview.success_message')
        ]);
    }
}
