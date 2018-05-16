<?php
declare(strict_types=1);

namespace App\Application\Calculators;

interface PrimeFactorizatorInterface
{
    public function factor(int $number): array;
}
