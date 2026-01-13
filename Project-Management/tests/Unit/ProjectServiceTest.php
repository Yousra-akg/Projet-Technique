<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectServiceTest extends TestCase
{
    use DatabaseTransactions;

    protected ProjectService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ProjectService();
    }

    public function test_it_can_get_all_projects()
    {
        // Act
        $projects = $this->service->getAll();

        // Assert
        $this->assertGreaterThan(0, $projects->count());
    }
}
