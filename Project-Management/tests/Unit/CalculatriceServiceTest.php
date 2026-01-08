<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\CalculatriceService;

class CalculatriceServiceTest extends TestCase
{
    /** @test */
    public function it_can_calculate_the_sum_of_two_numbers()
    {
        $calculatrice = new CalculatriceService();

        $result = $calculatrice->somme(10, 5);

        $this->assertEquals(15, $result);
    }
}
