<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    /**
     * Récupérer tous les projets
     */
    public function getAll()
    {
        return Project::all();
    }
}