<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Project;

class ProjectTaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = Task::all();
        foreach ($tasks as $task) {
            if ($task->projet) {
                // Split by " | " as seen in the CSV
                $projectNames = explode('|', $task->projet);
                
                foreach ($projectNames as $name) {
                    $project = Project::where('title', trim($name))->first();
                    if ($project) {
                        // Check if not already attached to avoid duplicates if run multiple times (though migrate:refresh clears info)
                        if (!$task->projects()->where('project_id', $project->id)->exists()) {
                            $task->projects()->attach($project->id);
                        }
                    }
                }
            }
        }
    }
}
