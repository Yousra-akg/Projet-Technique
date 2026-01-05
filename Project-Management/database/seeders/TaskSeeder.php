<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;

class TaskSeeder extends Seeder {
    public function run() {
        $users = User::all();
        $projects = Project::all();

        \App\Models\Task::factory()->count(10)->make()->each(function($task) use ($users, $projects) {
            $task->user_id = $users->random()->id;
            $task->save();

            // assigner aléatoirement 1 ou plusieurs projets
            $task->projects()->attach($projects->random(rand(1,3))->pluck('id')->toArray());
        });
    }
}
