<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class PublicTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('projects')->latest()->get();
        return view('public.index', compact('tasks'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('public.show', compact('task'));
    }
}
