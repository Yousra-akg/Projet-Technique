<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Exécuter le seeder
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \Illuminate\Support\Facades\DB::table('projects')->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $file = database_path('seeders/data/projects.csv');
        
        if (($handle = fopen($file, 'r')) !== false) {
            $header = fgetcsv($handle, 1000, ',');
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                $project = array_combine($header, $row);
                
                Project::create([
                    'id' => $project['id'],
                    'title' => $project['title'],
                    'description' => $project['description'],
                    'created_at' => $project['created_at'],
                    'updated_at' => $project['updated_at']
                ]);
            }
            
            fclose($handle);
        }
    }
}