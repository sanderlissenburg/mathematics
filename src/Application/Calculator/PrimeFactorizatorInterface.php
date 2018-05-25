<?php
declare(strict_types=1);

namespace App\Application\Calculator;

interface PrimeFactorizatorInterface
{
    public function factor(int $number): array;
}
