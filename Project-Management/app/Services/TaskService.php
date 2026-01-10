<?php
namespace App\Services;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;  
class TaskService
{
    public function getTasks(Request $request)
{
    return Task::query()
        ->when($request->search, function($query, $search) {
            $query->where('title', 'like', "{$search}%");
        })
        ->when($request->project_id, function($query, $projectId) {
            $query->whereHas('projects', function($q) use ($projectId) {
                $q->where('projects.id', $projectId);
            });
        })
        ->with('projects')
        ->latest()
        ->paginate(10);  
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
            'user_id'     => 1,
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
