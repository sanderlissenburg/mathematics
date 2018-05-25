<?php

declare(strict_types=1);

namespace App\Application\Helper;

interface PrimeNumberProviderInterface
{
    public function next(int $after = 1): int;
}
