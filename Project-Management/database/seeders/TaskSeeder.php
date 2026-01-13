<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('seeders/data/tasks.csv');
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        $rows = array_map('str_getcsv', $lines);
        
        $header = array_shift($rows);
        
        $header[0] = preg_replace('/^[\xEF\xBB\xBF]+/', '', $header[0]);

        foreach ($rows as $row) {
            if (count($row) !== count($header)) {
                continue;
            }

            $data = array_combine($header, $row);

            $task = Task::create([
                'title'       => $data['title'],
                'description' => $data['description'] ?? null,
                'image'       => $data['image'] ?? null,
                'user_id'     => $data['user_id'],
                'created_at'  => $data['created_at'],
                'updated_at'  => $data['updated_at'],
            ]);

            if (!empty($data['projet'])) {
                $projectTitles = explode(' | ', $data['projet']);
                $projectIds = Project::whereIn('title', $projectTitles)->pluck('id');
                $task->projects()->attach($projectIds);
            }
        }
    }
}
