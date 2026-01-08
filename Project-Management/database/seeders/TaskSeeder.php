<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tasks')->truncate();

        $file = database_path('seeders/data/tasks.csv');
        $handle = fopen($file, 'r');

        $header = fgetcsv($handle, 1000, ',');
        $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]);

        while (($row = fgetcsv($handle, 1000, ',')) !== false) {

            if (count($row) !== count($header)) {
                continue;
            }

            $task = array_combine($header, $row);

            Task::create([
                'title'       => $task['title'],
                'description' => $task['description'] ?? null,
                'image'       => $task['image'] ?? null,
                'user_id'     => $task['user_id'],
                'projet'      => $task['projet'],
                'created_at'  => $task['created_at'],
                'updated_at'  => $task['updated_at'],
            ]);
        }

        fclose($handle);
    }
}
