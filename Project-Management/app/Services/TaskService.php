<?php
namespace App\Services;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;  
class TaskService
{
    public function getTasks(array $filters)
    {
        return Task::query()
            ->when($filters['search'] ?? null, function($query, $search) {
<<<<<<< HEAD
                $query->where('title', 'like', "%{$search}%");
            })
            ->when($filters['project_id'] ?? null, function($query, $projectId) {
                $query->whereRelation('projects', 'id', $projectId);
            })
            ->with('projects')
            ->latest()
            ->paginate(10);  
=======
                $query->where('tasks.title', 'like', "%{$search}%");
            })
            ->when($filters['project_id'] ?? null, function($query, $projectId) {
                $query->whereHas('projects', function($q) use ($projectId) {
                    $q->where('projects.id', $projectId);
                });
            })
            ->with('projects')
            ->orderBy('tasks.created_at', 'desc')
            ->paginate(2);  
>>>>>>> gates
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
            'user_id'     => auth()->id() ?? \App\Models\User::first()?->id,
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
            'user_id'     => auth()->id() ?? \App\Models\User::first()?->id,
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