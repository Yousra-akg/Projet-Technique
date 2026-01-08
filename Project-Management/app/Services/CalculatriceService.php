<?php

namespace App\Services;

class CalculatriceService
{
    /**
     * Addition de deux nombres
     */
    public function somme(float $a, float $b): float
    {
        return $a + $b;
    }
}
