<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $projectService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->projectService = new ProjectService();
    }

    public function test_it_can_fetch_all_projects()
    {
        $this->seed(\Database\Seeders\ProjectSeeder::class);

        $projects = $this->projectService->getAll();

        $this->assertCount(3, $projects);
        $this->assertEquals('Application Web Gestion de Projet', $projects->first()->title);
    }
}
