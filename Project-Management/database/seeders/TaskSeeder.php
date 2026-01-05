<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = database_path('seeders/data/tasks.csv');
        
        if (($handle = fopen($file, 'r')) !== false) {
            // Lire l'en-tête
            $header = fgetcsv($handle, 1000, ',');
            
            // Lire les données
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                $task = array_combine($header, $row);
                
                Task::create([
                    'id' => $task['id'],
                    'title' => $task['title'],
                    'description' => $task['description'],
                    'image' => $task['image'],
                    'user_id' => $task['user_id'],
                    'created_at' => $task['created_at'],
                    'updated_at' => $task['updated_at']
                ]);
            }
            
            fclose($handle);
        }
    }
}
