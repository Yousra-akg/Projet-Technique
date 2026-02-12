<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Project;
use App\Services\ProjectService;
<<<<<<< HEAD
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $projectService;
=======
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectServiceTest extends TestCase
{
    use DatabaseTransactions;

    protected ProjectService $service;
>>>>>>> gates

    protected function setUp(): void
    {
        parent::setUp();
<<<<<<< HEAD
        $this->projectService = new ProjectService();
    }

    public function test_it_can_fetch_all_projects()
    {
        $this->seed(\Database\Seeders\ProjectSeeder::class);

        $projects = $this->projectService->getAll();

        $this->assertCount(3, $projects);
        $this->assertEquals('Application Web Gestion de Projet', $projects->first()->title);
=======
        $this->service = new ProjectService();
    }

    public function test_it_can_get_all_projects()
    {
        // Act
        $projects = $this->service->getAll();

        // Assert
        $this->assertGreaterThan(0, $projects->count());
>>>>>>> gates
    }
}
