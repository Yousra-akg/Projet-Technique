<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectTaskSeeder extends Seeder
{
    /**
     * Exécuter le seeder
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        DB::table('project_task')->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $file = database_path('seeders/data/project_task.csv');
        
        if (($handle = fopen($file, 'r')) !== false) {
            $header = fgetcsv($handle, 1000, ',');
            
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                $relation = array_combine($header, $row);
                
                DB::table('project_task')->insert([
                    'id' => $relation['id'],
                    'project_id' => $relation['project_id'],
                    'task_id' => $relation['task_id'],
                    'created_at' => $relation['created_at'],
                    'updated_at' => $relation['updated_at']
                ]);
            }
            
            fclose($handle);
        }
    }
}
