<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectServiceTest extends TestCase
{
    use RefreshDatabase;

    protected ProjectService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ProjectService();
    }

    public function test_it_can_get_all_projects()
    {
        // Arrange
        Project::factory()->count(3)->create();

        // Act
        $projects = $this->service->getAll();

        // Assert
        $this->assertEquals(3, $projects->count());
    }
}
