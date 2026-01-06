<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Storage;

class TaskService
{
    public function getTasks($request)
    {
        $query = Task::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('project_id')) {
            $query->whereHas('projects', function ($q) use ($request) {
                $q->where('projects.id', $request->project_id);
            });
        }

        return $query->with(['user', 'projects'])->paginate(5);
    }

    public function store(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('tasks', 'public');
        }

        $task = Task::create([
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'image'       => $data['image'] ?? null,
            'user_id'     => auth()->id(),
        ]);

        if (isset($data['project_id'])) {
            $task->projects()->attach($data['project_id']);
        }

        return $task;
    }

    
    public function update(Task $task, array $data)
    {
        if (isset($data['image'])) {
            if ($task->image) {
                Storage::disk('public')->delete($task->image);
            }
            $data['image'] = $data['image']->store('tasks', 'public');
        }

        $task->update([
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'image'       => $data['image'] ?? $task->image,
        ]);

        if (isset($data['project_id'])) {
            $task->projects()->sync($data['project_id']);
        }

        return $task;
    }

  
    public function delete(Task $task)
    {
        if ($task->image) {
            Storage::disk('public')->delete($task->image);
        }

        $task->projects()->detach();
        $task->delete();
    }
}
