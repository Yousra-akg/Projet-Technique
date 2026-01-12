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
    
        Project::create(['title' => 'Project A', 'description' => 'Description A']);
        Project::create(['title' => 'Project B', 'description' => 'Description B']);
        $projects = $this->projectService->getAll();

        $this->assertCount(2, $projects);
        $this->assertEquals('Project A', $projects->first()->title);
    }
}
